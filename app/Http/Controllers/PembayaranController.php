<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeserta;
use App\Models\MasterGelombang;
use App\Models\MasterRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PembayaranController extends Controller
{

    public function detail($id)
{
    $peserta = DataPeserta::findOrFail($id);
    return view('dashboard.cek_berkas.detail', compact('peserta'));
}

 public function detail2($id)
{
    $peserta = DataPeserta::findOrFail($id);
    return view('dashboard-unit.cek_berkas.detail', compact('peserta'));
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

public function cekBerkas1(Request $request)
{
    $user = Auth::user();
    $role = $user->role;

    $normalizedRole = Str::of($role)->replace('-', ' ')->__toString();
    $roleData = MasterRole::whereRaw('LOWER(nama_role) = ?', [strtolower($normalizedRole)])->first();

    $menus = [];
    if ($roleData && $roleData->menu) {
        if (is_array($roleData->menu)) {
            $menus = array_map(fn($m) => strtolower(trim($m)), $roleData->menu);
        } else {
            $decoded = json_decode($roleData->menu, true);
            if (is_array($decoded)) {
                $menus = array_map(fn($m) => strtolower(trim($m)), $decoded);
            } else {
                $menus = explode(',', strtolower($roleData->menu));
            }
        }
    }

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

    $prodiIds = [];
    if ($user->prodi_id) {
        $prodiIds = is_array($user->prodi_id) ? $user->prodi_id : explode(',', $user->prodi_id);
        $query->whereIn('id_prodi', $prodiIds);
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

    return view('dashboard-unit.cek_berkas.index', compact(
        'pesertaList',
        'fieldWajib',
        'uploadWajib',
        'gelombangList',
        'tahunAkademikList',
        'idGelombang',
        'menus',
        'role'
    ));
}





}
