@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Dashboard Perawat</h2>
        <span class="badge bg-success">{{ session('user_name') }}</span>
    </div>

    <div class="alert alert-success">
        <strong>Selamat datang, {{ session('user_name') }}!</strong><br>
        Role: <strong>{{ session('user_role_name') }}</strong>
    </div>

    {{-- Pet dalam Perawatan 7 Hari Terakhir --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>🐾 Pet Dalam Perawatan (7 Hari Terakhir - Read Only)</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama Pet</th>
                            <th>Jenis/Ras</th>
                            <th>Pemilik</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($petsInCare as $pet)
                        <tr>
                            <td><strong>{{ $pet->nama }}</strong></td>
                            <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }} / {{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                            <td>{{ $pet->pemilik->user->name ?? '-' }}</td>
                            <td>{{ $pet->rekamMedis->first()->created_at->format('d/m/Y H:i') ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada pet dalam perawatan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Detail Treatment --}}
    <div class="card">
        <div class="card-header bg-info text-white">
            <strong>💉 Detail Treatment/Tindakan Terbaru (Read Only)</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pet</th>
                            <th>Kode Tindakan</th>
                            <th>Deskripsi Tindakan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($treatments as $treatment)
                        <tr>
                            <td>{{ $treatment->created_at->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $treatment->rekamMedis->pet->nama ?? '-' }}</strong></td>
                            <td><span class="badge bg-warning">{{ $treatment->kodeTindakanTerapi->kode ?? '-' }}</span></td>
                            <td>{{ Str::limit($treatment->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-', 40) }}</td>
                            <td>{{ Str::limit($treatment->detail, 40) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data treatment</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
