<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.prodi.tambah-pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembayaran' => 'required|string|max:255'
        ]);

        Bayar::create([
            'nama_pembayaran' => $request->nama_pembayaran
        ]);

        return redirect('PmbMstPendaftarans/setting')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bayar $bayar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bayar $bayar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bayar $bayar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bayar $bayar)
    {
        //
    }
}
