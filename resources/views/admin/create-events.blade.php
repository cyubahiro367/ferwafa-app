@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')
    <a class="fw-admin-back" href="{{ route('events.view') }}">← Back to Events</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Create Event</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('post.event') }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf

                <div class="fw-admin-form-group">
                    <label for="name">Event Name</label>
                    <input type="text" name="name" id="name" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="date">Event Date</label>
                    <input type="text" name="date" id="date" class="fw-admin-form-control">
                    @error('date')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="statusID">status</label>
                    <select name="statusID" id="statusID" class="fw-admin-form-control">
                        <option value="1">publish</option>
                        <option value="2">draft</option>
                        <option value="3">unpublish</option>
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" id="image" class="fw-admin-form-control">
                    @error('image')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="summernote-simple"></textarea>
                    @error('description')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Publish</button>
            </form>
        </div>
    </div>
@endsection
