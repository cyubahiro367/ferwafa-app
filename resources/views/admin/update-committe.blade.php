@extends('layouts.admin')

@section('title', 'Update Member')

@section('content')
    <a class="fw-admin-back" href="{{ route('committe') }}">← Back to Committee</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Update Member</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('update.committe',$committe->id) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $committe->name) }}" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" id="position" value="{{ old('position', $committe->position) }}" class="fw-admin-form-control">
                    @error('position')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="image">Select Image</label>
                    @if ($committe->image_url)
                        <div style="margin-bottom:10px;">
                            <a href="{{ route('comitte.doc', $committe->id) }}" target="_blank" rel="noopener" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">View current image</a>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="fw-admin-form-control" accept=".png,.jpg,.jpeg,image/png,image/jpeg">
                    <p class="fw-admin-muted" style="margin-top:8px;font-size:13px;">Square 1∶1, at least 600×600 px (recommended 900×900 px). Center face and shoulders. Leave empty to keep the current file.</p>
                    @error('image')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
