<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataPeserta;
use App\Models\MasterGelombang;
use App\Models\MasterJalur;
use App\Models\MasterFakultas;
use App\Models\MasterProdi;
use App\Models\MasterHarga;
class UserController extends Controller
{

   public function detailRegistrasi($encoded)
{
    $no_pendaftaran = base64_decode($encoded);
    $peserta = DataPeserta::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();
    $gelombang = \App\Models\MasterGelombang::find($peserta->id_gelombang);
    $tahun_akademik = $gelombang ? $gelombang->tahun_akademik : '-';
    $tanggalSekarang = \Carbon\Carbon::now()->translatedFormat('d F Y');
    return view('dashboard.list-user.surat-registrasi', compact('peserta','tahun_akademik','tanggalSekarang'));
}


public function cetakFormulir($encoded)
{
    $no_pendaftaran = base64_decode($encoded);
    $peserta = \App\Models\DataPeserta::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();

    $harga = \App\Models\MasterHarga::find($peserta->id_master_harga);
    $biayaPendaftaran = $harga ? $harga->harga_final : 0;

    $detailBiaya = [];
    if ($harga && $harga->detail) {
        if (is_string($harga->detail)) {
            $detailBiaya = json_decode($harga->detail, true) ?: [];
        } elseif (is_array($harga->detail)) {
            $detailBiaya = $harga->detail;
        }
    }

    $ujian = \App\Models\Ujian::where('id_peserta', $peserta->id)->with('masterUjian')->get();

    $berkas = [
        'Upload Foto' => $peserta->foto,
        'Upload Kartu Keluarga' => $peserta->dokumen_kk,
        'Upload Identitas' => $peserta->dokumen_ktp_ortu,
        'Upload Akte Kelahiran' => $peserta->dokumen_akte_kelahiran,
    ];

    $tanggalSekarang = \Carbon\Carbon::now()->translatedFormat('d F Y');

    return view('dashboard.list-user.formulir', compact(
        'peserta',
        'biayaPendaftaran',
        'detailBiaya',
        'ujian',
        'berkas',
        'tanggalSekarang'
    ));
}

public function editpeserta($id)
{
    $peserta = DataPeserta::findOrFail($id);

    $jalurs = MasterHarga::select('id_jalur', 'nama_jalur')
        ->where('active', 1)
        ->distinct()
        ->get();

    $gelombangs = collect();
    $fakultas = collect();
    $prodis = collect();

    if ($peserta->id_jalur) {
        $today = now()->toDateString();

        $gelombangs = MasterHarga::with('gelombang')
            ->where('active', 1)
            ->where('id_jalur', $peserta->id_jalur)
            ->whereHas('gelombang', function ($q) use ($today) {
                $q->whereDate('start', '<=', $today)
                  ->whereDate('end', '>=', $today);
            })
            ->select('id_gelombang')
            ->distinct()
            ->get()
            ->map(function ($row) {
                return [
                    'id_gelombang' => $row->gelombang->id,
                    'nama_gelombang' => $row->gelombang->gelombang . ' - ' . $row->gelombang->tahun_akademik,
                ];
            });
    }

    if ($peserta->id_jalur && $peserta->id_gelombang) {
        $fakultas = MasterHarga::where('active', 1)
            ->where('id_jalur', $peserta->id_jalur)
            ->where('id_gelombang', $peserta->id_gelombang)
            ->select('id_fakultas', 'nama_fakultas')
            ->distinct()
            ->get();
    }

    if ($peserta->id_jalur && $peserta->id_gelombang && $peserta->id_fakultas) {
        $prodis = MasterHarga::where('active', 1)
            ->where('id_jalur', $peserta->id_jalur)
            ->where('id_gelombang', $peserta->id_gelombang)
            ->where('id_fakultas', $peserta->id_fakultas)
            ->select('id_prodi', 'nama_prodi')
            ->distinct()
            ->get();
    }

    return view('dashboard.list-user.edit', compact(
        'peserta',
        'jalurs',
        'gelombangs',
        'fakultas',
        'prodis'
    ));
}


    public function getGelombangByJalur($id_jalur)
    {
        $today = now()->toDateString();

        $gelombangs = MasterHarga::with('gelombang')
            ->where('id_jalur', $id_jalur)
            ->whereHas('gelombang', function ($q) use ($today) {
                $q->whereDate('start', '<=', $today)
                  ->whereDate('end', '>=', $today);
            })
            ->select('id_gelombang')
            ->distinct()
            ->get()
            ->map(function ($row) {
                return [
                    'id_gelombang' => $row->gelombang->id,
                    'nama_gelombang' => $row->gelombang->gelombang . ' - ' . $row->gelombang->tahun_akademik,
                ];
            });

        return response()->json($gelombangs);
    }

    public function getFakultasByJalurGelombang($id_jalur, $id_gelombang)
    {
        $fakultas = MasterHarga::where('id_jalur', $id_jalur)
            ->where('id_gelombang', $id_gelombang)
            ->select('id_fakultas', 'nama_fakultas')
            ->distinct()
            ->get();

        return response()->json($fakultas);
    }

    public function getProdiByJalurGelombangFakultas($id_jalur, $id_gelombang, $id_fakultas)
    {
        $prodi = MasterHarga::where('id_jalur', $id_jalur)
            ->where('id_gelombang', $id_gelombang)
            ->where('id_fakultas', $id_fakultas)
            ->select('id_prodi', 'nama_prodi')
            ->distinct()
            ->get();

        return response()->json($prodi);
    }

public function updatepeserta(Request $request, $id)
{
    $peserta = DataPeserta::findOrFail($id);

    $rules = [
        'nama_peserta' => 'required|string|max:255',
        'no_hp'        => 'required|string|max:20',
    ];

    if ($peserta->status_pembayaran_registrasi == 0 && $peserta->status_ujian !== 'LULUS') {
        $rules = array_merge($rules, [
            'id_gelombang' => 'required',
            'id_jalur'     => 'required',
            'id_fakultas'  => 'required',
            'id_prodi'     => 'required',
        ]);
    }

    $request->validate($rules);

    $peserta->nama_peserta = $request->nama_peserta;
    $peserta->no_hp = $request->no_hp;

    if ($peserta->status_pembayaran_registrasi == 0 && $peserta->status_ujian !== 'LULUS') {
        $peserta->id_gelombang = $request->id_gelombang;
        $peserta->id_jalur     = $request->id_jalur;
        $peserta->id_fakultas  = $request->id_fakultas;
        $peserta->id_prodi     = $request->id_prodi;

        $masterHarga = MasterHarga::where('id_jalur',$request->id_jalur)
            ->where('id_gelombang',$request->id_gelombang)
            ->where('id_fakultas',$request->id_fakultas)
            ->where('id_prodi',$request->id_prodi)
            ->first();

        if ($masterHarga) {
            $peserta->id_master_harga = $masterHarga->id;
        }

        $jalur    = MasterJalur::find($request->id_jalur);
        $gelombang= MasterGelombang::find($request->id_gelombang);
        $fakultas = MasterFakultas::find($request->id_fakultas);
        $prodi    = MasterProdi::find($request->id_prodi);

        $peserta->jalur     = $jalur?->nama;
        $peserta->gelombang = $gelombang ? "Gelombang ".$gelombang->gelombang." - ".$gelombang->tahun_akademik : null;
        $peserta->fakultas  = $fakultas?->fakultas;
        $peserta->prodi     = $prodi?->nama;
    }

    $peserta->save();

    return redirect()->route('users.list')->with('success','Data peserta berhasil diperbarui.');
}



public function cetakInfoEnroll($nama, $no_pendaftaran, $jalur)
{
    $peserta = DataPeserta::where('no_pendaftaran', $no_pendaftaran)
        ->where('nama_peserta', $nama)
        ->where('jalur', $jalur)
        ->firstOrFail();

    $user = \App\Models\User::where('username', $peserta->no_pendaftaran)->first();

    $createdAt = \Carbon\Carbon::parse($peserta->created_at)->translatedFormat('d M, Y');
    $cetak = \Carbon\Carbon::now()->translatedFormat('d M, Y');

    $harga = \App\Models\MasterHarga::find($peserta->id_master_harga);
    $biayaPendaftaran = $harga ? $harga->harga_final : 0;

    return view('dashboard.list-user.info', compact(
        'peserta',
        'user',
        'createdAt',
        'cetak',
        'biayaPendaftaran'
    ));
}



  public function index(Request $request)
{
    $search = $request->get('search');

    $users = User::with('peserta')
        ->when($search, function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhereHas('peserta', function($q2) use ($search) {
                  $q2->where('no_pendaftaran', 'like', "%{$search}%");
              });
        })
        ->orderBy('id', 'desc')
        ->paginate(10);

    return view('dashboard.pengguna.index', compact('users', 'search'));
}

public function userlist(Request $request)
{
    $query = DataPeserta::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_peserta', 'like', "%$search%")
              ->orWhere('no_pendaftaran', 'like', "%$search%")
              ->orWhere('fakultas', 'like', "%$search%");
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

    $query->where('status_paid', 1);

    $peserta = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

    return view('dashboard.list-user.index', compact(
        'peserta',
        'tahunAkademikList',
        'gelombangList',
        'idGelombang'
    ));
}

    public function showuser($id)
    {
        $peserta = DataPeserta::findOrFail($id);
        return view('dashboard.list-user.detail', compact('peserta'));
    }


     public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        $user->nama = $request->nama;
        $user->username = $request->username;
        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->plain_password = $request->password;
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
