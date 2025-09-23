<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterAkademik;

class MasterAkademikController extends Controller
{
 public function index()
{
    $akademik = MasterAkademik::paginate(10); 
    return view('dashboard.master-data.tahun-akademik.index', compact('akademik'));
}

 public function create()
    {
        return view('dashboard.master-data.tahun-akademik.create');
    }

    public function store(Request $request)
    {
      $request->validate([
    'tahun_akademik' => 'required|string|max:50|unique:master_akademik,tahun_akademik',
    'tahun_mulai'    => 'required|integer',
    'tahun_selesai'  => 'required|integer|gt:tahun_mulai',
]);


        MasterAkademik::create([
            'tahun_akademik' => $request->tahun_akademik,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
        ]);

        return redirect()->route('master.tahun_akademik')->with('success', 'Tahun Akademik berhasil ditambahkan.');
    }


}