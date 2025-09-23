<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeserta;
use App\Models\MasterGelombang;
class PembayaranController extends Controller
{

    public function detail($id)
{
    $peserta = DataPeserta::findOrFail($id);
    return view('dashboard.cek_berkas.detail', compact('peserta'));
}

public function cekBerkas(Request $request)
{
    $today = now()->toDateString();

    $tahunAkademikList = MasterGelombang::select('tahun_akademik')
        ->distinct()
        ->orderBy('tahun_akademik')
        ->get();

    $gelombangQuery = MasterGelombang::query();
    if ($request->filled('tahun_akademik')) {
        $gelombangQuery->where('tahun_akademik', $request->tahun_akademik);
    }
    $gelombangList = $gelombangQuery->orderBy('gelombang')->get();

    $selectedTahunAkademik = $request->input('tahun_akademik');
    $idGelombang = $request->input('gelombang_id');

    $query = DataPeserta::query();

    if ($idGelombang) {
        $query->where('id_gelombang', $idGelombang);
    }

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

    $fieldWajib = ['no_hp', 'nik', 'no_kk', 'kewarganegaraan'];
    $uploadWajib = ['foto'];

    $pesertaList = $query->orderBy('created_at', 'desc')->paginate(10);
    
    $pesertaList->appends($request->only(['tahun_akademik', 'gelombang_id', 'search']));

    $pesertaList->getCollection()->transform(function ($peserta) use ($fieldWajib, $uploadWajib) {
        $lengkap = true;
        foreach ($fieldWajib as $f) {
            if (empty($peserta->$f)) {
                $lengkap = false;
                break;
            }
        }
        if ($lengkap) {
            foreach ($uploadWajib as $f) {
                if (empty($peserta->$f)) {
                    $lengkap = false;
                    break;
                }
            }
        }
        $peserta->is_lengkap = $lengkap;
        $peserta->is_paid = (bool) $peserta->status_paid;
        return $peserta;
    });

    return view('dashboard.cek_berkas.index', compact(
        'pesertaList',
        'fieldWajib',
        'uploadWajib',
        'gelombangList',
        'tahunAkademikList',
        'idGelombang'
    ));
}


}
