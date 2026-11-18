@extends('layouts.admin')

@section('title', 'Tambah Workshop')
@section('page-title', 'Tambah Workshop Baru')
@section('page-description', 'Tambahkan workshop baru ke sistem WorkshopTIX.')
@section('content')
<div style="max-width: 720px;">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.workshops.index') }}" style="font-size: 13px; color: var(--color-gray-500);">&larr; Kembali</a>
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

    <div class="card">
        <div class="card-body" style="padding: 28px;">
            <form method="POST" action="{{ route('admin.workshops.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="title">Judul Workshop</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" class="form-control" required placeholder="Masukkan judul workshop">
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" required placeholder="Deskripsikan workshop ini..." style="min-height: 140px;">{{ old('description') }}</textarea>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="speaker">Pembicara</label>
                        <input id="speaker" type="text" name="speaker" value="{{ old('speaker') }}" class="form-control" required placeholder="Nama pembicara">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category">Kategori</label>
                        <input id="category" type="text" name="category" value="{{ old('category', 'IT') }}" class="form-control" required placeholder="Misal: Web Development">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="location">Lokasi</label>
                    <input id="location" type="text" name="location" value="{{ old('location') }}" class="form-control" required placeholder="Nama ruang atau gedung">
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="start_at">Waktu Mulai</label>
                        <input id="start_at" type="datetime-local" name="start_at" value="{{ old('start_at') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="end_at">Waktu Selesai</label>
                        <input id="end_at" type="datetime-local" name="end_at" value="{{ old('end_at') }}" class="form-control" required>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="quota">Kuota Peserta</label>
                        <input id="quota" type="number" name="quota" value="{{ old('quota') }}" class="form-control" required min="1" placeholder="Misal: 30">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Harga (Rupiah)</label>
                        <input id="price" type="number" name="price" value="{{ old('price') }}" class="form-control" required min="0" placeholder="Misal: 150000">
                        <div class="form-hint">Masukkan angka tanpa titik atau koma</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="thumbnail">Thumbnail <span style="color: var(--color-gray-400); font-weight: 400;">(opsional)</span></label>
                    <input id="thumbnail" type="file" name="thumbnail" class="form-control" accept="image/*">
                    <div class="form-hint">Format: JPG, PNG, WEBP. Maks: 2MB</div>
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }} style="accent-color: var(--color-primary); width: 16px; height: 16px;">
                        <span class="form-label" style="margin: 0;">Workshop aktif dan dapat didaftarkan</span>
                    </label>
                </div>

                <div style="display: flex; gap: 10px; padding-top: 8px; border-top: 1px solid var(--color-gray-100); margin-top: 8px;">
                    <button type="submit" class="btn btn-primary btn-lg">Simpan Workshop</button>
                    <a href="{{ route('admin.workshops.index') }}" class="btn btn-outline btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
