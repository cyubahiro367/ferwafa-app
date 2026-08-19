@extends('layouts.admin')

@section('title', 'Creator Report')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Creator Report</h1>
            <p>Find everything created by a specific user across the admin.</p>
        </div>
    </div>

    @include('partials.admin-list-filters', [
        'action' => route('creator.report'),
        'users' => $users,
        'userId' => $userId,
        'from' => $from,
        'to' => $to,
        'requireUser' => true,
        'submitLabel' => 'Show report',
    ])

    @if($selectedUser)
        <div class="fw-admin-page-header" style="margin-bottom:12px;">
            <div>
                <h1 style="font-size:1.25rem;">Results for {{ $selectedUser->name }}</h1>
                <p>{{ $selectedUser->email }} · {{ \Carbon\Carbon::parse($from)->format('j M Y') }} – {{ \Carbon\Carbon::parse($to)->format('j M Y') }}</p>
            </div>
        </div>

        @if(collect($counts)->sum() === 0)
            <div class="fw-admin-panel">
                <div class="fw-admin-empty">
                    <h3>No attributed records</h3>
                    <p>This user has no tracked content between {{ \Carbon\Carbon::parse($from)->format('j M Y') }} and {{ \Carbon\Carbon::parse($to)->format('j M Y') }} (or older rows have no userID).</p>
                </div>
            </div>
        @else
            <div class="fw-admin-stats">
                @foreach($counts as $key => $count)
                    @if($count > 0)
                        <a class="fw-admin-stat" href="#section-{{ $key }}">
                            <div class="label">{{ $sections[$key]['label'] ?? $key }}</div>
                            <div class="value">{{ $count }}</div>
                        </a>
                    @endif
                @endforeach
            </div>

            @foreach($sections as $key => $section)
                @if(($counts[$key] ?? 0) > 0)
                    <div class="fw-admin-panel" id="section-{{ $key }}" style="margin-bottom:18px;">
                        <div class="fw-admin-panel-body">
                            <h2 class="fw-admin-section-title">{{ $section['label'] }} ({{ $counts[$key] }})</h2>
                        </div>
                        <div class="fw-admin-table-wrap">
                            <table class="fw-admin-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section['items'] as $item)
                                        <tr>
                                            <td>{{ $item['title'] }}</td>
                                            <td class="fw-admin-muted">{{ $item['created_at'] ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @endif
@endsection
