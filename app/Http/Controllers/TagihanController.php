<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\MasterRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagihanController extends Controller
{
   public function index()
{
    $tagihan = Tagihan::with('peserta')->latest()->paginate(10);
    
    $tagihan->getCollection()->transform(function ($item) {
        $item->detail = is_string($item->detail) ? json_decode($item->detail, true) : $item->detail;
        $item->detail = $item->detail ?? [];
        return $item;
    });
    
    return view('dashboard.cek_berkas.tagihan', compact('tagihan'));
}

public function index1(Request $request)
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

    $query = Tagihan::with('peserta')->latest();

    if ($user->prodi_id) {
        $prodiIds = is_array($user->prodi_id) ? $user->prodi_id : explode(',', $user->prodi_id);
        $query->whereHas('peserta', function ($q) use ($prodiIds) {
            $q->whereIn('id_prodi', $prodiIds);
        });
    }

    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('peserta', function ($q) use ($search) {
            $q->where('nama_peserta', 'like', "%$search%")
              ->orWhere('no_pendaftaran', 'like', "%$search%")
              ->orWhere('fakultas', 'like', "%$search%")
              ->orWhere('prodi', 'like', "%$search%");
        });
    }

    $tagihan = $query->paginate(10);

    $tagihan->getCollection()->transform(function ($item) {
        $item->detail = is_string($item->detail) ? json_decode($item->detail, true) : $item->detail;
        $item->detail = $item->detail ?? [];
        return $item;
    });

    return view('dashboard-unit.cek_berkas.tagihan', compact('tagihan', 'menus', 'role'));
}


}
