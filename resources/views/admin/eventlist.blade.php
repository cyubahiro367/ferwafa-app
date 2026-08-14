@extends('layouts.admin')

@section('title', 'Events')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Events</h1>
            <p>Manage federation events.</p>
        </div>
        <a href="{{ route('events.create') }}" class="fw-admin-btn fw-admin-btn-primary"><i class="fas fa-plus"></i> Add event</a>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-table-wrap">
            <table class="fw-admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $item)
                        <tr>
                            <td><img class="thumb" src="{{ route('events.images.show', $item['image_id']) }}" alt=""></td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['created_at'] }}</td>
                            <td><span class="fw-admin-badge">{{ $item['status'] }}</span></td>
                            <td class="fw-admin-muted">{{ $item['creator_name'] ?? '—' }}</td>
                            <td><a href="{{ route('single.event', $item['id']) }}" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="fw-admin-empty">
                                    <h3>No events yet.</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.admin-pagination', ['paginator' => $events])
    </div>

@endsection

