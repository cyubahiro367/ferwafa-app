@php
    $category = DB::table('TeamCategory')->select('id', 'name')->orderBy('id')->get();
    $divisions = DB::table('Division')->select('id', 'name')->orderBy('id')->get();
    $menCategory = $category->firstWhere('name', 'Men') ?? $category->get(0);
    $womenCategory = $category->firstWhere('name', 'Women') ?? $category->get(1);
    $firstDivision = $divisions->firstWhere('name', 'First Division') ?? $divisions->get(0);
    $secondDivision = $divisions->firstWhere('name', 'Second Division') ?? $divisions->get(1);
@endphp

<aside class="fw-admin-sidebar" id="fwAdminSidebar">
    <a href="{{ url('/') }}" class="fw-admin-brand">
        <img src="{{ asset('static/img/federation/ferwafa.png') }}" alt="FERWAFA">
        <span>FERWAFA</span>
    </a>

    <nav class="fw-admin-nav">
        @can('is-admin')
            <div class="fw-admin-nav-group">Overview</div>
            <a href="{{ route('dashboard.view') }}" class="{{ request()->routeIs('dashboard.view') ? 'is-active' : '' }}">
                <i class="fas fa-gauge-high"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('creator.report') }}" class="{{ request()->routeIs('creator.report') ? 'is-active' : '' }}">
                <i class="fas fa-user-check"></i><span>Creator Report</span>
            </a>
            <a href="{{ route('users.view') }}" class="{{ request()->routeIs('users.view') ? 'is-active' : '' }}">
                <i class="fas fa-users"></i><span>Users</span>
            </a>

            <div class="fw-admin-nav-group">Content</div>
            <a href="{{ route('news.view') }}" class="{{ request()->routeIs('news.view') ? 'is-active' : '' }}">
                <i class="fas fa-newspaper"></i><span>News</span>
            </a>
            <a href="{{ route('events.view') }}" class="{{ request()->routeIs('events.view') ? 'is-active' : '' }}">
                <i class="fas fa-calendar-days"></i><span>Events</span>
            </a>
            <a href="{{ route('reports.view') }}" class="{{ request()->routeIs('reports.view') ? 'is-active' : '' }}">
                <i class="fas fa-file-lines"></i><span>Documents</span>
            </a>
            <a href="{{ route('admin.gallery.list') }}" class="{{ request()->routeIs('admin.gallery.list') ? 'is-active' : '' }}">
                <i class="fas fa-images"></i><span>Gallery</span>
            </a>
            <a href="{{ route('partner') }}" class="{{ request()->routeIs('partner') ? 'is-active' : '' }}">
                <i class="fas fa-handshake"></i><span>Partners</span>
            </a>
            <a href="{{ route('committe') }}" class="{{ request()->routeIs('committe') ? 'is-active' : '' }}">
                <i class="fas fa-sitemap"></i><span>Executive Committee</span>
            </a>

            <div class="fw-admin-nav-group">Competition</div>
            <a href="{{ route('season') }}" class="{{ request()->routeIs('season') ? 'is-active' : '' }}">
                <i class="fas fa-trophy"></i><span>Seasons</span>
            </a>
            <a href="{{ route('day.season') }}" class="{{ request()->routeIs('day.season') ? 'is-active' : '' }}">
                <i class="fas fa-calendar-week"></i><span>Days</span>
            </a>

            @if($menCategory && $womenCategory && $firstDivision && $secondDivision)
                <button type="button" class="fw-admin-nav-toggle {{ request()->routeIs('team') ? 'is-open' : '' }}" data-fw-toggle="teamsNav">
                    <i class="fas fa-shirt"></i><span>Teams</span>
                    <i class="fas fa-chevron-right fw-admin-nav-chevron" aria-hidden="true"></i>
                </button>
                <div class="fw-admin-subnav {{ request()->routeIs('team') ? 'is-open' : '' }}" id="teamsNav">
                    <a href="{{ route('team', [$secondDivision->id, $menCategory->id]) }}"><i class="fas fa-person" aria-hidden="true"></i>Men · Second Division</a>
                    <a href="{{ route('team', [$firstDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · First Division</a>
                    <a href="{{ route('team', [$secondDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · Second Division</a>
                </div>

                <button type="button" class="fw-admin-nav-toggle {{ request()->routeIs('fixtures') ? 'is-open' : '' }}" data-fw-toggle="fixturesNav">
                    <i class="fas fa-futbol"></i><span>Fixtures</span>
                    <i class="fas fa-chevron-right fw-admin-nav-chevron" aria-hidden="true"></i>
                </button>
                <div class="fw-admin-subnav {{ request()->routeIs('fixtures') ? 'is-open' : '' }}" id="fixturesNav">
                    <a href="{{ route('fixtures', [$secondDivision->id, $menCategory->id]) }}"><i class="fas fa-person" aria-hidden="true"></i>Men · Second Division</a>
                    <a href="{{ route('fixtures', [$firstDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · First Division</a>
                    <a href="{{ route('fixtures', [$secondDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · Second Division</a>
                </div>

                <button type="button" class="fw-admin-nav-toggle {{ request()->routeIs('top-score') ? 'is-open' : '' }}" data-fw-toggle="topScoresNav">
                    <i class="fas fa-star"></i><span>Top Scores</span>
                    <i class="fas fa-chevron-right fw-admin-nav-chevron" aria-hidden="true"></i>
                </button>
                <div class="fw-admin-subnav {{ request()->routeIs('top-score') ? 'is-open' : '' }}" id="topScoresNav">
                    <a href="{{ route('top-score', [$secondDivision->id, $menCategory->id]) }}"><i class="fas fa-person" aria-hidden="true"></i>Men · Second Division</a>
                    <a href="{{ route('top-score', [$firstDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · First Division</a>
                    <a href="{{ route('top-score', [$secondDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · Second Division</a>
                </div>

                <button type="button" class="fw-admin-nav-toggle {{ request()->routeIs('player-suspended') ? 'is-open' : '' }}" data-fw-toggle="suspendedNav">
                    <i class="fas fa-ban"></i><span>Suspensions</span>
                    <i class="fas fa-chevron-right fw-admin-nav-chevron" aria-hidden="true"></i>
                </button>
                <div class="fw-admin-subnav {{ request()->routeIs('player-suspended') ? 'is-open' : '' }}" id="suspendedNav">
                    <a href="{{ route('player-suspended', [$secondDivision->id, $menCategory->id]) }}"><i class="fas fa-person" aria-hidden="true"></i>Men · Second Division</a>
                    <a href="{{ route('player-suspended', [$firstDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · First Division</a>
                    <a href="{{ route('player-suspended', [$secondDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · Second Division</a>
                </div>
            @endif
        @else
            @can('is-dcm')
                <div class="fw-admin-nav-group">Content</div>
                <a href="{{ route('news.view') }}" class="{{ request()->routeIs('news.view') ? 'is-active' : '' }}">
                    <i class="fas fa-newspaper"></i><span>News</span>
                </a>
                <a href="{{ route('reports.view') }}" class="{{ request()->routeIs('reports.view') ? 'is-active' : '' }}">
                    <i class="fas fa-file-lines"></i><span>Documents</span>
                </a>
                <a href="{{ route('committe') }}" class="{{ request()->routeIs('committe') ? 'is-active' : '' }}">
                    <i class="fas fa-sitemap"></i><span>Executive Committee</span>
                </a>
                <a href="{{ route('partner') }}" class="{{ request()->routeIs('partner') ? 'is-active' : '' }}">
                    <i class="fas fa-handshake"></i><span>Partners</span>
                </a>
                <a href="{{ route('admin.gallery.list') }}" class="{{ request()->routeIs('admin.gallery.list') ? 'is-active' : '' }}">
                    <i class="fas fa-images"></i><span>Gallery</span>
                </a>
            @endcan

            @can('is-competition-manager')
                <div class="fw-admin-nav-group">Competition</div>
                <a href="{{ route('team-category') }}" class="{{ request()->routeIs('team-category') ? 'is-active' : '' }}">
                    <i class="fas fa-layer-group"></i><span>Team Category</span>
                </a>
                <a href="{{ route('season') }}" class="{{ request()->routeIs('season') ? 'is-active' : '' }}">
                    <i class="fas fa-trophy"></i><span>Seasons</span>
                </a>
                <a href="{{ route('day.season') }}" class="{{ request()->routeIs('day.season') ? 'is-active' : '' }}">
                    <i class="fas fa-calendar-week"></i><span>Days</span>
                </a>

                @if($menCategory && $womenCategory && $firstDivision && $secondDivision)
                    <button type="button" class="fw-admin-nav-toggle {{ request()->routeIs('team') ? 'is-open' : '' }}" data-fw-toggle="cmTeamsNav">
                        <i class="fas fa-shirt"></i><span>Teams</span>
                        <i class="fas fa-chevron-right fw-admin-nav-chevron" aria-hidden="true"></i>
                    </button>
                    <div class="fw-admin-subnav {{ request()->routeIs('team') ? 'is-open' : '' }}" id="cmTeamsNav">
                        <a href="{{ route('team', [$secondDivision->id, $menCategory->id]) }}"><i class="fas fa-person" aria-hidden="true"></i>Men · Second Division</a>
                        <a href="{{ route('team', [$firstDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · First Division</a>
                        <a href="{{ route('team', [$secondDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · Second Division</a>
                    </div>

                    <button type="button" class="fw-admin-nav-toggle {{ request()->routeIs('fixtures') ? 'is-open' : '' }}" data-fw-toggle="cmFixturesNav">
                        <i class="fas fa-futbol"></i><span>Fixtures</span>
                        <i class="fas fa-chevron-right fw-admin-nav-chevron" aria-hidden="true"></i>
                    </button>
                    <div class="fw-admin-subnav {{ request()->routeIs('fixtures') ? 'is-open' : '' }}" id="cmFixturesNav">
                        <a href="{{ route('fixtures', [$secondDivision->id, $menCategory->id]) }}"><i class="fas fa-person" aria-hidden="true"></i>Men · Second Division</a>
                        <a href="{{ route('fixtures', [$firstDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · First Division</a>
                        <a href="{{ route('fixtures', [$secondDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · Second Division</a>
                    </div>

                    <button type="button" class="fw-admin-nav-toggle {{ request()->routeIs('top-score') ? 'is-open' : '' }}" data-fw-toggle="cmTopScoresNav">
                        <i class="fas fa-star"></i><span>Top Scores</span>
                        <i class="fas fa-chevron-right fw-admin-nav-chevron" aria-hidden="true"></i>
                    </button>
                    <div class="fw-admin-subnav {{ request()->routeIs('top-score') ? 'is-open' : '' }}" id="cmTopScoresNav">
                        <a href="{{ route('top-score', [$secondDivision->id, $menCategory->id]) }}"><i class="fas fa-person" aria-hidden="true"></i>Men · Second Division</a>
                        <a href="{{ route('top-score', [$firstDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · First Division</a>
                        <a href="{{ route('top-score', [$secondDivision->id, $womenCategory->id]) }}"><i class="fas fa-person-dress" aria-hidden="true"></i>Women · Second Division</a>
                    </div>
                @endif
            @endcan
        @endcan
    </nav>
</aside>
