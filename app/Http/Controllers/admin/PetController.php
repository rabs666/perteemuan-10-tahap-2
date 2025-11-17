<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function index()
    {
        $pets = DB::table('pet')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->select('pet.*', 'ras_hewan.nama_ras', 'pemilik.nama_pemilik')
            ->orderBy('pet.idpet', 'desc')
            ->paginate(10);
        
        return view('admin.pet.index', compact('pets'));
    }

    public function create()
    {
        $rasHewan = DB::table('ras_hewan')->get();
        $pemilik = DB::table('pemilik')->get();
        
        return view('admin.pet.create', compact('rasHewan', 'pemilik'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'idpemilik' => 'required|exists:pemilik,idpemilik'
        ]);

        try {
            DB::table('pet')->insert([
                'nama' => ucwords(strtolower($validated['nama'])),
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'warna_tanda' => $validated['warna_tanda'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'idras_hewan' => $validated['idras_hewan'],
                'idpemilik' => $validated['idpemilik'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('admin.pet.index')
                ->with('success', 'Data pet berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $pet = DB::table('pet')->where('idpet', $id)->first();
        
        if (!$pet) {
            return redirect()->route('admin.pet.index')
                ->with('error', 'Data tidak ditemukan.');
        }
        
        $rasHewan = DB::table('ras_hewan')->get();
        $pemilik = DB::table('pemilik')->get();
        
        return view('admin.pet.edit', compact('pet', 'rasHewan', 'pemilik'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'idpemilik' => 'required|exists:pemilik,idpemilik'
        ]);

        try {
            $updated = DB::table('pet')
                ->where('idpet', $id)
                ->update([
                    'nama' => ucwords(strtolower($validated['nama'])),
                    'tanggal_lahir' => $validated['tanggal_lahir'],
                    'warna_tanda' => $validated['warna_tanda'],
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'idras_hewan' => $validated['idras_hewan'],
                    'idpemilik' => $validated['idpemilik'],
                    'updated_at' => now()
                ]);

            if ($updated) {
                return redirect()->route('admin.pet.index')
                    ->with('success', 'Data pet berhasil diupdate.');
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
            $deleted = DB::table('pet')->where('idpet', $id)->delete();

            if ($deleted) {
                return redirect()->route('admin.pet.index')
                    ->with('success', 'Data pet berhasil dihapus.');
            }

            return redirect()->back()
                ->with('error', 'Gagal menghapus data.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
