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
}
