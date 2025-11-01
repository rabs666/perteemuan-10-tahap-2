@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Dashboard Resepsionis</h2>
        <span class="badge bg-warning text-dark">{{ session('user_name') }}</span>
    </div>

    <div class="alert alert-success">
        <strong>Selamat datang, {{ session('user_name') }}!</strong><br>
        Role: <strong>{{ session('user_role_name') }}</strong>
    </div>

    {{-- Menu Resepsionis --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong>Menu Resepsionis</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card border-primary">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pendaftaran</h5>
                            <p class="card-text">Daftar pasien baru</p>
                            <a href="#" class="btn btn-primary">Akses</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pemilik</h5>
                            <p class="card-text">Data pemilik pet</p>
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-success">Akses</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-info">
                        <div class="card-body text-center">
                            <h5 class="card-title">Jadwal</h5>
                            <p class="card-text">Jadwal konsultasi</p>
                            <a href="#" class="btn btn-info">Akses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
