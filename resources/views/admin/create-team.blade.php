@extends('layouts.admin')

@section('title', 'Create Team')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Create Team</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('create.team', request()->route('categoryID')) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf

                <div class="fw-admin-form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" class="fw-admin-form-control">
                    @error('logo')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="categoryID">Category</label>
                    <select name="categoryID" id="categoryID" class="fw-admin-form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="divisionID">Division</label>
                    <select name="divisionID" id="divisionID" class="fw-admin-form-control">
                        @foreach($divisions as $division)
                            <option value="{{ $division['id'] }}">{{ $division['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
