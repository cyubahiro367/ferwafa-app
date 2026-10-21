@extends('layouts.admin')

@section('title', 'Update Team')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            @include('partials.admin-competition-heading', ['heading' => 'Update Team'])
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('update.team',[request()->route('categoryID'), $team->id]) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="logo">Logo</label>
                    @if ($team->logo)
                        <div style="margin-bottom:10px;">
                            <a href="{{ route('team.doc', $team->id) }}" target="_blank" rel="noopener" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">View current logo</a>
                        </div>
                    @endif
                    <input type="file" name="logo" id="logo" class="fw-admin-form-control">
                    <p class="fw-admin-muted" style="margin-top:8px;font-size:13px;">Leave empty to keep the current file.</p>
                    @error('logo')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="categoryID">Category</label>
                    <select name="categoryID" id="categoryID" class="fw-admin-form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}" {{ (string) old('categoryID', $team->categoryID) === (string) $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="divisionID">Division</label>
                    <select name="divisionID" id="divisionID" class="fw-admin-form-control">
                        @foreach($divisions as $division)
                            <option value="{{ $division['id'] }}" {{ (string) old('divisionID', $team->divisionID) === (string) $division['id'] ? 'selected' : '' }}>{{ $division['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
