<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeserta;
use App\Models\MasterUjian;
use App\Models\Ujian;
use App\Models\Tagihan;
use App\Models\MasterGelombang;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;


class UjianController extends Controller
{
 
    public function simpan(Request $request)
    {
        
        $request->validate([
            'peserta_ids' => 'required|array|min:1',
            'ujian'       => 'required|array',
        ]);

        foreach ($request->peserta_ids as $pesertaId) {
            foreach ($request->ujian as $id_master_ujian => $data) {
                if (!empty($data['tanggal']) && !empty($data['ruang'])) {
                    Ujian::updateOrCreate(
                        [
                            'id_peserta'      => $pesertaId,
                            'id_master_ujian' => $id_master_ujian,
                        ],
                        [
                            'tanggal' => $data['tanggal'],
                            'ruang'   => $data['ruang'],
                        ]
                    );
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Parameter ujian berhasil disimpan']);
    }


public function setKelulusanPeserta(Request $request, $status)
{
    $ids = explode(',', $request->get('ids'));

    if ($status === 'gagal') {
        DataPeserta::whereIn('id', $ids)->update([
            'status_ujian' => 'gagal',
            'batas_awal_registrasi' => null,
            'batas_akhir_registrasi' => null,
            'pembekalan' => null,
        ]);
    } elseif ($status === 'lulus') {
        DataPeserta::whereIn('id', $ids)->update([
            'status_ujian' => 'lulus',
            'batas_awal_registrasi' => $request->awal,
            'batas_akhir_registrasi' => $request->akhir,
            'pembekalan' => $request->pembekalan,
        ]);

        $pesertaList = DataPeserta::with('masterHarga','relasiGelombang')
            ->whereIn('id', $ids)
            ->get();

        $payloadData = [];

        foreach ($pesertaList as $peserta) {
            $detail = [];
            $biayaDaful = 0;

            if ($peserta->masterHarga && is_array($peserta->masterHarga->detail)) {
                $detail = collect($peserta->masterHarga->detail)->map(function($d) {
                    return [
                        "nama_tagihan" => $d['nama_tagihan'],
                        "kode_tagihan" => $d['no_akun'],
                        "nominal"      => (int) $d['biaya'],
                    ];
                })->toArray();

                $biayaDaful = array_sum(array_column($detail,'nominal'));
            } else {
                Log::warning('Peserta tanpa masterHarga', [
                    'id_peserta' => $peserta->id,
                    'id_master_harga' => $peserta->id_master_harga
                ]);
            }

            Tagihan::create([
                'id_peserta'              => $peserta->id,
                'biaya_daful'             => $biayaDaful,
                'detail'                  => $detail,
                'status'                  => null,
                'tanggal_pembayaran_daful'=> null,
            ]);

            $payloadData[] = [
                "siswa" => [
                    "nomor_pendaftaran" => $peserta->no_pendaftaran,
                ],
                "tagihan" => [
                    "periode"        => now()->format('Ym'),
                    "nama_tagihan"   => "TAGIHAN_PENDAFTARAN_ULANG",
                    "tahun_akademik" => optional($peserta->relasiGelombang)->tahun_akademik,
                    "detail_tagihan" => $detail
                ]
            ];
        }

        if (!empty($payloadData)) {
            $jwtToken = JWT::encode(
                ['data' => $payloadData],
                '53c2f9aace5478a11815c65fcdb1a3dc29b60c3e102489384e3c1701f4355fa4',
                'HS256'
            );

            $payload = [
                "token"  => $jwtToken,
                "method" => "CreateTagihanBulk"
            ];

            Log::info('CreateTagihanBulk payload', $payload);

            $response = \Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('http://10.99.23.111/WS_PSB/WS_PSB_MASTER/index.php', $payload);

            Log::info('CreateTagihanBulk response', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            if (!$response->successful()) {
                return redirect()->back()->with('error', 'Gagal membuat tagihan');
            }
        }
    }

    return redirect()->back()->with('success', 'Status ujian berhasil diperbarui');
}


   public function setKelulusan(Request $request)
{
    $query = DataPeserta::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_peserta', 'like', "%$search%")
              ->orWhere('no_pendaftaran', 'like', "%$search%")
              ->orWhere('fakultas', 'like', "%$search%")
              ->orWhere('prodi', 'like', "%$search%")
              ->orWhere('jalur', 'like', "%$search%");
        });
    }

    $today = now()->toDateString();

    $tahunAkademikList = MasterGelombang::select('tahun_akademik')
        ->distinct()
        ->orderBy('tahun_akademik')
        ->get();

    if ($request->filled('tahun_akademik')) {
        $gelombangList = MasterGelombang::where('tahun_akademik', $request->tahun_akademik)
            ->where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    } else {
        $gelombangList = MasterGelombang::where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    }

    $defaultGelombang = MasterGelombang::where('start', '<=', $today)
        ->where('end', '>=', $today)
        ->first();

    $idGelombang = $request->get('gelombang_id', $defaultGelombang?->id);

    if ($idGelombang) {
        $query->where('id_gelombang', $idGelombang);
    }

    $fieldWajib = [
        'no_hp',
        'nik',
        'no_kk',
        'kewarganegaraan',
    ];

    $uploadWajib = [
        'foto',
        'dokumen_kk',
        'dokumen_ktp_ortu',
        'dokumen_akte_kelahiran',
    ];

    $pesertaList = $query->get()->filter(function ($peserta) use ($fieldWajib) {
        foreach ($fieldWajib as $field) {
            if (empty($peserta->$field)) {
                return false;
            }
        }
        return !empty($peserta->foto);
    });

    $perPage = 10;
    $page = request()->get('page', 1);
    $items = $pesertaList->slice(($page - 1) * $perPage, $perPage)->values();
    $paginatedPeserta = new \Illuminate\Pagination\LengthAwarePaginator(
        $items,
        $pesertaList->count(),
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    $masterUjianList = MasterUjian::all();

    return view('dashboard.kelulusan.index', compact(
        'paginatedPeserta',
        'fieldWajib',
        'uploadWajib',
        'masterUjianList',
        'gelombangList',
        'tahunAkademikList',
        'idGelombang'
    ));
}


public function cekBerkasSetUjian(Request $request) 
{
    $query = DataPeserta::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_peserta', 'like', "%$search%")
              ->orWhere('no_pendaftaran', 'like', "%$search%")
              ->orWhere('fakultas', 'like', "%$search%")
              ->orWhere('prodi', 'like', "%$search%")
              ->orWhere('jalur', 'like', "%$search%");
        });
    }

    $today = now()->toDateString();

    $tahunAkademikList = MasterGelombang::select('tahun_akademik')
        ->distinct()
        ->orderBy('tahun_akademik')
        ->get();

    if ($request->filled('tahun_akademik')) {
        $gelombangList = MasterGelombang::where('tahun_akademik', $request->tahun_akademik)
            ->where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    } else {
        $gelombangList = MasterGelombang::where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    }

    $defaultGelombang = MasterGelombang::where('start', '<=', $today)
        ->where('end', '>=', $today)
        ->first();

    $idGelombang = $request->get('gelombang_id', $defaultGelombang?->id);

    if ($idGelombang) {
        $query->where('id_gelombang', $idGelombang);
    }

    $fieldWajib = [
        'no_hp',
        'nik',
        'no_kk',
        'kewarganegaraan',
    ];

    $uploadWajib = [
        'foto',
        'dokumen_kk',
        'dokumen_ktp_ortu',
        'dokumen_akte_kelahiran',
    ];

    $pesertaList = $query->get()->filter(function ($peserta) use ($fieldWajib) {
        foreach ($fieldWajib as $field) {
            if (empty($peserta->$field)) {
                return false;
            }
        }
        if (empty($peserta->foto)) {
            return false;
        }
        return true;
    });

    $perPage = 10;
    $page = request()->get('page', 1);
    $items = $pesertaList->slice(($page - 1) * $perPage, $perPage)->values();
    $paginatedPeserta = new \Illuminate\Pagination\LengthAwarePaginator(
        $items,
        $pesertaList->count(),
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    $masterUjianList = MasterUjian::all();

    return view('dashboard.ujian.cek_berkas_set_ujian', compact(
        'paginatedPeserta',
        'fieldWajib',
        'uploadWajib',
        'masterUjianList',
        'gelombangList',
        'tahunAkademikList',
        'idGelombang'
    ));
}



public function cetakKartu($no_pendaftaran)
{
    $noList = explode(',', $no_pendaftaran);

    $pesertaList = DataPeserta::with(['relasiGelombang', 'ujian.masterUjian'])
        ->whereIn('no_pendaftaran', $noList)
        ->get();

    $masterUjian = \App\Models\MasterUjian::all();

    if ($pesertaList->isEmpty()) {
        abort(404, 'Peserta tidak ditemukan');
    }

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.ujian.kartu-ujian', compact('pesertaList', 'masterUjian'))
              ->setPaper('A4', 'portrait');

    return $pdf->stream('kartu-ujian.pdf', ['Attachment' => false]);
}

public function cetakKartuUjian(Request $request)
{
    $query = DataPeserta::with(['relasiGelombang', 'ujian.masterUjian'])
        ->whereHas('ujian');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_peserta', 'like', "%$search%")
              ->orWhere('no_pendaftaran', 'like', "%$search%")
              ->orWhere('fakultas', 'like', "%$search%")
              ->orWhere('prodi', 'like', "%$search%")
              ->orWhere('jalur', 'like', "%$search%");
        });
    }

    $today = now()->toDateString();

    $tahunAkademikList = MasterGelombang::select('tahun_akademik')
        ->distinct()
        ->orderBy('tahun_akademik')
        ->get();

    if ($request->filled('tahun_akademik')) {
        $gelombangList = MasterGelombang::where('tahun_akademik', $request->tahun_akademik)
            ->where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    } else {
        $gelombangList = MasterGelombang::where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    }

    $defaultGelombang = MasterGelombang::where('start', '<=', $today)
        ->where('end', '>=', $today)
        ->first();

    $idGelombang = $request->get('gelombang_id', $defaultGelombang?->id);

    if ($idGelombang) {
        $query->where('id_gelombang', $idGelombang);
    }

    $pesertaList = $query->paginate(10)->appends($request->query());

    return view('dashboard.ujian.cetak-kartu-ujian', compact(
        'pesertaList',
        'gelombangList',
        'tahunAkademikList',
        'idGelombang'
    ));
}


public function editJadwalUjian(Request $request)
{
    $query = DataPeserta::with(['ujian.masterUjian'])
        ->whereHas('ujian')
        ->whereHas('relasiGelombang', function($q) {
            $q->whereDate('end', '>=', now()->toDateString());
        });

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_peserta', 'like', "%$search%")
              ->orWhere('no_pendaftaran', 'like', "%$search%")
              ->orWhere('fakultas', 'like', "%$search%")
              ->orWhere('prodi', 'like', "%$search%")
              ->orWhere('jalur', 'like', "%$search%");
        });
    }

    $today = now()->toDateString();

    $tahunAkademikList = MasterGelombang::select('tahun_akademik')
        ->distinct()
        ->orderBy('tahun_akademik')
        ->get();

    if ($request->filled('tahun_akademik')) {
        $gelombangList = MasterGelombang::where('tahun_akademik', $request->tahun_akademik)
            ->where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    } else {
        $gelombangList = MasterGelombang::where('end', '>=', $today)
            ->orderBy('gelombang')
            ->get();
    }

    $defaultGelombang = MasterGelombang::where('start', '<=', $today)
        ->where('end', '>=', $today)
        ->first();

    $idGelombang = $request->get('gelombang_id', $defaultGelombang?->id);

    if ($idGelombang) {
        $query->where('id_gelombang', $idGelombang);
    }

    $pesertaList = $query->paginate(10)->appends($request->query());

    return view('dashboard.ujian.edit-jadwal', compact(
        'pesertaList',
        'gelombangList',
        'tahunAkademikList',
        'idGelombang'
    ));
}

    public function updateJadwalUjian(Request $request)
    {
        $jadwals = $request->input('jadwal', []);

        foreach ($jadwals as $pesertaId => $ujianList) {
            foreach ($ujianList as $ujianId => $data) {
                Ujian::where('id', $ujianId)
                    ->where('id_peserta', $pesertaId)
                    ->update([
                        'tanggal' => $data['tanggal'] ?? null,
                        'ruang'   => $data['ruang'] ?? null,
                    ]);
            }
        }

        return redirect()->back()->with('success', 'Jadwal ujian berhasil diperbarui.');
    }



}
