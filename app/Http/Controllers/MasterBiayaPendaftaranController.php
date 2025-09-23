<?php

namespace App\Http\Controllers;

use App\Models\MasterFakultas;
use Illuminate\Http\Request;
use App\Models\MasterHarga;

class MasterBiayaPendaftaranController extends Controller
{
    
     public function index()
    {
        $unit = MasterFakultas::paginate(10);
        return view('dashboard.master-data.unit.index', compact('unit'));
    }

    public function create()
    {
        return view('dashboard.master-data.unit.create');
    }

       public function store(Request $request)
    {
        $request->validate([
            'fakultas' => 'required|string|max:255',
        ]);

        MasterFakultas::create([
            'fakultas' => $request->fakultas,
        ]);

        return redirect()->route('master.unit')->with('success', 'Fakultas berhasil ditambahkan.');
    }

   public function destroy($id)
{
    $unit = MasterFakultas::findOrFail($id);

    $dipakai = MasterHarga::where('id_fakultas', $unit->id)->exists();
    if ($dipakai) {
        return redirect()->route('master.unit')
            ->with('error', 'Unit tidak bisa dihapus karena sudah digunakan di Master Harga.');
    }

    $unit->delete();

    return redirect()->route('master.unit')
        ->with('success', 'Fakultas berhasil dihapus.');
}


  
public function edit($id)
{
    $biaya = MasterFakultas::findOrFail($id);
    return view('dashboard.master-data.unit.edit', compact('biaya'));
}
   
public function update(Request $request, $id)
{
    $biaya = MasterFakultas::findOrFail($id);

    $data = $request->validate([
        'fakultas' => 'required|string|max:150|unique:master_fakultas,fakultas,' . $biaya->id,
    ]);

    $data['aktif'] = 1;

    $biaya->update($data);

    return redirect('PmbMstPendaftarans/master-unit')->with('success', 'succes diupdate');
}

   
  
}
