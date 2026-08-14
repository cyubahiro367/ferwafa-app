@extends('layouts.admin')

@section('title', 'Update Team Category')

@section('content')
    <a class="fw-admin-back" href="{{ route('team-category') }}">← Back to Categories</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Update Team Category</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('update.team-category', $teamCategory->id) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="name">Names</label>
                    <input type="text" name="name" id="name" value="{{$teamCategory->name}}" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
