<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterProvinsi;
use App\Models\MasterKabupaten;
use App\Models\MasterKecamatan;

class LokasiController extends Controller
{
    public function provinsi()
{
    return MasterProvinsi::select('id', 'Provinsi as name')
        ->orderByRaw('Provinsi asc')
        ->get();
}

public function kabupaten($provinsi_id)
{
    return MasterKabupaten::where('pmb_ref_provinsi_id', $provinsi_id)
        ->select('id', 'kota as name')
        ->orderByRaw('kota asc')
        ->get();
}

public function kecamatan($kabupaten_id)
{
    return MasterKecamatan::where('pmb_ref_kota_id', $kabupaten_id)
        ->select('id', 'kecamatan as name')
        ->orderByRaw('kecamatan asc')
        ->get();
}


}
