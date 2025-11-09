@extends('layouts.app')

@section('title', 'Tambah Role - Admin RSHP')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Role</h4>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_role" class="form-label">Nama Role <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('nama_role') is-invalid @enderror" 
                        id="nama_role" 
                        name="nama_role" 
                        value="{{ old('nama_role') }}"
                        placeholder="Contoh: Administrator, Dokter, Perawat"
                        required
                    >
                    @error('nama_role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">Minimal 3 karakter, maksimal 255 karakter</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
