<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGelombang;
use App\Models\MasterAkademik;

class MasterGelombangController extends Controller
{
    public function index()
    {
        $gelombang = MasterGelombang::with('akademik')->paginate(10);
        return view('dashboard.master-data.gelombang.index', compact('gelombang'));
    }

    public function create()
    {
        $akademik = MasterAkademik::all();
        return view('dashboard.master-data.gelombang.create', compact('akademik'));
    }

public function store(Request $request)
{
    $request->validate([
        'tahun_akademik' => 'required|string',
        'start'          => 'required|date',
        'end'            => 'required|date|after_or_equal:start',
        'pengumuman'     => 'required|date|after_or_equal:end',
    ]);

    $tahun = date('Y', strtotime($request->start));

    $last = MasterGelombang::where('tahun', $tahun)->max('gelombang');
    $next = $last ? $last + 1 : 1;

    if ($next > 9) {
        return redirect()->back()->withErrors([
            'gelombang' => "Tahun {$tahun} sudah punya 9 gelombang, tidak bisa tambah lagi."
        ])->withInput();
    }

    MasterGelombang::create([
        'tahun'          => $tahun,
        'gelombang'      => $next,
        'tahun_akademik' => $request->tahun_akademik,
        'start'          => $request->start,
        'end'            => $request->end,
        'pengumuman'     => $request->pengumuman,
        'is_active'      => 1,
    ]);

    return redirect()->route('master.gelombang')
        ->with('success', "Gelombang ke-{$next} untuk tahun {$tahun} berhasil ditambahkan");
}

public function edit($id)
{
    $gelombang = MasterGelombang::findOrFail($id);
    return view('dashboard.master-data.gelombang.edit', compact('gelombang'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'start'      => 'required|date',
        'end'        => 'required|date|after_or_equal:start',
        'pengumuman' => 'required|date|after_or_equal:end',
    ]);

    $gelombang = MasterGelombang::findOrFail($id);

    $gelombang->update([
        'start'      => $request->start,
        'end'        => $request->end,
        'pengumuman' => $request->pengumuman,
    ]);

    return redirect()->route('master.gelombang')
        ->with('success', "Gelombang ke-{$gelombang->gelombang} berhasil diperbarui");
}



    public function destroy($id)
    {
        $gelombang = MasterGelombang::findOrFail($id);

        if ($gelombang->harga()->exists()) {
            return redirect()->route('master.gelombang')
                ->with('error', 'Gelombang tidak bisa dihapus karena sudah dipakai di Master Harga.');
        }

        $gelombang->delete();

        return redirect()->route('master.gelombang')
            ->with('success', 'Gelombang berhasil dihapus.');
    }
}
