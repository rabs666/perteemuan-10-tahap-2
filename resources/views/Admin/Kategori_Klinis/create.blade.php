@extends('layouts.app')

@section('title', 'Tambah Kategori Klinis - Admin RSHP')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Kategori Klinis</h4>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.kategori_klinis.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_kategori_klinis" class="form-label">Nama Kategori Klinis <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('nama_kategori_klinis') is-invalid @enderror" 
                        id="nama_kategori_klinis" 
                        name="nama_kategori_klinis" 
                        value="{{ old('nama_kategori_klinis') }}"
                        placeholder="Contoh: Dermatologi, Kardiologi"
                        required
                    >
                    @error('nama_kategori_klinis')
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
                    <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
