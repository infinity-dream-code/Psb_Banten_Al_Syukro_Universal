<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterRole;

class MasterRoleController extends Controller
{
    public function index()
    {
        $roles = MasterRole::all();
        return view('dashboard.master-data.role.index', compact('roles'));
    }

    public function create()
    {
        return view('dashboard.master-data.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
            'menu' => 'nullable|array'
        ]);

        MasterRole::create([
            'nama_role' => $request->nama_role,
            'menu' => $request->menu
        ]);

        return redirect()->route('master.role')->with('success', 'Role berhasil ditambahkan');
    }

    public function edit($id)
    {
        $role = MasterRole::findOrFail($id);
        return view('dashboard.master-data.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
            'menu' => 'nullable|array'
        ]);

        $role = MasterRole::findOrFail($id);
        $role->update([
            'nama_role' => $request->nama_role,
            'menu' => $request->menu
        ]);

        return redirect()->route('master.role')->with('success', 'Role berhasil diperbarui');
    }

    public function destroy($id)
    {
        $role = MasterRole::findOrFail($id);
        $role->delete();

        return redirect()->route('master.role')->with('success', 'Role berhasil dihapus');
    }
}
