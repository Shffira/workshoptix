@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="container-sm" style="padding-top: 60px; padding-bottom: 60px;">
    <div class="card">
        <div class="card-body" style="padding: 40px;">
            <div style="margin-bottom: 32px;">
                <h1 style="font-size: 22px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 6px;">Buat akun baru</h1>
                <p style="color: var(--color-gray-500); font-size: 14px;">Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--color-primary); font-weight: 500;">Masuk di sini</a></p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                    >
                </div>

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
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon <span style="color: var(--color-gray-400); font-weight: 400;">(opsional)</span></label>
                    <input
                        id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="form-control"
                        placeholder="08xxxxxxxxxx"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 8px;">
                    Buat Akun
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
