@extends('layouts.admin')

@section('title', 'Create game')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            @include('partials.admin-competition-heading', ['heading' => 'Create game'])
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

                <div class="fw-admin-form-group">
                    <label for="seasonID">Season</label>
                    <select name="seasonID" id="seasonID" class="fw-admin-form-control" required>
                        <option value="" disabled @selected(old('seasonID') === null || old('seasonID') === '')>Select season…</option>
                        @foreach ($seasons as $season)
                            <option value="{{ $season['id'] }}"
                                data-plays-in-groups="{{ ($season['playsInGroups'] ?? true) ? '1' : '0' }}"
                                @selected((string) old('seasonID') === (string) $season['id'])>
                                {{ $season['from'] }} - {{ $season['to'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('seasonID')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                @if (($divisionID ?? request()->route('divisionID')) == 2)
                    <div class="fw-admin-form-group" id="groupFieldWrap" style="display:none;">
                        <label for="groupID">Select Group</label>
                        <select name="groupID" id="groupID" class="fw-admin-form-control">
                            <option value="" disabled @selected(old('groupID') === null || old('groupID') === '')>Select group…</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" @selected((string) old('groupID') === (string) $group->id)>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('groupID')
                            <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="fw-admin-form-group">
                    <label for="dayID">Day</label>
                    <select name="dayID" id="dayID" class="fw-admin-form-control" required>
                        <option value="" disabled @selected(old('dayID') === null || old('dayID') === '')>Select day…</option>
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}" @selected((string) old('dayID') === (string) $day->id)>{{ $day->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="homeTeamID">Home Team</label>
                    <select name="homeTeamID" id="homeTeamID" class="fw-admin-form-control" required>
                        <option value="" disabled @selected(old('homeTeamID') === null || old('homeTeamID') === '')>Select home team…</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team['id'] }}" @selected((string) old('homeTeamID') === (string) $team['id'])>{{ $team['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="awayTeamID">Away Team</label>
                    <select name="awayTeamID" id="awayTeamID" class="fw-admin-form-control" required>
                        <option value="" disabled @selected(old('awayTeamID') === null || old('awayTeamID') === '')>Select away team…</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team['id'] }}" @selected((string) old('awayTeamID') === (string) $team['id'])>{{ $team['name'] }}</option>
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

    @if (($divisionID ?? request()->route('divisionID')) == 2)
        <script>
            (function () {
                var seasonSelect = document.getElementById('seasonID');
                var groupWrap = document.getElementById('groupFieldWrap');
                var groupSelect = document.getElementById('groupID');
                if (!seasonSelect || !groupWrap || !groupSelect) {
                    return;
                }
                function syncGroupField() {
                    if (!seasonSelect.value) {
                        groupWrap.style.display = 'none';
                        groupSelect.required = false;
                        groupSelect.value = '';
                        return;
                    }
                    var option = seasonSelect.options[seasonSelect.selectedIndex];
                    var show = option && option.getAttribute('data-plays-in-groups') === '1';
                    groupWrap.style.display = show ? '' : 'none';
                    groupSelect.required = show;
                    if (!show) {
                        groupSelect.value = '';
                    }
                }
                seasonSelect.addEventListener('change', syncGroupField);
                syncGroupField();
            })();
        </script>
    @endif
@endsection
