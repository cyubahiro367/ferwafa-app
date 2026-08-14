@extends('layouts.admin')

@section('title', 'Add Photo')

@section('content')
    <a class="fw-admin-back" href="{{ route('admin.gallery.list') }}">← Back to Gallery</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Add Photo</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('post.photo') }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @if (session()->has('message'))
                    <div class="fw-admin-flash fw-admin-flash-error">{{ session()->get('message') }}</div>
                @endif

                <div class="fw-admin-form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="imageInput">Select Image</label>
                    <input type="file" id="imageInput" name="image" class="fw-admin-form-control">
                    @error('image')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Publish</button>
            </form>
        </div>
    </div>
@endsection
