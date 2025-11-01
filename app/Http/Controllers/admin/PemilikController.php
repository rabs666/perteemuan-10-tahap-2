<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:users,id',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
        ]);

        Pemilik::create($request->all());

        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $users = User::all();
        return view('admin.pemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'iduser' => 'required|exists:users,id',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
        ]);

        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update($request->all());

        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();

        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil dihapus!');
    }
}
