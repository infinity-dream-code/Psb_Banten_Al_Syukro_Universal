<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use App\Models\MasterProdi;

class TargetController extends Controller
{
   public function edit($prodiId)
{
    $prodi = MasterProdi::with('fakultas','latestTarget')->findOrFail($prodiId);

    if ($prodi->latestTarget) {
        $target = $prodi->latestTarget;
        return view('dashboard.settings.prodi.edit-target', compact('target'));
    } else {
        return view('dashboard.settings.prodi.create-target', compact('prodi'));
    }
}

public function store(Request $request, $prodiId)
{
    $request->validate([
        'target' => 'required|integer|min:0',
    ]);

  Target::create([
    'id_prodi' => $prodiId,
    'target'   => $request->target,
]);


    return redirect('PmbMstPendaftarans/setting')->with('success','Target berhasil ditambahkan');
}



    public function update(Request $request, $prodi)
    {
        $request->validate([
            'target' => 'required|integer|min:0',
        ]);

        $target = Target::findOrFail($prodi);
        $target->update([
            'target' => $request->target,
        ]);

        return redirect('PmbMstPendaftarans/setting')->with('success', 'Target berhasil diperbarui');
    }
}
