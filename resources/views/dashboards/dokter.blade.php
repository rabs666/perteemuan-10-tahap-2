@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Dashboard Dokter</h2>
        <span class="badge bg-info">{{ session('user_name') }}</span>
    </div>

    <div class="alert alert-info">
        <strong>Selamat datang, dr. {{ session('user_name') }}!</strong><br>
        Role: <strong>{{ session('user_role_name') }}</strong>
    </div>

    {{-- Rekam Medis Terbaru --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>📋 Rekam Medis Terbaru (Read Only)</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pet</th>
                            <th>Jenis/Ras</th>
                            <th>Pemilik</th>
                            <th>Anamnesa</th>
                            <th>Diagnosa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis as $rekam)
                        <tr>
                            <td>{{ $rekam->created_at->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $rekam->pet->nama ?? '-' }}</strong></td>
                            <td>{{ $rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }} / {{ $rekam->pet->rasHewan->nama_ras ?? '-' }}</td>
                            <td>{{ $rekam->pet->pemilik->user->name ?? '-' }}</td>
                            <td>{{ Str::limit($rekam->anamnesa, 30) }}</td>
                            <td>{{ Str::limit($rekam->diagnosa, 30) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data rekam medis</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pet dalam Perawatan --}}
    <div class="card">
        <div class="card-header bg-success text-white">
            <strong>🐾 Pet yang Pernah Dirawat (Read Only)</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama Pet</th>
                            <th>Jenis</th>
                            <th>Ras</th>
                            <th>Pemilik</th>
                            <th>Total Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $pet)
                        <tr>
                            <td><strong>{{ $pet->nama }}</strong></td>
                            <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                            <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                            <td>{{ $pet->pemilik->user->name ?? '-' }}</td>
                            <td><span class="badge bg-primary">{{ $pet->rekamMedis->count() }}x</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data pet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
