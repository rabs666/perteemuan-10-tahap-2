@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Dashboard Pemilik</h2>
        <span class="badge bg-warning text-dark">{{ session('user_name') }}</span>
    </div>

    @if(isset($message))
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @else
        <div class="alert alert-info">
            <strong>Selamat datang, {{ session('user_name') }}!</strong><br>
            Role: <strong>{{ session('user_role_name') }}</strong>
        </div>

        {{-- Pet Milik Saya --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <strong>🐾 Pet Milik Saya (Read Only)</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($pets as $pet)
                    <div class="col-md-6 mb-3">
                        <div class="card border-info">
                            <div class="card-body">
                                <h5 class="card-title text-info">{{ $pet->nama }}</h5>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td><strong>Jenis:</strong></td>
                                        <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ras:</strong></td>
                                        <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ $pet->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Lahir:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Riwayat Kunjungan:</strong></td>
                                        <td><span class="badge bg-success">{{ $pet->rekamMedis->count() }}x</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Anda belum memiliki pet yang terdaftar</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Riwayat Rekam Medis --}}
        @if($pets->count() > 0)
        <div class="card">
            <div class="card-header bg-success text-white">
                <strong>📋 Riwayat Rekam Medis Pet Saya (Read Only)</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pet</th>
                                <th>Anamnesa</th>
                                <th>Diagnosa</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $hasRecords = false; @endphp
                            @foreach($pets as $pet)
                                @foreach($pet->rekamMedis as $rekam)
                                    @php $hasRecords = true; @endphp
                                    <tr>
                                        <td>{{ $rekam->created_at->format('d/m/Y H:i') }}</td>
                                        <td><strong>{{ $pet->nama }}</strong></td>
                                        <td>{{ Str::limit($rekam->anamnesa, 40) }}</td>
                                        <td>{{ Str::limit($rekam->diagnosa, 40) }}</td>
                                        <td>{{ $rekam->dokter_pemeriksa }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            @if(!$hasRecords)
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada riwayat rekam medis</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    @endif
</div>
@endsection
