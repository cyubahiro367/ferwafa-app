@extends('layouts.admin')

@section('title', 'Create game')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Create game</h1>
            <p>Schedule a fixture for this division and category.</p>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            @if (session()->has('error'))
                <div class="fw-admin-flash fw-admin-flash-error">{{ session()->get('error') }}</div>
            @endif

            <form method="POST"
                action="{{ route('create.game', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                enctype="multipart/form-data"
                class="fw-admin-submit-guard">
                @csrf

                @if (request()->route('divisionID') == 2)
                    <div class="fw-admin-form-group">
                        <label for="groupID">Select Group</label>
                        <select name="groupID" id="groupID" class="fw-admin-form-control">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="fw-admin-form-group">
                    <label for="dayID">Day</label>
                    <select name="dayID" id="dayID" class="fw-admin-form-control">
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="homeTeamID">Home Team</label>
                    <select name="homeTeamID" id="homeTeamID" class="fw-admin-form-control">
                        @foreach ($teams as $team)
                            <option value="{{ $team['id'] }}">{{ $team['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="awayTeamID">Away Team</label>
                    <select name="awayTeamID" id="awayTeamID" class="fw-admin-form-control">
                        @foreach ($teams as $team)
                            <option value="{{ $team['id'] }}">{{ $team['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="date">Date</label>
                    <input type="datetime-local" name="date" id="date" class="fw-admin-form-control">
                    @error('date')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="seasonID">Season</label>
                    <select name="seasonID" id="seasonID" class="fw-admin-form-control">
                        @foreach ($seasons as $season)
                            <option value="{{ $season['id'] }}">{{ $season['from'] }} - {{ $season['to'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="stade">Stade</label>
                    <input type="text" name="stade" id="stade" class="fw-admin-form-control">
                    @error('stade')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
