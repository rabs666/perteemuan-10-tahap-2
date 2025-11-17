<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:255|unique:roles,nama_role'
        ]);

        try {
            DB::table('roles')->insert([
                'nama_role' => ucwords(strtolower($validated['nama_role'])),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $role = DB::table('roles')->where('id', $id)->first();
        
        if (!$role) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Data tidak ditemukan.');
        }
        
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:255|unique:roles,nama_role,' . $id
        ]);

        try {
            $updated = DB::table('roles')
                ->where('id', $id)
                ->update([
                    'nama_role' => ucwords(strtolower($validated['nama_role'])),
                    'updated_at' => now()
                ]);

            if ($updated) {
                return redirect()->route('admin.roles.index')
                    ->with('success', 'Role berhasil diupdate.');
            }

            return redirect()->back()
                ->with('error', 'Gagal mengupdate data.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = DB::table('roles')->where('id', $id)->delete();

            if ($deleted) {
                return redirect()->route('admin.roles.index')
                    ->with('success', 'Role berhasil dihapus.');
            }

            return redirect()->back()
                ->with('error', 'Gagal menghapus data.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
