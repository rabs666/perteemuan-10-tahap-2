<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik as PemilikModel;
use Illuminate\Http\Request;

class PemilikDashboardController extends Controller
{
    public function index()
    {
        // Ambil data pemilik dari user yang login
        $pemilik = PemilikModel::where('iduser', auth()->user()->iduser)->first();
        
        if (!$pemilik) {
            return view('dashboards.pemilik')->with('message', 'Anda belum terdaftar sebagai pemilik pet.');
        }
        
        // Ambil HANYA pet milik user yang login
        $pets = Pet::where('idpemilik', $pemilik->idpemilik)
            ->with(['rasHewan.jenisHewan', 'rekamMedis' => function($q) {
                $q->orderBy('created_at', 'desc');
            }])
            ->get();
        
        return view('dashboards.pemilik', compact('pets', 'pemilik'));
    }
}
