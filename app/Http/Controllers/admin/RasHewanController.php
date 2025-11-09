<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.ras_hewan.index', compact('rasHewan'));
    }

    public function create()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.ras_hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateRasHewan($request);

        // Helper untuk menyimpan data
        $rasHewan = $this->createRasHewan($validatedData);

        return redirect()->route('admin.ras_hewan.index')
            ->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    // Validation Helper
    protected function validateRasHewan(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:ras_hewan,nama_ras,' . $id . ',idras_hewan' :
            'unique:ras_hewan,nama_ras';

        return $request->validate([
            'nama_ras' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
            'idjenis_hewan' => [
                'required',
                'exists:jenis_hewan,idjenis_hewan'
            ],
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi.',
            'nama_ras.unique' => 'Nama ras hewan sudah ada.',
            'nama_ras.min' => 'Nama ras hewan minimal 3 karakter.',
            'nama_ras.max' => 'Nama ras hewan maksimal 255 karakter.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
            'idjenis_hewan.exists' => 'Jenis hewan yang dipilih tidak valid.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createRasHewan(array $data)
    {
        try {
            return RasHewan::create([
                'nama_ras' => $this->formatNamaRasHewan($data['nama_ras']),
                'idjenis_hewan' => $data['idjenis_hewan'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data ras hewan: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaRasHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
