@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Dashboard Administrator</h2>
        <span class="badge bg-success">{{ session('user_name') }}</span>
    </div>

    <div class="alert alert-info">
        <strong>Selamat datang, {{ session('user_name') }}!</strong><br>
        Role: <strong>{{ session('user_role_name') }}</strong>
    </div>

    {{-- Menu Data Master --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            <strong>Menu Data Master</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.jenis_hewan.index') }}" class="btn btn-outline-primary w-100">
                        Jenis Hewan
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.ras_hewan.index') }}" class="btn btn-outline-success w-100">
                        Ras Hewan
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-warning w-100">
                        Kategori
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-outline-info w-100">
                        Kategori Klinis
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary w-100">
                        Roles
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-outline-primary w-100">
                        Pemilik
                    </a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success w-100">
                        Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
