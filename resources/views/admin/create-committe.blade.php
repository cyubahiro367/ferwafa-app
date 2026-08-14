@extends('layouts.admin')

@section('title', 'Add Member')

@section('content')
    <a class="fw-admin-back" href="{{ route('committe') }}">← Back to Committee</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Add Member</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            @if (session()->has('error'))
                <div class="fw-admin-flash fw-admin-flash-error">{{ session()->get('error') }}</div>
            @endif

            <form method="POST" action="{{ route('create.committe') }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf

                <div class="fw-admin-form-group">
                    <label for="committeeCategoryID">Category</label>
                    <select name="committeeCategoryID" id="committeeCategoryID" class="fw-admin-form-control">
                        <option>Select Category</option>
                        @foreach($committees as $committee)
                            <option value="{{ $committee['id'] }}">{{ $committee['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" id="position" class="fw-admin-form-control">
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

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
