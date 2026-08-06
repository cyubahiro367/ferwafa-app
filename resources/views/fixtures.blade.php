@extends('layouts.public')

@section('title', 'Fixtures – FERWAFA')
@section('active', 'competitions')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Competitions',
    'title' => 'Fixtures & Results',
    'crumb' => [
        ['label' => 'Competitions'],
        ['label' => $day->name ?? 'Fixtures'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <form action="{{ route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $day->id ?? 1, request()->route('groupID')]) }}" method="GET" style="display:flex;flex-wrap:wrap;gap:16px;align-items:flex-end;margin-bottom:28px;">
            <div class="fw-form-group" style="margin:0;min-width:180px;">
                <label class="fw-form-label" for="seasonSelect">Season</label>
                <select id="seasonSelect" name="seasonID" class="fw-form-select" required>
                    @foreach ($seasons as $season)
                        <option value="{{ $season['id'] }}" {{ (int)$seasonID === (int)$season['id'] ? 'selected' : '' }}>
                            {{ $season['from'] }} - {{ $season['to'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="fw-form-group" style="margin:0;min-width:140px;">
                <label class="fw-form-label" for="daySelect">Matchday</label>
                <select id="daySelect" name="dayID" class="fw-form-select" required>
                    @foreach ($days as $value)
                        <option value="{{ $value->id }}" {{ ($day->id ?? null) == $value->id ? 'selected' : '' }}>
                            {{ $value->abbreviation ?? $value->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="fw-btn-gold">Show Matches</button>
        </form>

        <div class="fw-day-nav" style="margin-bottom:28px;">
            @if ($day)
                <a class="fw-day-pill active" href="{{ route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $day->id, request()->route('groupID')]) }}">Results &amp; Fixtures</a>
                <a class="fw-day-pill" href="{{ route('men.first-division-table', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, request()->route('groupID')]) }}">Standings</a>
            @endif
        </div>

        @if (!is_null($day))
            <div class="fw-table-wrap">
                <table class="fw-table">
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align:center;">{{ $day->name }}</th>
                        </tr>
                        <tr>
                            <th>Home</th>
                            <th style="text-align:center;">Score / Kick-off</th>
                            <th>Away</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($games as $game)
                            <tr>
                                <td>{{ $game->homeTeam }}</td>
                                <td style="text-align:center;">
                                    @if ($game->isPlayed)
                                        <span class="fw-match-score">{{ $game->homeTeamGoals }} – {{ $game->awayTeamGoals }}</span>
                                    @else
                                        <div>{{ date('d/m/Y H:i', strtotime($game->date)) }}</div>
                                        <small style="color:var(--grey);">{{ $game->stadium }}</small>
                                    @endif
                                </td>
                                <td>{{ $game->awayTeam }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center;color:var(--grey);">No matches for this matchday.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (!empty($playerSuspendeds) && count($playerSuspendeds))
                <div style="margin-top:40px;">
                    <div class="fw-section-label">Discipline</div>
                    <h3 class="fw-section-title" style="font-size:24px;margin-bottom:20px;">Suspended Players</h3>
                    <div class="fw-table-wrap">
                        <table class="fw-table">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Team</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($playerSuspendeds as $player)
                                    <tr>
                                        <td>{{ $player->name }}</td>
                                        <td>{{ $player->teamName }}</td>
                                        <td>{{ $player->reason }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @else
            <div class="fw-empty">
                <i class="fas fa-futbol"></i>
                <p>No fixtures available.</p>
            </div>
        @endif
    </div>
</section>
@endsection
