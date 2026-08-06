@extends('layouts.public')

@section('title', 'Standings – FERWAFA')
@section('active', 'competitions')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Competitions',
    'title' => 'League Table',
    'crumb' => [
        ['label' => 'Competitions'],
        ['label' => 'Standings'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-day-nav">
            <a class="fw-day-pill" href="{{ route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $days->dayID ?? 1, request()->route('groupID')]) }}">Results &amp; Fixtures</a>
            <a class="fw-day-pill active" href="{{ route('men.first-division-table', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, request()->route('groupID')]) }}">Standings</a>
        </div>

        <div style="display:grid;grid-template-columns:1.6fr 1fr;gap:28px;align-items:start;" class="fw-standings-grid">
            <div>
                <div class="fw-section-label">Table</div>
                <h2 class="fw-section-title" style="font-size:28px;margin-bottom:20px;">{{ $categoryName ?? 'Standings' }}</h2>
                <div class="fw-table-wrap">
                    <table class="fw-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Team</th>
                                <th>P</th>
                                <th>GF</th>
                                <th>GA</th>
                                <th>GD</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teamStatistics as $key => $teamStatistic)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $teamStatistic->name }}</td>
                                    <td>{{ $teamStatistic->matchPlayed }}</td>
                                    <td>{{ $teamStatistic->goalWin }}</td>
                                    <td>{{ $teamStatistic->goalLoss }}</td>
                                    <td>{{ $teamStatistic->goalDifference }}</td>
                                    <td class="fw-match-score">{{ $teamStatistic->score }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <div class="fw-section-label">Scorers</div>
                <h2 class="fw-section-title" style="font-size:28px;margin-bottom:20px;">Top Scorers</h2>
                <div class="fw-table-wrap">
                    <table class="fw-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Team</th>
                                <th>Goals</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topScores as $key => $topScore)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ is_array($topScore) ? $topScore['name'] : $topScore->name }}</td>
                                    <td>{{ is_array($topScore) ? $topScore['teamName'] : $topScore->teamName }}</td>
                                    <td class="fw-match-score">{{ is_array($topScore) ? $topScore['goals'] : $topScore->goals }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center;color:var(--grey);">No scorers yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
@media (max-width: 900px) {
  .fw-standings-grid { grid-template-columns: 1fr !important; }
}
</style>
@endpush
@endsection
