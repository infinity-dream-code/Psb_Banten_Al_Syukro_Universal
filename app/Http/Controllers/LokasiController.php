<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterProvinsi;
use App\Models\MasterKabupaten;
use App\Models\MasterKecamatan;
use Illuminate\Support\Facades\Log;

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
            Log::error('Error fetching provinces: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch provinces'], 500);
        }
    }

    public function kabupaten($provinsi_id)
    {
        try {
            // Validate provinsi_id
            if (!is_numeric($provinsi_id)) {
                return response()->json(['error' => 'Invalid province ID'], 400);
            }

            // Check if provinsi exists
            $provinsiExists = MasterProvinsi::where('id', $provinsi_id)->exists();
            if (!$provinsiExists) {
                return response()->json(['error' => 'Province not found'], 404);
            }

            $kabupaten = MasterKabupaten::where('pmb_ref_provinsi_id', $provinsi_id)
                ->select('id', 'kota as name')
                ->orderBy('kota', 'asc')
                ->get();
            
            return response()->json($kabupaten);
        } catch (\Exception $e) {
            Log::error('Error fetching kabupaten for provinsi ' . $provinsi_id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch kabupaten'], 500);
        }
    }

    public function kecamatan($kabupaten_id)
    {
        try {
            // Validate kabupaten_id
            if (!is_numeric($kabupaten_id)) {
                return response()->json(['error' => 'Invalid kabupaten ID'], 400);
            }

            // Check if kabupaten exists
            $kabupatenExists = MasterKabupaten::where('id', $kabupaten_id)->exists();
            if (!$kabupatenExists) {
                return response()->json(['error' => 'Kabupaten not found'], 404);
            }

            $kecamatan = MasterKecamatan::where('pmb_ref_kota_id', $kabupaten_id)
                ->select('id', 'kecamatan as name')
                ->orderBy('kecamatan', 'asc')
                ->get();
            
            return response()->json($kecamatan);
        } catch (\Exception $e) {
            Log::error('Error fetching kecamatan for kabupaten ' . $kabupaten_id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch kecamatan'], 500);
        }
    }

    // Method tambahan untuk mendapatkan data lengkap alamat berdasarkan ID
    public function getFullAddress(Request $request)
    {
        try {
            $provinsiId = $request->get('provinsi_id');
            $kabupatenId = $request->get('kabupaten_id');
            $kecamatanId = $request->get('kecamatan_id');

            $result = [];

            // Get provinsi data
            if ($provinsiId) {
                $provinsi = MasterProvinsi::select('id', 'Provinsi as name')
                    ->where('id', $provinsiId)
                    ->first();
                if ($provinsi) {
                    $result['provinsi'] = $provinsi;
                }
            }

            // Get kabupaten data
            if ($kabupatenId) {
                $kabupaten = MasterKabupaten::select('id', 'kota as name', 'pmb_ref_provinsi_id')
                    ->where('id', $kabupatenId)
                    ->first();
                if ($kabupaten) {
                    $result['kabupaten'] = $kabupaten;
                }
            }

            // Get kecamatan data
            if ($kecamatanId) {
                $kecamatan = MasterKecamatan::select('id', 'kecamatan as name', 'pmb_ref_kota_id')
                    ->where('id', $kecamatanId)
                    ->first();
                if ($kecamatan) {
                    $result['kecamatan'] = $kecamatan;
                }
            }

            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Error getting full address: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get address data'], 500);
        }
    }
}