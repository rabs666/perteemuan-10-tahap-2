@extends('layouts.app')

@section('title', 'Tambah Ras Hewan - Admin RSHP')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Ras Hewan</h4>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.ras_hewan.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                    <select 
                        class="form-select @error('idjenis_hewan') is-invalid @enderror" 
                        id="idjenis_hewan" 
                        name="idjenis_hewan" 
                        required
                    >
                        <option value="">-- Pilih Jenis Hewan --</option>
                        @foreach($jenisHewan as $jenis)
                            <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                    @error('idjenis_hewan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_ras" class="form-label">Nama Ras <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('nama_ras') is-invalid @enderror" 
                        id="nama_ras" 
                        name="nama_ras" 
                        value="{{ old('nama_ras') }}"
                        placeholder="Contoh: Golden Retriever, Persian, Murai Batu"
                        required
                    >
                    @error('nama_ras')
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
                    <a href="{{ route('admin.ras_hewan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
