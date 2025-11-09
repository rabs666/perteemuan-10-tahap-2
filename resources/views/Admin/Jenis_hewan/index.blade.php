@extends('layouts.app')

@section('title', 'Jenis Hewan - Admin RSHP')

@section('content')

    <div class="mb-3">
        <a href="{{ route('admin.jenis_hewan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jenis Hewan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr> 
                <th>No</th>
                <th>Nama Jenis Hewan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisHewan as $index => $hewan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $hewan->nama_jenis_hewan }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window. location='#'">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) {document.getElementById('delete-form-{{ $hewan->idjenis_hewan }}').submit(); }">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $hewan->idjenis_hewan }}" action="#" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>