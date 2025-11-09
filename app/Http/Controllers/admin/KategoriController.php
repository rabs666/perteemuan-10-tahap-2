<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategori($request);

        // Helper untuk menyimpan data
        $kategori = $this->createKategori($validatedData);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Validation Helper
    protected function validateKategori(Request $request, $id = null)
    {
        // Data yang bersifat unik
        $uniqueRule = $id ?
            'unique:kategori,nama_kategori,' . $id . ',idkategori' :
            'unique:kategori,nama_kategori';

        // Validasi data input
        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createKategori(array $data)
    {
        try {
            return Kategori::create([
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaKategori($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
