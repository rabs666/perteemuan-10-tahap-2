@extends('layouts.app')

@section('title', 'Login - RSHP')

@section('content')
    <main class="container" style="padding:2rem 0">
        <div class="login-box" style="max-width:400px;margin:0 auto;padding:2rem;border:1px solid #ddd;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
            <h2 style="color:#2463d6;text-align:center;margin-bottom:1.5rem">Login</h2>
            
            @if(session('success'))
                <div style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:0.75rem;border-radius:4px;margin-bottom:1rem">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background:#fee;border:1px solid #fcc;color:#c33;padding:0.75rem;border-radius:4px;margin-bottom:1rem">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background:#fee;border:1px solid #fcc;color:#c33;padding:0.75rem;border-radius:4px;margin-bottom:1rem">
                    <ul style="margin:0;padding-left:1.5rem">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div style="margin-bottom:1rem">
                    <label style="display:block;margin-bottom:0.5rem;color:#1f2937;font-weight:500">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="width:100%;padding:0.75rem;border:1px solid #ddd;border-radius:4px;font-size:1rem" />
                </div>
                <div style="margin-bottom:1rem">
                    <label style="display:block;margin-bottom:0.5rem;color:#1f2937;font-weight:500">Password</label>
                    <input type="password" name="password" required style="width:100%;padding:0.75rem;border:1px solid #ddd;border-radius:4px;font-size:1rem" />
                </div>
                <div style="margin-bottom:1.5rem">
                    <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer">
                        <input type="checkbox" name="remember" style="width:18px;height:18px;cursor:pointer">
                        <span style="color:#6b7280;font-size:0.875rem">Ingat Saya</span>
                    </label>
                </div>
                <button type="submit" style="width:100%;padding:0.75rem;background:#2463d6;color:#fff;border:none;border-radius:4px;font-size:1rem;font-weight:600;cursor:pointer;transition:background 0.2s">Masuk</button>
            </form>
        </div>
    </main>
@endsection