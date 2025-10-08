<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    public function index()
    {
        $data = Informasi::all();
        return view('dashboard.settings.informasi.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.settings.informasi.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'informasi' => 'required|string',
    ]);

    if (Informasi::exists()) {
        return redirect()->route('informasi.index')
            ->with('error', 'Informasi sudah ada, tidak bisa menambah lebih dari 1.');
    }

    Informasi::create([
        'id_user' => Auth::id(),
        'informasi' => $request->informasi,
    ]);

    return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
}


    public function edit(string $id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('dashboard.settings.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, string $id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->update([
            'id_user' => Auth::id(),
            'informasi' => $request->validate([
                'informasi' => 'required|string',
            ])['informasi'],
        ]);

        return redirect()->route('informasi.index');
    }

    public function destroy(string $id)
    {
        Informasi::findOrFail($id)->delete();
        return redirect()->route('informasi.index');
    }
}
