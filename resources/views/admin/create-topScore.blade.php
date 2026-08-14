@extends('layouts.admin')

@section('title', 'Create Top Score')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Create Top Score</h1>
            <p>Add a goal scorer for this division and category.</p>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST"
                action="{{ route('create.top-score', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                enctype="multipart/form-data"
                class="fw-admin-submit-guard">
                @csrf

                <div class="fw-admin-form-group">
                    <label for="seasonID">Season</label>
                    <select name="seasonID" id="seasonID" class="fw-admin-form-control">
                        @foreach ($seasons as $season)
                            <option value="{{ $season['id'] }}">{{ $season['from'] }} - {{ $season['to'] }}</option>
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
                    <label for="goals">Goals</label>
                    <input type="number" name="goals" id="goals" class="fw-admin-form-control">
                    @error('goals')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="teamID">Team</label>
                    <select name="teamID" id="teamID" class="fw-admin-form-control">
                        @foreach ($teams as $team)
                            <option value="{{ $team['id'] }}">{{ $team['name'] }}</option>
                        @endforeach
                    </select>
                    @error('teamID')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
