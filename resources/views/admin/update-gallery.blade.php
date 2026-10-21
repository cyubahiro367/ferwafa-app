@extends('layouts.admin')

@section('title', 'Update Photo')

@section('content')
    <a class="fw-admin-back" href="{{ route('admin.gallery.list') }}">← Back to Gallery</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Update Photo</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('update.photo', $gallery->id) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @method('PUT')
                @if (session()->has('message'))
                    <div class="fw-admin-flash fw-admin-flash-error">{{ session()->get('message') }}</div>
                @endif

                <div class="fw-admin-form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $gallery->name) }}" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="imageInput">Select Image</label>
                    @if ($gallery->url)
                        <div style="margin-bottom:10px;">
                            <a href="{{ route('gallery.doc', $gallery->id) }}" target="_blank" rel="noopener" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">View current image</a>
                        </div>
                    @endif
                    <input type="file" id="imageInput" name="image" class="fw-admin-form-control">
                    <p class="fw-admin-muted" style="margin-top:8px;font-size:13px;">Leave empty to keep the current file.</p>
                    @error('image')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
