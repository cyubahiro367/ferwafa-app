@extends('layouts.admin')

@section('title', 'Documents')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Documents</h1>
            <p>Upload and manage documents.</p>
        </div>
        <a href="{{ route('add.doc') }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add document</a>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td class="fw-admin-muted">{{ $item['creator_name'] ?? '—' }}</td>
                            <td>
                                <div class="fw-admin-actions">
                                    <a href="{{ route('report.doc', $item['id']) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Open</a>
                                    <a href="{{ route('document.page.edit', $item['id']) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Edit</a>
                                    <button type="button" class="fw-admin-btn fw-admin-btn-danger fw-admin-btn-sm delete-item" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $item['id'] }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="fw-admin-empty">
                                    <h3>No documents yet.</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $reports])
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm delete</h5></div>
                <div class="modal-body">Are you sure you want to delete this item?</div>
                <div class="modal-footer">
                    <button type="button" class="fw-admin-btn fw-admin-btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('delete.report', 0) }}" method="POST">
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
        $('#deleteForm').attr('action', $('#deleteForm').attr('action').replace(/0$/, id).replace(/\/0(\/|$)/, '/' + id + '$1'));
        if ($('#deleteForm').attr('action').indexOf(String(id)) === -1) {
            $('#deleteForm').attr('action', $('#deleteForm').attr('action').replace('0', id));
        }
    });
</script>
@endpush
