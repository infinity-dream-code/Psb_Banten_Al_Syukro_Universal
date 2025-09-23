<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJalur;
use App\Models\MasterFakultas;
use App\Models\MasterProdi;
use App\Models\target;
use App\Models\MasterAkademik;
use App\Models\MasterHarga;
use App\Models\MasterGelombang;
use App\Models\PembayaranSekolah;

class SettingsController extends Controller
{
public function index()
{
    $biaya      = MasterFakultas::orderBy('id')->get();
    $prodis     = MasterProdi::orderBy('id_fakultas')
                    ->orderBy('nama')
                    ->get();
    $gelombangs = MasterGelombang::orderBy('tahun')
                    ->orderBy('gelombang')
                    ->get();

    $masterHarga = MasterHarga::with(['jalur','gelombang','fakultas','prodi'])
                    ->orderBy('id')->get();

    return view('dashboard.settings.index', compact(
        'biaya',
        'prodis',
        'gelombangs',
        'masterHarga'
    ));
}


public function toggleFakultas($id)
{
    $fakultas = MasterFakultas::findOrFail($id);
    $fakultas->aktif = !$fakultas->aktif;
    $fakultas->save();
    return response()->json(['success' => true, 'status' => $fakultas->aktif]);
}


public function toggleAkademik($id)
{
    $akademik = MasterAkademik::findOrFail($id);
    $akademik->active = !$akademik->active; 
    $akademik->save();

    return response()->json(['success' => true, 'status' => $akademik->active]);
}


public function toggleGelombang($id)
{
    $gelombang = MasterGelombang::findOrFail($id);
    $gelombang->is_active = !$gelombang->is_active;
    $gelombang->save();

    return response()->json(['success' => true, 'status' => $gelombang->is_active]);
}


}
