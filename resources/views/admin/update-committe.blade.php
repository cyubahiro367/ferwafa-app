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
                    <input type="text" name="name" id="name" value="{{$committe->name}}" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" id="position" value="{{$committe->position}}" class="fw-admin-form-control">
                    @error('position')
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
