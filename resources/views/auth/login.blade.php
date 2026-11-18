@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="container-sm" style="padding-top: 60px; padding-bottom: 60px;">
    <div class="card">
        <div class="card-body" style="padding: 40px;">
            <div style="margin-bottom: 32px;">
                <h1 style="font-size: 22px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 6px;">Masuk ke akun Anda</h1>
                <p style="color: var(--color-gray-500); font-size: 14px;">Belum punya akun? <a href="{{ route('register') }}" style="color: var(--color-primary); font-weight: 500;">Daftar sekarang</a></p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="nama@email.com"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="remember" name="remember" style="accent-color: var(--color-primary);">
                    <label for="remember" style="font-size: 13px; color: var(--color-gray-600); cursor: pointer;">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 8px;">
                    Masuk
                </button>
            </form>

            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--color-gray-200); text-align: center;">
                <p style="font-size: 12px; color: var(--color-gray-400);">
                    Demo: user@workshoptix.com / password &nbsp;|&nbsp; admin@workshoptix.com / password
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
