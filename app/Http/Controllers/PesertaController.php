<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeserta;
use App\Models\MasterAgama;
use App\Models\MasterHarga;
use App\Models\MasterNegara;
use App\Models\MasterSumberInformasi;
use App\Models\MasterProvinsi;
use App\Models\MasterKabupaten;
use App\Models\MasterKecamatan;
use App\Models\MasterJurusanSekolah;
use App\Models\MasterPendidikanOrtu;
use App\Models\MasterPekerjaanOrtu;
use App\Models\MasterPenghasilanOrtu;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PesertaController extends Controller
{
    
public function index()
{
    $peserta = auth()->user()->peserta()->with(['relasiGelombang', 'ujian'])->first();

    return view('peserta.index', compact('peserta'));
}

public function lengkapi_data()
{
    $peserta = auth()->user()->peserta ?? new DataPeserta();
    $peserta->load(['bantuan','masterHarga']); 

    $negaraList = MasterNegara::all();
    $agamaList = MasterAgama::all();
    $sumberInformasiList = MasterSumberInformasi::all();
    $provinsiList = MasterProvinsi::all();
    $jurusanList = MasterJurusanSekolah::all();
    $pendidikanList = MasterPendidikanOrtu::all();
    $pekerjaanList = MasterPekerjaanOrtu::all();
    $penghasilanList = MasterPenghasilanOrtu::all();

    $kabupatenList = [];
    $kecamatanList = [];
    $kabupatenSekolahList = [];

    if ($peserta->id_provinsi) {
        $kabupatenList = MasterKabupaten::where('pmb_ref_provinsi_id', $peserta->id_provinsi)->get();
    }

    if ($peserta->id_kabupaten) {
        $kecamatanList = MasterKecamatan::where('pmb_ref_kota_id', $peserta->id_kabupaten)->get();
    }

    if ($peserta->id_provinsi_sekolah) {
        $kabupatenSekolahList = MasterKabupaten::where('pmb_ref_provinsi_id', $peserta->id_provinsi_sekolah)->get();
    }

    return view('peserta.lengkapi_data', compact(
        'peserta',
        'negaraList',
        'agamaList',
        'sumberInformasiList',
        'provinsiList',
        'kabupatenList',
        'kecamatanList',
        'kabupatenSekolahList',
        'jurusanList',
        'pendidikanList',
        'pekerjaanList',
        'penghasilanList'
    ));
}


public function simpan_bantuan(Request $request)
{
    $request->validate([
        'no_kks' => 'nullable|string|max:20',
        'no_kps' => 'nullable|string|max:20',
        'usulan_pip' => 'nullable|string',
        'nomor_kip' => 'nullable',
        'nama_kip' => 'nullable|string|max:100',
        'alasan_menolak_kip' => 'nullable|string',
        'no_reg_akta_lahir' => 'nullable',
    ]);

    $user = auth()->user();
    $peserta = $user->peserta;

    if (!$peserta) {
        return redirect()->back()->with('error', 'Data peserta tidak ditemukan.');
    }

    $peserta->bantuan()->updateOrCreate(
        ['id_peserta' => $peserta->id],
        [
            'no_kks' => $request->no_kks,
            'no_kps' => $request->no_kps,
            'usulan_pip' => $request->usulan_pip,
            'nomor_kip' => $request->nomor_kip,
            'nama_kip' => $request->nama_kip,
            'alasan_menolak_kip' => $request->alasan_menolak_kip,
            'no_reg_akta_lahir' => $request->no_reg_akta_lahir,
        ]
    );

    return redirect()->back()->with('success', 'Data bantuan berhasil disimpan!');
}

public function simpan_data(Request $request)
{
    $request->validate([
        'nik' => 'required|digits:16',
        'no_akta_lahir' => 'required',
        'no_kk' => 'required|digits:16',
        'ibu_nik' => 'nullable|digits:16',
        'ayah_nik' => 'nullable|digits:16',
        'foto' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        'dokumen_kk' => 'nullable|mimes:png,jpg,jpeg,pdf|max:4096',
        'dokumen_ktp_ortu' => 'nullable|mimes:png,jpg,jpeg,pdf|max:4096',
        'dokumen_akte_kelahiran' => 'nullable|mimes:png,jpg,jpeg,pdf|max:4096',
    ]);

    $user = auth()->user();
    $peserta = $user->peserta ?? new DataPeserta();
    $peserta->id_user = $user->id;

    $fillable = [
        'nama_peserta', 'nik', 'tempat_lahir', 'tanggal_lahir',
        'nisn', 'no_akta_lahir', 'agama','no_kk',
        'kewarganegaraan', 'email', 'no_hp', 'alamat_lengkap',
        'dusun', 'id_provinsi', 'id_kabupaten', 'id_kecamatan', 'kode_pos',
        'nama_sekolah', 'id_provinsi_sekolah', 'id_kabupaten_sekolah',
        'alamat_sekolah', 'tahun_lulus', 'status_sekolah', 'id_jurusan',
        'ibu_nama', 'ibu_tanggal_lahir', 'ibu_nik', 'ibu_alamat',
        'ibu_suku', 'id_pendidikan_ibu', 'id_pekerjaan_ibu', 'id_penghasilan_ibu', 'ibu_no_tlp',
        'ayah_nama', 'ayah_tanggal_lahir', 'ayah_nik', 'ayah_alamat',
        'ayah_suku', 'id_pendidikan_ayah', 'id_pekerjaan_ayah', 'id_penghasilan_ayah', 'ayah_no_tlp',
        'jml_saudara_kandung', 'jml_saudara_yayasan', 'id_sumber'
    ];

    foreach ($fillable as $field) {
        $peserta->$field = $request->$field ?? $peserta->$field;
    }

    if ($request->gender) {
        $peserta->gender = $request->gender === 'Laki-laki' ? 'L' : 'P';
    }

    if ($request->filled('id_pendidikan_ibu')) {
        $peserta->ibu_pendidikan = \App\Models\MasterPendidikanOrtu::find($request->id_pendidikan_ibu)->nama ?? null;
    }
    if ($request->filled('id_pendidikan_ayah')) {
        $peserta->ayah_pendidikan = \App\Models\MasterPendidikanOrtu::find($request->id_pendidikan_ayah)->nama ?? null;
    }
    if ($request->filled('id_sumber')) {
        $peserta->nama_sumber = \App\Models\MasterSumberInformasi::find($request->id_sumber)->nama ?? null;
    }
    if ($request->filled('id_kabupaten_sekolah')) {
        $peserta->kota_sekolah = \App\Models\MasterKabupaten::find($request->id_kabupaten_sekolah)->kota ?? null;
    }
    if ($request->filled('id_provinsi_sekolah')) {
        $peserta->provinsi_sekolah = \App\Models\MasterProvinsi::find($request->id_provinsi_sekolah)->Provinsi ?? null;
    }

    $tahun = $peserta->relasiGelombang->tahun ?? date('Y');

    if ($request->hasFile('foto')) {
        if ($peserta->foto && \Storage::disk('public')->exists($peserta->foto)) {
            \Storage::disk('public')->delete($peserta->foto);
        }
        $foto = $request->file('foto');
        $manager = new ImageManager(new Driver());
        $img = $manager->read($foto);
        $width = $img->width();
        $height = $img->height();
        $ratio = round($width / $height, 2);
        if ($ratio != round(3/4, 2)) {
            return back()->withErrors(['foto' => 'Foto harus berukuran 3x4 (rasio 3:4)'])->withInput();
        }
        $peserta->foto = $foto->store("uploads/foto/foto-$tahun", 'public');
    }

    if ($request->hasFile('dokumen_kk')) {
        if ($peserta->dokumen_kk && \Storage::disk('public')->exists($peserta->dokumen_kk)) {
            \Storage::disk('public')->delete($peserta->dokumen_kk);
        }
        $peserta->dokumen_kk = $request->file('dokumen_kk')->store("uploads/dokumen/kk-$tahun", 'public');
    }
    if ($request->hasFile('dokumen_ktp_ortu')) {
        if ($peserta->dokumen_ktp_ortu && \Storage::disk('public')->exists($peserta->dokumen_ktp_ortu)) {
            \Storage::disk('public')->delete($peserta->dokumen_ktp_ortu);
        }
        $peserta->dokumen_ktp_ortu = $request->file('dokumen_ktp_ortu')->store("uploads/dokumen/ktp-$tahun", 'public');
    }
    if ($request->hasFile('dokumen_akte_kelahiran')) {
        if ($peserta->dokumen_akte_kelahiran && \Storage::disk('public')->exists($peserta->dokumen_akte_kelahiran)) {
            \Storage::disk('public')->delete($peserta->dokumen_akte_kelahiran);
        }
        $peserta->dokumen_akte_kelahiran = $request->file('dokumen_akte_kelahiran')->store("uploads/dokumen/akta-$tahun", 'public');
    }

    $peserta->save();

    return redirect('PmbMstPendaftarans/lengkapi_data')->with('success', 'Data berhasil disimpan!');
}

}
