@extends('layouts.app')

@section('title', $workshop->title)

@section('content')
<div class="container" style="padding-top: 32px;">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('workshops.index') }}" style="font-size: 13px; color: var(--color-gray-500); font-weight: 500; display: inline-flex; align-items: center; gap: 4px;">
            &larr; Kembali ke daftar workshop
        </a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 320px; gap: 32px; align-items: start;">
        {{-- Main Content --}}
        <div>
            @if($workshop->thumbnail)
                <img src="{{ Storage::url($workshop->thumbnail) }}" alt="{{ $workshop->title }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: var(--radius-lg); margin-bottom: 24px;">
            @else
                <div style="width: 100%; height: 220px; background: linear-gradient(135deg, var(--color-primary-light) 0%, #dbeafe 100%); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                    <span style="font-size: 14px; font-weight: 600; color: var(--color-primary); letter-spacing: 1px; text-transform: uppercase;">{{ $workshop->category }}</span>
                </div>
            @endif

            <div style="margin-bottom: 8px;">
                <span class="badge badge-blue">{{ $workshop->category }}</span>
            </div>

            <h1 style="font-size: 26px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 20px; line-height: 1.3; letter-spacing: -0.5px;">{{ $workshop->title }}</h1>

            <div class="card">
                <div class="card-body">
                    <h2 style="font-size: 15px; font-weight: 600; color: var(--color-gray-800); margin-bottom: 12px;">Deskripsi Workshop</h2>
                    <p style="color: var(--color-gray-600); line-height: 1.8; font-size: 14px; white-space: pre-line;">{{ $workshop->description }}</p>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div style="position: sticky; top: 80px;">
            <div class="card">
                <div class="card-body">
                    <div style="font-size: 26px; font-weight: 700; color: var(--color-primary); margin-bottom: 20px;">
                        {{ $workshop->formatted_price }}
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                        <div>
                            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 2px;">Tanggal</div>
                            <div style="font-size: 13px; color: var(--color-gray-700); font-weight: 500;">{{ $workshop->start_at->format('l, d F Y') }}</div>
                        </div>

                        <div>
                            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 2px;">Waktu</div>
                            <div style="font-size: 13px; color: var(--color-gray-700); font-weight: 500;">{{ $workshop->start_at->format('H:i') }} - {{ $workshop->end_at->format('H:i') }} WIB</div>
                        </div>

                        <div>
                            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 2px;">Lokasi</div>
                            <div style="font-size: 13px; color: var(--color-gray-700); font-weight: 500;">{{ $workshop->location }}</div>
                        </div>

                        <div>
                            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 2px;">Pembicara</div>
                            <div style="font-size: 13px; color: var(--color-gray-700); font-weight: 500;">{{ $workshop->speaker }}</div>
                        </div>

                        <div>
                            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 2px;">Kuota</div>
                            @php $remaining = $workshop->quota - $registeredCount; @endphp
                            <div style="font-size: 13px; color: var(--color-gray-700); font-weight: 500;">
                                {{ $registeredCount }}/{{ $workshop->quota }} peserta
                                @if($remaining <= 0)
                                    <span class="badge badge-red" style="margin-left: 6px;">Penuh</span>
                                @elseif($remaining <= 5)
                                    <span class="badge badge-yellow" style="margin-left: 6px;">Sisa {{ $remaining }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="border-top: 1px solid var(--color-gray-100); padding-top: 16px;">
                        @auth
                            @if($isRegistered)
                                <div class="alert alert-success" style="margin-bottom: 0; text-align: center; font-size: 13px;">
                                    Anda sudah terdaftar di workshop ini.
                                    <br>
                                    <a href="{{ route('registrations.index') }}" style="color: var(--color-green-700); font-weight: 600; margin-top: 4px; display: inline-block;">Lihat pendaftaran saya</a>
                                </div>
                            @elseif($remaining <= 0)
                                <button class="btn btn-outline btn-block" disabled style="cursor: not-allowed; opacity: 0.6;">
                                    Kuota Penuh
                                </button>
                            @else
                                <form method="POST" action="{{ route('registrations.store', $workshop->slug) }}" onsubmit="return confirm('Konfirmasi pendaftaran workshop ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-block btn-lg" style="display: flex;">
                                Masuk untuk Mendaftar
                            </a>
                            <p style="text-align: center; font-size: 12px; color: var(--color-gray-400); margin-top: 10px;">
                                Belum punya akun? <a href="{{ route('register') }}" style="color: var(--color-primary);">Daftar gratis</a>
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
