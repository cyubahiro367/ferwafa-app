@extends('layouts.admin')

@section('title', 'Update Partner')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Update Partner</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST"
                action="{{ route('update.top-score', [request()->route('divisionID'), request()->route('categoryID'), $topScore->id]) }}"
                enctype="multipart/form-data"
                class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="seasonID">Season</label>
                    <select name="seasonID" id="seasonID" class="fw-admin-form-control">
                        @foreach ($seasons as $season)
                            <option value="{{ $season['id'] }}" {{ $topScore->seasonID === $season['id'] ? 'selected' : '' }}>
                                {{ $season['from'] }} - {{ $season['to'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="name">Names</label>
                    <input type="text" name="name" id="name" value="{{ $topScore->name }}" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="goals">Goals</label>
                    <input type="number" name="goals" id="goals" value="{{ $topScore->goals }}" class="fw-admin-form-control">
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

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
