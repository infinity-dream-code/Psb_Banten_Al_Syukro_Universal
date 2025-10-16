<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterRuang;

class MasterRuangController extends Controller
{
    public function index()
    {
        $data = MasterRuang::latest()->get();
        return view('dashboard.master-data.ruang.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.master-data.ruang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);

        MasterRuang::create([
            'ruang' => $request->ruang,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('master.ruang')->with('success', 'Data ruang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = MasterRuang::findOrFail($id);
        return view('dashboard.master-data.ruang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ruang' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $data = MasterRuang::findOrFail($id);
        $data->update([
            'ruang' => $request->ruang,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('master.ruang')->with('success', 'Data ruang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = MasterRuang::findOrFail($id);
        $data->delete();
        return redirect()->route('master.ruang')->with('success', 'Data ruang berhasil dihapus.');
    }
}
