@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Teams</h1>
            <p>Manage competition teams.</p>
        </div>
        <a href="{{ route('add.team', [$divisionID ?? request()->route('divisionID'), $categoryID ?? request()->route('categoryID')]) }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add team</a>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $item)
                        <tr>
                            <td><img class="thumb" src="{{ route('team.doc', $item['id']) }}" alt=""></td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td class="fw-admin-muted">{{ $item['creator_name'] ?? '—' }}</td>
                            <td>
                                <a href="{{ route('team.page.edit', [$divisionID ?? request()->route('divisionID'), $categoryID ?? request()->route('categoryID'), $item['id']]) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="fw-admin-empty">
                                    <h3>No teams yet.</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $teams])
    </div>

@endsection

