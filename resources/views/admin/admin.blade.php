@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Welcome back, {{ $userName }}</h1>
            <p>Here’s what’s happening across FERWAFA content and competitions.</p>
        </div>
    </div>

    <div class="fw-admin-quick-actions">
        @can('is-admin')
            <a class="fw-admin-btn fw-admin-btn-primary" href="{{ route('news.create') }}"><i class="fas fa-plus"></i>Create news</a>
            <a class="fw-admin-btn fw-admin-btn-secondary" href="{{ route('creator.report') }}"><i class="fas fa-user-check"></i>Creator report</a>
        @endcan
        @can('is-dcm')
            <a class="fw-admin-btn fw-admin-btn-primary" href="{{ route('news.create') }}"><i class="fas fa-plus"></i>Create news</a>
        @endcan
        @can('is-competition-manager')
            <a class="fw-admin-btn fw-admin-btn-secondary" href="{{ route('season') }}"><i class="fas fa-trophy"></i>Manage seasons</a>
        @endcan
    </div>

    <div class="fw-admin-stats">
        @can('is-admin')
            <a class="fw-admin-stat" href="{{ route('news.view') }}" @if(($stats['news'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">News</div><div class="value">{{ $stats['news'] }}</div>
            </a>
            <a class="fw-admin-stat" href="{{ route('events.view') }}" @if(($stats['events'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Events</div><div class="value">{{ $stats['events'] }}</div>
            </a>
            <a class="fw-admin-stat" href="{{ route('reports.view') }}" @if(($stats['documents'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Documents</div><div class="value">{{ $stats['documents'] }}</div>
            </a>
            <a class="fw-admin-stat" href="{{ route('admin.gallery.list') }}" @if(($stats['gallery'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Gallery</div><div class="value">{{ $stats['gallery'] }}</div>
            </a>
            <a class="fw-admin-stat" href="{{ route('partner') }}" @if(($stats['partners'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Partners</div><div class="value">{{ $stats['partners'] }}</div>
            </a>
            <a class="fw-admin-stat" href="{{ route('committe') }}" @if(($stats['committee'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Committee</div><div class="value">{{ $stats['committee'] }}</div>
            </a>
            <a class="fw-admin-stat" href="{{ route('users.view') }}" @if(($stats['users'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Users</div><div class="value">{{ $stats['users'] }}</div>
            </a>
            <a class="fw-admin-stat" href="{{ route('season') }}" @if(($stats['seasons'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Seasons</div><div class="value">{{ $stats['seasons'] }}</div>
            </a>
            <div class="fw-admin-stat" @if(($stats['teams'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Teams</div><div class="value">{{ $stats['teams'] }}</div>
            </div>
            <div class="fw-admin-stat" @if(($stats['games'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Fixtures</div><div class="value">{{ $stats['games'] }}</div>
            </div>
            <div class="fw-admin-stat" @if(($stats['topScores'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Top scores</div><div class="value">{{ $stats['topScores'] }}</div>
            </div>
            <div class="fw-admin-stat" @if(($stats['suspensions'] ?? 0) == 0) data-zero="true" @endif>
                <div class="label">Suspensions</div><div class="value">{{ $stats['suspensions'] }}</div>
            </div>
        @else
            @can('is-dcm')
                <a class="fw-admin-stat" href="{{ route('news.view') }}" @if(($stats['news'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">News</div><div class="value">{{ $stats['news'] }}</div>
                </a>
                <a class="fw-admin-stat" href="{{ route('reports.view') }}" @if(($stats['documents'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Documents</div><div class="value">{{ $stats['documents'] }}</div>
                </a>
                <a class="fw-admin-stat" href="{{ route('admin.gallery.list') }}" @if(($stats['gallery'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Gallery</div><div class="value">{{ $stats['gallery'] }}</div>
                </a>
                <a class="fw-admin-stat" href="{{ route('partner') }}" @if(($stats['partners'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Partners</div><div class="value">{{ $stats['partners'] }}</div>
                </a>
                <a class="fw-admin-stat" href="{{ route('committe') }}" @if(($stats['committee'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Committee</div><div class="value">{{ $stats['committee'] }}</div>
                </a>
            @endcan
            @can('is-competition-manager')
                <a class="fw-admin-stat" href="{{ route('season') }}" @if(($stats['seasons'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Seasons</div><div class="value">{{ $stats['seasons'] }}</div>
                </a>
                <div class="fw-admin-stat" @if(($stats['teams'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Teams</div><div class="value">{{ $stats['teams'] }}</div>
                </div>
                <div class="fw-admin-stat" @if(($stats['games'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Fixtures</div><div class="value">{{ $stats['games'] }}</div>
                </div>
                <div class="fw-admin-stat" @if(($stats['topScores'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Top scores</div><div class="value">{{ $stats['topScores'] }}</div>
                </div>
                <div class="fw-admin-stat" @if(($stats['suspensions'] ?? 0) == 0) data-zero="true" @endif>
                    <div class="label">Suspensions</div><div class="value">{{ $stats['suspensions'] }}</div>
                </div>
            @endcan
        @endcan
    </div>

    <div class="fw-admin-grid-2">
        <div class="fw-admin-panel">
            <div class="fw-admin-panel-body">
                <h2 class="fw-admin-section-title">Recent news</h2>
                @forelse($recentNews as $item)
                    <div style="display:flex;justify-content:space-between;gap:12px;padding:10px 0;border-bottom:1px solid var(--fw-admin-border);">
                        <div>
                            <strong>{{ $item->title }}</strong>
                            <div class="fw-admin-muted" style="font-size:0.85rem;">{{ $item->creator_name ?? '—' }}</div>
                        </div>
                        <div class="fw-admin-muted" style="white-space:nowrap;">{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</div>
                    </div>
                @empty
                    <div class="fw-admin-empty">
                        <i class="fas fa-newspaper"></i>
                        <p>No news yet</p>
                        <span>Published articles will show up here.</span>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="fw-admin-panel">
            <div class="fw-admin-panel-body">
                <h2 class="fw-admin-section-title">Recent fixtures</h2>
                @forelse($recentGames as $item)
                    <div style="display:flex;justify-content:space-between;gap:12px;padding:10px 0;border-bottom:1px solid var(--fw-admin-border);">
                        <div>
                            <strong>{{ $item->home_team }} vs {{ $item->away_team }}</strong>
                            <div class="fw-admin-muted" style="font-size:0.85rem;">{{ $item->creator_name ?? '—' }}</div>
                        </div>
                        <div class="fw-admin-muted" style="white-space:nowrap;">{{ $item->date ?? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</div>
                    </div>
                @empty
                    <div class="fw-admin-empty">
                        <i class="fas fa-futbol"></i>
                        <p>No fixtures logged yet</p>
                        <span>New matches will appear here once a season is scheduled.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection