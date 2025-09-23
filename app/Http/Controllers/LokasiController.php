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
        try {
            $provinsi = MasterProvinsi::select('id', 'Provinsi as name')
                ->orderBy('Provinsi', 'asc')
                ->get();
            
            return response()->json($provinsi);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch provinces'], 500);
        }
    }

    public function kabupaten($provinsi_id)
    {
        try {
            $kabupaten = MasterKabupaten::where('pmb_ref_provinsi_id', $provinsi_id)
                ->select('id', 'kota as name')
                ->orderBy('kota', 'asc')
                ->get();
            
            return response()->json($kabupaten);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch kabupaten'], 500);
        }
    }

    public function kecamatan($kabupaten_id)
    {
        try {
            $kecamatan = MasterKecamatan::where('pmb_ref_kota_id', $kabupaten_id)
                ->select('id', 'kecamatan as name')
                ->orderBy('kecamatan', 'asc')
                ->get();
            
            return response()->json($kecamatan);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch kecamatan'], 500);
        }
    }
}