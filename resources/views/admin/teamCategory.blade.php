@extends('layouts.admin')

@section('title', 'Team Categories')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Team Categories</h1>
            <p>Manage team categories.</p>
        </div>
        <a href="{{ route('add.team-category') }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add category</a>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teamCategorys as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td class="fw-admin-muted">{{ $item['creator_name'] ?? '—' }}</td>
                            <td>
                                <a href="{{ route('team-category.page.edit', $item['id']) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="fw-admin-empty">
                                    <h3>No categories yet.</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $teamCategorys])
    </div>

@endsection

