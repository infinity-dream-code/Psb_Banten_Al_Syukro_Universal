<?php

namespace App\Http\Controllers;

use App\Models\PembayaranSekolah;
use Illuminate\Http\Request;
use App\Models\MasterProdi;
use App\Models\Bayar;
use App\Models\MasterJalur;

class PembayaranSekolahController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PembayaranSekolah $pembayaranSekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $prodi = MasterProdi::findOrFail($id);
    $bayars = Bayar::orderBy('nama_pembayaran')->get();
    $jalurs = MasterJalur::orderBy('id')->get();

    return view('dashboard.settings.prodi.edit-pembayaran-sekolah', compact('prodi','bayars','jalurs'));
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id_prodi)
{
    $request->validate([
        'id_bayar' => 'required|exists:bayar,id',
        'pos' => 'nullable|string|max:50',
        'nominal' => 'required',
    ]);

    $nominal = (int) str_replace('.', '', $request->nominal);

    if ($request->has('jalur')) {
        foreach ($request->jalur as $id_jalur => $data) {
            if (isset($data['checked']) && $data['checked'] == 1) {
                $diskonPersen = (int) ($data['diskon'] ?? 0);
                $nominalDiskon = $nominal - ($nominal * $diskonPersen / 100);

                PembayaranSekolah::create([
                    'id_prodi' => $id_prodi,
                    'id_bayar' => $request->id_bayar,
                    'id_jalur' => $id_jalur,
                    'pos' => $request->pos,
                    'nominal' => $nominalDiskon,
                    'tagih_saat_regis' => $request->has('tagih_saat_regis') ? 1 : 0,
                    'diskon_by_jalur' => $diskonPersen,
                    'is_active' => 1,
                ]);
            }
        }
    }

    return redirect('PmbMstPendaftarans/setting')->with('success', 'Pembayaran sekolah berhasil disimpan');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PembayaranSekolah $pembayaranSekolah)
    {
        //
    }
}
