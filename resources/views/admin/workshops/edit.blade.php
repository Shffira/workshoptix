@extends('layouts.admin')

@section('title', 'Edit Workshop')
@section('page-title', 'Edit Workshop')
@section('page-description', 'Perbarui informasi dan jadwal workshop.')
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
            <form method="POST" action="{{ route('admin.workshops.update', $workshop) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="title">Judul Workshop</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $workshop->title) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" required style="min-height: 140px;">{{ old('description', $workshop->description) }}</textarea>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="speaker">Pembicara</label>
                        <input id="speaker" type="text" name="speaker" value="{{ old('speaker', $workshop->speaker) }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category">Kategori</label>
                        <input id="category" type="text" name="category" value="{{ old('category', $workshop->category) }}" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="location">Lokasi</label>
                    <input id="location" type="text" name="location" value="{{ old('location', $workshop->location) }}" class="form-control" required>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="start_at">Waktu Mulai</label>
                        <input id="start_at" type="datetime-local" name="start_at" value="{{ old('start_at', $workshop->start_at->format('Y-m-d\TH:i')) }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="end_at">Waktu Selesai</label>
                        <input id="end_at" type="datetime-local" name="end_at" value="{{ old('end_at', $workshop->end_at->format('Y-m-d\TH:i')) }}" class="form-control" required>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="quota">Kuota Peserta</label>
                        <input id="quota" type="number" name="quota" value="{{ old('quota', $workshop->quota) }}" class="form-control" required min="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Harga (Rupiah)</label>
                        <input id="price" type="number" name="price" value="{{ old('price', $workshop->price) }}" class="form-control" required min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="thumbnail">Thumbnail Baru <span style="color: var(--color-gray-400); font-weight: 400;">(opsional)</span></label>
                    @if($workshop->thumbnail)
                        <div style="margin-bottom: 8px;">
                            <img src="{{ Storage::url($workshop->thumbnail) }}" style="height: 60px; border-radius: 6px; border: 1px solid var(--color-gray-200);" alt="Thumbnail">
                        </div>
                    @endif
                    <input id="thumbnail" type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $workshop->is_active) ? 'checked' : '' }} style="accent-color: var(--color-primary); width: 16px; height: 16px;">
                        <span class="form-label" style="margin: 0;">Workshop aktif</span>
                    </label>
                </div>

                <div style="display: flex; gap: 10px; padding-top: 8px; border-top: 1px solid var(--color-gray-100); margin-top: 8px;">
                    <button type="submit" class="btn btn-primary btn-lg">Perbarui Workshop</button>
                    <a href="{{ route('admin.workshops.index') }}" class="btn btn-outline btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
