@extends('layouts.app')

@section('title', 'Kategori Klinis - Admin RSHP')

@section('content')
    <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06)">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
            <h2 style="color:#2463d6;font-size:1.75rem;margin:0">Data Kategori Klinis</h2>
            <a href="#" style="background:#2463d6;color:#fff;padding:0.75rem 1.5rem;border-radius:6px;text-decoration:none;font-weight:600;transition:background 0.2s">
                + Tambah Kategori Klinis
            </a>
        </div>

        @if(session('success'))
            <div style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:1rem;border-radius:6px;margin-bottom:1.5rem">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;margin-top:1rem">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:2px solid #e5e7eb">
                        <th style="padding:1rem;text-align:left;font-weight:600;color:#1f2937">No</th>
                        <th style="padding:1rem;text-align:left;font-weight:600;color:#1f2937">ID</th>
                        <th style="padding:1rem;text-align:left;font-weight:600;color:#1f2937">Nama Kategori Klinis</th>
                        <th style="padding:1rem;text-align:center;font-weight:600;color:#1f2937">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoriKlinis as $index => $item)
                    <tr style="border-bottom:1px solid #e5e7eb;transition:background 0.2s" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding:1rem;color:#6b7280">{{ $index + 1 }}</td>
                        <td style="padding:1rem;color:#374151;font-weight:500">{{ $item->idkategori_klinis }}</td>
                        <td style="padding:1rem;color:#374151">{{ $item->nama_kategori_klinis }}</td>
                        <td style="padding:1rem;text-align:center">
                            <a href="#" style="background:#18a18a;color:#fff;padding:0.5rem 1rem;border-radius:4px;text-decoration:none;font-size:0.875rem;margin-right:0.5rem">Edit</a>
                            <a href="#" style="background:#dc2626;color:#fff;padding:0.5rem 1rem;border-radius:4px;text-decoration:none;font-size:0.875rem" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding:2rem;text-align:center;color:#6b7280">
                            Belum ada data kategori klinis
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:1.5rem">
            <a href="{{ route('admin.dashboard') }}" style="background:#6b7280;color:#fff;padding:0.75rem 1.5rem;border-radius:6px;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem">
                <span>←</span> Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection
