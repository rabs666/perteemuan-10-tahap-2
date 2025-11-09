@extends('layouts.app')

@section('title', 'Kategori - Admin RSHP')

@section('content')

    <div class="mb-3">
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
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
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window. location='#'">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) {document.getElementById('delete-form-{{ $kategori->idkategori }}').submit(); }">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $kategori->idkategori }}" action="#" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>