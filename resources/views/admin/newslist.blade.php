@extends('layouts.admin')

@section('title', 'News')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>News</h1>
            <p>Publish and manage federation news stories.</p>
        </div>
        <a href="{{ route('news.create') }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add news</a>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Created</th>
                        <th>Top</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                        <tr>
                            <td>
                                <img class="thumb" src="{{ route('news.images.show', $item['image_id']) }}" alt="">
                            </td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ date('j M Y', strtotime($item['created_at'])) }}</td>
                            <td>{{ $item['is_top'] }}</td>
                            <td><span class="fw-admin-badge">{{ $item['status'] }}</span></td>
                            <td class="fw-admin-muted">{{ $item['creator_name'] ?? '—' }}</td>
                            <td>
                                <div class="fw-admin-actions">
                                    <a href="{{ route('news.page.edit', $item['id']) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Edit</a>
                                    <button type="button" class="fw-admin-btn fw-admin-btn-danger fw-admin-btn-sm delete-item" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $item['id'] }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="fw-admin-empty">
                                    <h3>No news yet</h3>
                                    <p>Create your first story to get started.</p>
                                    <a href="{{ route('news.create') }}" class="fw-admin-btn fw-admin-btn-primary">Create news</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $news])
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm delete</h5></div>
                <div class="modal-body">Are you sure you want to delete this news item?</div>
                <div class="modal-footer">
                    <button type="button" class="fw-admin-btn fw-admin-btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('news.delete', 0) }}" method="POST">
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
        var action = $('#deleteForm').attr('action').replace(/\/\d+$/, '/' + id);
        if (!$('#deleteForm').attr('action').match(/\/\d+$/)) {
            action = $('#deleteForm').attr('action').replace(/0$/, id);
        }
        $('#deleteForm').attr('action', $('#deleteForm').attr('action').replace('0', id));
    });
</script>
@endpush
