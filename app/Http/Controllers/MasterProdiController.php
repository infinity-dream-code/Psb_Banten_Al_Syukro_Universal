<?php

namespace App\Http\Controllers;

use App\Models\MasterProdi;
use App\Models\MasterHarga;
use App\Models\MasterFakultas;
use Illuminate\Http\Request;

class MasterProdiController extends Controller
{
    public function index()
    {
        $sekolah = MasterProdi::with('fakultas')->paginate(10);
        return view('dashboard.master-data.sekolah.index', compact('sekolah'));
    }

    public function create()
    {
        $fakultas = MasterFakultas::all();
        return view('dashboard.master-data.sekolah.create', compact('fakultas'));
    }

public function store(Request $request)
{

    $request->validate([
        'id_fakultas' => 'required|exists:master_fakultas,id',
        'nama' => 'required|string|max:255',
    ]);

    MasterProdi::create([
        'id_fakultas' => $request->id_fakultas,
        'nama' => $request->nama
    ]);

    return redirect('PmbMstPendaftarans/master-sekolah')->with('success', 'Program Studi berhasil ditambahkan');
}


    public function edit($id)
{
    $prodi = MasterProdi::with('fakultas')->findOrFail($id);
    $fakultas = MasterFakultas::all(); 
    return view('dashboard.master-data.sekolah.edit', compact('prodi', 'fakultas'));
}


   public function update(Request $request, $id)
{
    $prodi = MasterProdi::findOrFail($id);

    $request->validate([
        'id_fakultas' => 'required|exists:master_fakultas,id', 
        'nama' => 'required|string|max:255',
    ]);

    $prodi->id_fakultas = $request->id_fakultas;
    $prodi->nama = $request->nama;
    $prodi->save();

    return redirect()->route('master.sekolah')
                     ->with('success', 'Data berhasil diperbarui');
}


    public function destroy($id)
{
    $prodi = MasterProdi::findOrFail($id);

    $dipakai = MasterHarga::where('id_prodi', $prodi->id)->exists();
    if ($dipakai) {
        return redirect()->route('master.sekolah')
            ->with('error', 'Sekolah tidak bisa dihapus karena sudah digunakan di Master Harga');
    }

    $prodi->delete();

    return redirect()->route('master.sekolah')->with('success', 'Data berhasil dihapus');
}

}
