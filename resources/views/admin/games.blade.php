@extends('layouts.admin')

@section('title', 'Fixtures')

@section('content')
@php $divisionID = $divisionID ?? request()->route('divisionID'); $categoryID = $categoryID ?? request()->route('categoryID'); @endphp
    <div class="fw-admin-page-header">
        <div>
            <h1>Fixtures</h1>
            <p>Schedule and update match fixtures.</p>
        </div>
        <div class="fw-admin-actions">
            <a href="{{ route('add.game', [$divisionID, $categoryID]) }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add match</a>
        </div>
    </div>

    @include('partials.admin-list-filters', [
        'action' => route('fixtures', [$divisionID, $categoryID]),
        'seasonOptions' => $seasonOptions ?? $seasons ?? [],
        'seasonID' => $seasonID ?? null,
        'groupOptions' => $groupOptions ?? null,
        'groupID' => $groupID ?? null,
        'dayOptions' => $dayOptions ?? null,
        'dayID' => $dayID ?? null,
    ])

    @if (session('error'))
        <div class="fw-admin-flash fw-admin-flash-error">{{ session('error') }}</div>
    @endif

    @forelse ($games as $data)
        <div class="fw-admin-panel" style="margin-bottom:18px;">
            <div class="fw-admin-panel-body">
                <h2 class="fw-admin-section-title">{{ $data[0]['dayName'] ?? 'Match day' }}</h2>
            </div>
            <div class="fw-admin-table-wrap">
                <table class="fw-admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Home</th>
                            <th>Away</th>
                            <th>Stadium</th>
                            <th>Date</th>
                            <th>Score</th>
                            <th>Created by</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $game)
                            <tr @if (!empty($game['isPlayed'])) style="font-weight:600" @endif>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $game['homeTeam'] }}</td>
                                <td>{{ $game['awayTeam'] }}</td>
                                <td>{{ $game['stadium'] }}</td>
                                <td>{{ $game['date'] }}</td>
                                <td>
                                    @if (!empty($game['isPlayed']))
                                        {{ $game['homeTeamGoals'] }} - {{ $game['awayTeamGoals'] }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="fw-admin-muted">{{ $game['creator_name'] ?? '—' }}</td>
                                <td>
                                    <div class="fw-admin-actions">
                                        <a href="{{ route('game.page.edit', [$divisionID, $categoryID, $game['id']]) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Add scores</a>
                                        <button type="button" class="fw-admin-btn fw-admin-btn-danger fw-admin-btn-sm delete-item"
                                            data-toggle="modal" data-target="#confirmDeleteModal"
                                            data-id="{{ $game['id'] }}" data-category-id="{{ $categoryID }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="fw-admin-panel">
            <div class="fw-admin-empty">
                <h3>No fixtures yet</h3>
                <a href="{{ route('add.game', [$divisionID, $categoryID]) }}" class="fw-admin-btn fw-admin-btn-primary">Add match</a>
            </div>
        </div>
    @endforelse

    @isset($gamesPaginator)
        @include('partials.admin-pagination', ['paginator' => $gamesPaginator])
    @endisset

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm delete</h5></div>
                <div class="modal-body">Are you sure you want to delete this fixture?</div>
                <div class="modal-footer">
                    <button type="button" class="fw-admin-btn fw-admin-btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('delete.game', [$categoryID, 0]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="fw-admin-btn fw-admin-btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.delete-item', function () {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', $('#deleteForm').attr('action').replace(/\/0$/, '/' + id));
    });
</script>
@endpush
