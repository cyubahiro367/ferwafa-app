@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Users</h1>
            <p>Manage admin users and permissions.</p>
        </div>
        
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Permission</th>
                        <th>Since</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td><span class="fw-admin-badge">{{ $item['status'] }}</span></td>
                            <td>{{ $item['since'] }}</td>
                            <td>
                                <button type="button" class="fw-admin-btn fw-admin-btn-danger fw-admin-btn-sm delete-item" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $item['id'] }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="fw-admin-empty">
                                    <h3>No users found.</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $users])
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm delete</h5></div>
                <div class="modal-body">Are you sure you want to delete this item?</div>
                <div class="modal-footer">
                    <button type="button" class="fw-admin-btn fw-admin-btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('users.delete', 0) }}" method="POST">
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
