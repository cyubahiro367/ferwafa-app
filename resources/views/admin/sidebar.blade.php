<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <!-- General CSS Files -->
    <link rel="stylesheet" href="./assets/css/app.min.css">
    <link rel="stylesheet" href="./assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="./assets/bundles/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="./assets/bundles/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="./assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="./assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <link rel='shortcut icon' type='image/x-icon' href='./assets/img/favicon.ico' />
</head>

<body>
    {{-- <div class="loader"></div> --}}
    @php
        $category = DB::table('TeamCategory')
            ->select('id', 'name')
            ->get();

        $divisions = DB::table('Division')
            ->select('id', 'name')
            ->get();
    @endphp
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                                <i data-feather="align-justify"></i></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                        <li>
                            <form class="form-inline mr-auto">
                                <div class="search-element">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                        data-width="200" />
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <a style="color: black" id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">
                            <img alt="image" src="{{ asset('asset/images/file.png') }}"
                                class="header-logo" />
                            <span class="logo-name">Ferwafa</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        @can('is-admin')
                            <li class="dropdown">
                                <a href="{{ route('dashboard.view') }}" class="nav-link">
                                    <i class="far fa-envelope"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('news.view') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>News</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('reports.view') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>Documents</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('users.view') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>Users</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('committe') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>Executive Committee</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('partner') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>Partners</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('admin.gallery.list') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>Gallery</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('season') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>Season</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('day.season') }}" class="nav-link">
                                    <i class="fas fa-envelope"></i><span>Days</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                        data-feather="mail"></i><span>Teams</span></a>
                                {{-- <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ route('team', $category[0]->id) }}">Men</a></li>
                                    <li><a class="nav-link" href="{{ route('team', $category[1]->id) }}">Women</a></li>
                                </ul> --}}
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                data-feather="mail"></i><span>Men</span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown">
                                                <a class="nav-link" href="{{ route('team', [$divisions[0]->id, $category[0]->id]) }}">First Division</a></li>
                                            <li class="dropdown">
                                                <a class="nav-link" href="{{ route('team', [$divisions[1]->id, $category[0]->id]) }}">Second Division</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                data-feather="mail"></i><span>Women</span></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="nav-link" href="{{ route('team', [$divisions[0]->id, $category[1]->id]) }}">First Division</a></li>
                                            <li><a class="nav-link" href="{{ route('team', [$divisions[1]->id, $category[1]->id]) }}">Second Division</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                        data-feather="mail"></i><span>Fixtures</span></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                data-feather="mail"></i><span>Men</span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown">
                                                <a class="nav-link" href="{{ route('fixtures', [$divisions[0]->id, $category[0]->id]) }}">First Division</a></li>
                                            <li class="dropdown">
                                                <a class="nav-link" href="{{ route('fixtures', [$divisions[1]->id, $category[0]->id]) }}">Second Division</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                data-feather="mail"></i><span>Women</span></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="nav-link" href="{{ route('fixtures', [$divisions[0]->id, $category[1]->id]) }}">First Division</a></li>
                                            <li><a class="nav-link" href="{{ route('fixtures', [$divisions[1]->id, $category[1]->id]) }}">Second Division</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="dropdown">
                                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                        data-feather="mail"></i><span>Top Scores</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ route('top-score', $category[0]->id) }}">Men</a></li>
                                    <li><a class="nav-link" href="{{ route('top-score', $category[1]->id) }}">Women</a></li>
                                </ul>
                            </li> --}}
                            <li class="dropdown">
                                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                        data-feather="mail"></i><span>Top Scores</span></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                data-feather="mail"></i><span>Men</span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown">
                                                <a class="nav-link" href="{{ route('top-score', [$divisions[0]->id, $category[0]->id]) }}">First Division</a></li>
                                            <li class="dropdown">
                                                <a class="nav-link" href="{{ route('top-score', [$divisions[1]->id, $category[0]->id]) }}">Second Division</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                data-feather="mail"></i><span>Women</span></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="nav-link" href="{{ route('top-score', [$divisions[0]->id, $category[1]->id]) }}">First Division</a></li>
                                            <li><a class="nav-link" href="{{ route('top-score', [$divisions[1]->id, $category[1]->id]) }}">Second Division</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                        @else
                            @can('is-dcm')
                                <li class="dropdown">
                                    <a href="{{ route('news.view') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>News</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('reports.view') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>Documents</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('committe') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>Executive Committee</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('partner') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>Partners</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('admin.gallery.list') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>Gallery</span>
                                    </a>
                                </li>
                            @endcan
                            @can('is-competition-manager')
                                <li class="dropdown">
                                    <a href="{{ route('team-category') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>Team Category</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('season') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>Seasons</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('day.season') }}" class="nav-link">
                                        <i class="fas fa-envelope"></i><span>Days</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                            data-feather="mail"></i><span>Teams</span></a>
                                    {{-- <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{ route('team', $category[0]->id) }}">Men</a></li>
                                        <li><a class="nav-link" href="{{ route('team', $category[1]->id) }}">Women</a></li>
                                    </ul> --}}
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                    data-feather="mail"></i><span>Men</span></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown">
                                                    <a class="nav-link" href="{{ route('team', [$divisions[0]->id, $category[0]->id]) }}">First Division</a></li>
                                                <li class="dropdown">
                                                    <a class="nav-link" href="{{ route('team', [$divisions[1]->id, $category[0]->id]) }}">Second Division</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                    data-feather="mail"></i><span>Women</span></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="nav-link" href="{{ route('team', [$divisions[0]->id, $category[1]->id]) }}">First Division</a></li>
                                                <li><a class="nav-link" href="{{ route('team', [$divisions[1]->id, $category[1]->id]) }}">Second Division</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                            data-feather="mail"></i><span>Fixtures</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                    data-feather="mail"></i><span>Men</span></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown">
                                                    <a class="nav-link" href="{{ route('fixtures', [$divisions[0]->id, $category[0]->id]) }}">First Division</a></li>
                                                <li class="dropdown">
                                                    <a class="nav-link" href="{{ route('fixtures', [$divisions[1]->id, $category[0]->id]) }}">Second Division</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                    data-feather="mail"></i><span>Women</span></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="nav-link" href="{{ route('fixtures', [$divisions[0]->id, $category[1]->id]) }}">First Division</a></li>
                                                <li><a class="nav-link" href="{{ route('fixtures', [$divisions[1]->id, $category[1]->id]) }}">Second Division</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                            data-feather="mail"></i><span>Top Scores</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                    data-feather="mail"></i><span>Men</span></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown">
                                                    <a class="nav-link" href="{{ route('top-score', [$divisions[0]->id, $category[0]->id]) }}">First Division</a></li>
                                                <li class="dropdown">
                                                    <a class="nav-link" href="{{ route('top-score', [$divisions[1]->id, $category[0]->id]) }}">Second Division</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                                    data-feather="mail"></i><span>Women</span></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="nav-link" href="{{ route('top-score', [$divisions[0]->id, $category[1]->id]) }}">First Division</a></li>
                                                <li><a class="nav-link" href="{{ route('top-score', [$divisions[1]->id, $category[1]->id]) }}">Second Division</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                        @endcan
                    </ul>
                </aside>
            </div>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="./assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="./assets/bundles/cleave-js/dist/cleave.min.js"></script>
    <script src="./assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
    <script src="./assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="./assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="./assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="./assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="./assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="./assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script src="./assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="./assets/js/page/forms-advanced-forms.js"></script>
    <!-- Template JS File -->
    <script src="./assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="./assets/js/custom.js"></script>
</body>

</html>
