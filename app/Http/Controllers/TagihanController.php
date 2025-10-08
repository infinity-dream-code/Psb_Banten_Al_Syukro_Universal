<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;

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
}
