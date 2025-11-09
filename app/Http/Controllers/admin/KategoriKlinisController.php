<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori_Klinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = Kategori_Klinis::all();
        return view('admin.kategori_klinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategori_klinis.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategoriKlinis($request);

        // Helper untuk menyimpan data
        $kategoriKlinis = $this->createKategoriKlinis($validatedData);

        return redirect()->route('admin.kategori_klinis.index')
            ->with('success', 'Kategori klinis berhasil ditambahkan.');
    }

    // Validation Helper
    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis' :
            'unique:kategori_klinis,nama_kategori_klinis';

        return $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada.',
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter.',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter.',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createKategoriKlinis(array $data)
    {
        try {
            return Kategori_Klinis::create([
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($data['nama_kategori_klinis']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori klinis: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaKategoriKlinis($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
