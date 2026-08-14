@extends('layouts.admin')

@section('title', 'Update Partner')

@section('content')
    <a class="fw-admin-back" href="{{ route('partner') }}">← Back to Partners</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Update Partner</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('update.partner', $partner->id) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" value="{{$partner->link}}" class="fw-admin-form-control">
                    @error('link')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" id="image" class="fw-admin-form-control">
                    @error('image')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
