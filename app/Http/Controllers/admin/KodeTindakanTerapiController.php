<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kode_Tindakan_Terapi;

class KategoriTindakanTerapiController extends Controller
{
    public function index()
    {
        $kodeTindakanTerapi = Kode_Tindakan_Terapi::all();
        return view('admin.kode_tindakan_terapi.index', compact('kodeTindakanTerapi'));
    }
}
