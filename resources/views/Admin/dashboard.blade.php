@extends('layouts.app')

@section('title', 'Dashboard Admin - RSHP')

@section('content')
    <div style="margin-bottom:2rem">
        <h2 style="color:#2463d6;font-size:2rem;margin-bottom:0.5rem">Dashboard Admin</h2>
        <p style="color:#6b7280">Selamat datang, {{ Auth::user()->name }}</p>
    </div>

    {{-- Menu Grid --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem">
        
        {{-- Jenis Hewan --}}
        <a href="{{ route('admin.jenis_hewan.index') }}" style="text-decoration:none">
            <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="width:60px;height:60px;background:#e0f2fe;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    <span style="font-size:2rem">🐾</span>
                </div>
                <h3 style="color:#1f2937;font-size:1.25rem;margin-bottom:0.5rem">Jenis Hewan</h3>
                <p style="color:#6b7280;font-size:0.875rem">Kelola data jenis hewan</p>
            </div>
        </a>

        {{-- Ras Hewan --}}
        <a href="{{ route('admin.ras_hewan.index') }}" style="text-decoration:none">
            <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="width:60px;height:60px;background:#dcfce7;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    <span style="font-size:2rem">🐕</span>
                </div>
                <h3 style="color:#1f2937;font-size:1.25rem;margin-bottom:0.5rem">Ras Hewan</h3>
                <p style="color:#6b7280;font-size:0.875rem">Kelola data ras hewan</p>
            </div>
        </a>

        {{-- Kategori --}}
        <a href="{{ route('admin.kategori.index') }}" style="text-decoration:none">
            <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="width:60px;height:60px;background:#fef3c7;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    <span style="font-size:2rem">📁</span>
                </div>
                <h3 style="color:#1f2937;font-size:1.25rem;margin-bottom:0.5rem">Kategori</h3>
                <p style="color:#6b7280;font-size:0.875rem">Kelola data kategori</p>
            </div>
        </a>

        {{-- Kategori Klinis --}}
        <a href="{{ route('admin.kategori_klinis.index') }}" style="text-decoration:none">
            <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="width:60px;height:60px;background:#ddd6fe;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    <span style="font-size:2rem">🏥</span>
                </div>
                <h3 style="color:#1f2937;font-size:1.25rem;margin-bottom:0.5rem">Kategori Klinis</h3>
                <p style="color:#6b7280;font-size:0.875rem">Kelola data kategori klinis</p>
            </div>
        </a>

        {{-- Role --}}
        <a href="{{ route('admin.roles.index') }}" style="text-decoration:none">
            <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="width:60px;height:60px;background:#fecaca;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    <span style="font-size:2rem">👥</span>
                </div>
                <h3 style="color:#1f2937;font-size:1.25rem;margin-bottom:0.5rem">Role</h3>
                <p style="color:#6b7280;font-size:0.875rem">Kelola data role user</p>
            </div>
        </a>

        {{-- Users --}}
        <a href="{{ route('admin.users.index') }}" style="text-decoration:none">
            <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="width:60px;height:60px;background:#e0e7ff;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    <span style="font-size:2rem">👤</span>
                </div>
                <h3 style="color:#1f2937;font-size:1.25rem;margin-bottom:0.5rem">Users</h3>
                <p style="color:#6b7280;font-size:0.875rem">Kelola data pengguna</p>
            </div>
        </a>

        {{-- Pemilik --}}
        <a href="{{ route('admin.pemilik.index') }}" style="text-decoration:none">
            <div style="background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:transform 0.2s,box-shadow 0.2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                <div style="width:60px;height:60px;background:#fef3c7;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                    <span style="font-size:2rem">🏠</span>
                </div>
                <h3 style="color:#1f2937;font-size:1.25rem;margin-bottom:0.5rem">Pemilik</h3>
                <p style="color:#6b7280;font-size:0.875rem">Kelola data pemilik hewan</p>
            </div>
        </a>

    </div>
@endsection
