<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateRole($request);

        // Helper untuk menyimpan data
        $role = $this->createRole($validatedData);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    // Validation Helper
    protected function validateRole(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:role,nama_role,' . $id . ',idrole' :
            'unique:role,nama_role';

        return $request->validate([
            'nama_role' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_role.required' => 'Nama role wajib diisi.',
            'nama_role.unique' => 'Nama role sudah ada.',
            'nama_role.min' => 'Nama role minimal 3 karakter.',
            'nama_role.max' => 'Nama role maksimal 255 karakter.',
            'nama_role.string' => 'Nama role harus berupa teks.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createRole(array $data)
    {
        try {
            return Role::create([
                'nama_role' => $this->formatNamaRole($data['nama_role']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data role: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaRole($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
