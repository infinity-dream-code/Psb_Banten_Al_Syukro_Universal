<?php

namespace App\Http\Controllers;

use App\Models\MasterUjian;
use Illuminate\Http\Request;
use App\Models\Ujian;

class MasterUjianController extends Controller
{
    public function index()
    {
        $ujian = MasterUjian::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.master-data.ujian.index', compact('ujian'));
    }

    public function create()
    {
        return view('dashboard.master-data.ujian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:master_ujian,nama',
        ]);

        MasterUjian::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('master.ujian')->with('success', 'Data ujian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ujian = MasterUjian::findOrFail($id);
        return view('dashboard.master-data.ujian.edit', compact('ujian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:master_ujian,nama,' . $id,
        ]);

        $ujian = MasterUjian::findOrFail($id);

        $ujian->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('master.ujian')->with('success', 'Data ujian berhasil diperbarui.');
    }

   public function destroy($id)
{
    $ujian = MasterUjian::findOrFail($id);

    $dipakai = Ujian::where('id_master_ujian', $ujian->id)->exists();
    if ($dipakai) {
        return redirect()->route('master.ujian')
            ->with('error', 'Data ujian tidak bisa dihapus karena sudah digunakan di tabel ujian.');
    }

    $ujian->delete();

    return redirect()->route('master.ujian')->with('success', 'Data ujian berhasil dihapus.');
}

}
