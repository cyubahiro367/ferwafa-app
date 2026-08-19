@extends('layouts.admin')

@section('title', 'Top Scores')

@section('content')
@php $divisionID = $divisionID ?? request()->route('divisionID'); $categoryID = $categoryID ?? request()->route('categoryID'); @endphp
    <div class="fw-admin-page-header">
        <div>
            <h1>Top Scores</h1>
            <p>Track leading scorers for this division.</p>
        </div>
        <div class="fw-admin-actions">
            <a href="{{ route('add.top-score', [$divisionID, $categoryID]) }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add top score</a>
        </div>
    </div>

    @include('partials.admin-list-filters', [
        'action' => route('top-score', [$divisionID, $categoryID]),
        'seasonOptions' => $seasonOptions ?? $seasons ?? [],
        'seasonID' => $seasonID ?? null,
    ])

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Goals</th>
                        <th>Team</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topScores as $key => $topScore)
                        <tr>
                            <td>{{ $topScores->firstItem() + $key }}</td>
                            <td>{{ $topScore['name'] }}</td>
                            <td>{{ $topScore['goals'] }}</td>
                            <td>{{ $topScore['teamName'] }}</td>
                            <td class="fw-admin-muted">{{ $topScore['creator_name'] ?? '—' }}</td>
                            <td>
                                <div class="fw-admin-actions">
                                    <a href="{{ route('top-score.page.edit', [$divisionID, $categoryID, $topScore['id']]) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Edit</a>
                                    <button type="button" class="fw-admin-btn fw-admin-btn-danger fw-admin-btn-sm delete-item"
                                        data-toggle="modal" data-target="#confirmDeleteModal"
                                        data-id="{{ $topScore['id'] }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="fw-admin-empty"><h3>No top scores yet</h3></div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $topScores])
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm delete</h5></div>
                <div class="modal-body">Are you sure you want to delete this top score?</div>
                <div class="modal-footer">
                    <button type="button" class="fw-admin-btn fw-admin-btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('delete.top-score', [$categoryID, 0]) }}" method="POST">
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
