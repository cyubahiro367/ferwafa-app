@extends('layouts.admin')

@section('title', 'Suspensions')

@section('content')
@php
    $divisionID = $divisionID ?? request()->route('divisionID');
    $categoryID = $categoryID ?? request()->route('categoryID');
@endphp
    <div class="fw-admin-page-header">
        <div>
            <h1>Suspended players</h1>
            <p>Track player suspensions by season and match day.</p>
        </div>
        <div class="fw-admin-actions" style="flex-wrap:wrap;">
            <a href="{{ route('add.player-suspended', [$divisionID, $categoryID]) }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add player</a>
        </div>
    </div>

    @include('partials.admin-list-filters', [
        'action' => route('player-suspended', [$divisionID, $categoryID]),
        'seasonOptions' => $seasonOptions ?? $seasons ?? [],
        'seasonID' => $seasonID ?? null,
        'dayOptions' => $dayOptions ?? $days ?? [],
        'dayID' => $dayID ?? null,
    ])

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Period</th>
                        <th>Reason</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($playerSuspendeds as $key => $item)
                        <tr>
                            <td>{{ $playerSuspendeds->firstItem() + $key }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['teamName'] }}</td>
                            <td>{{ $item['period'] }}</td>
                            <td>{{ $item['reason'] }}</td>
                            <td class="fw-admin-muted">{{ $item['creator_name'] ?? '—' }}</td>
                            <td>
                                <div class="fw-admin-actions">
                                    <a href="{{ route('player-suspended.page.edit', [$divisionID, $categoryID, $item['id']]) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Edit</a>
                                    <button type="button" class="fw-admin-btn fw-admin-btn-danger fw-admin-btn-sm delete-item"
                                        data-toggle="modal" data-target="#confirmDeleteModal"
                                        data-id="{{ $item['id'] }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="fw-admin-empty"><h3>No suspensions recorded</h3></div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $playerSuspendeds])
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm delete</h5></div>
                <div class="modal-body">Are you sure you want to delete this suspension?</div>
                <div class="modal-footer">
                    <button type="button" class="fw-admin-btn fw-admin-btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('delete.player-suspended', [$categoryID, 0]) }}" method="POST">
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
