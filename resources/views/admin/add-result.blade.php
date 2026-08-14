@extends('layouts.admin')

@section('title', 'Add Goal Results')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Add Goal Results</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST"
                  action="{{ route('create.game.result', [request()->route('divisionID'), request()->route('categoryID'), $gameID]) }}"
                  enctype="multipart/form-data"
                  class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="homeTeamGoals">{{ $team->homeTeam }}</label>
                    <input type="hidden" name="homeTeamID" value="{{ $team->homeTeamID }}">
                    <input type="number" name="homeTeamGoals" id="homeTeamGoals" class="fw-admin-form-control" min="0">
                    @error('homeTeamGoals')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="awayTeamGoals">{{ $team->awayTeam }}</label>
                    <input type="hidden" name="awayTeamID" value="{{ $team->awayTeamID }}">
                    <input type="number" name="awayTeamGoals" id="awayTeamGoals" class="fw-admin-form-control" min="0">
                    @error('awayTeamGoals')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
