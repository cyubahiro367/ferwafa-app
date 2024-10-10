<!DOCTYPE html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no"
        name="viewport />
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ asset('images/favicon.ico') }}" />

    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/apple-icon-114x114.png') }}" />

    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/apple-icon-72x72.png') }}" />

    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/apple-icon-57x57.png') }}" />

    <!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lib.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/Stroke-Gap-Icon/stroke-gap-icon.css') }}" />

    <!-- Custom - Common CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navigation-menu.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lightslider-master/lightslider.css') }}" />

    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shortcode.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @php
        // $day = DB::table('Game')
        // ->join('Day', 'Day.id', '=', 'Game.dayID')
        // ->where('Game.isPlayed', 1)
        // ->orderBy('Day.id', 'DESC')
        // ->first(['Game.dayID']);
        $competions = DB::table('TeamCategory')
            ->select('id', 'name')
            ->get();

        $menDay = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team', 'Team.id', '=', 'homeTeamID')
            ->join('TeamCategory', 'Team.categoryID', '=', 'TeamCategory.id')
            ->where('Game.isPlayed', 1)
            ->where('TeamCategory.id', $competions[0]->id)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);
        $womenDay = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team', 'Team.id', '=', 'homeTeamID')
            ->join('TeamCategory', 'Team.categoryID', '=', 'TeamCategory.id')
            ->where('Game.isPlayed', 1)
            ->where('TeamCategory.id', $competions[1]->id)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);

        $season = DB::table('Season')
        ->select('id')
        ->orderBy('created_at', 'DESC')
        ->first();
    @endphp
    <header>
        <div class="headerbox">
            <div style=" height: 90px" class="container">
                <div class="row justify-content-between align-items-center;">
                    <div class="col">
                        <div style="" class="logo">
                            <a href="/" title="Return Home"><img
                                    style="height: 90px; margin-bottom: 100px; margin-left: 20px" alt="Logo"
                                    class="logo_img" src="{{ asset('static/img/federation/ferwafa.png') }}" /></a>
                        </div>
                    </div>
                    <div class="col" style="display: flex;">
                        <div style="margin-top: 20px;">
                            <marquee behavior="" direction="left">
                                @if ($menDay)
                                    <h2 style="color:  #133E8D"> <a href="#}" style="color:  #133E8D">About Primus
                                            National League Click here</a></h2>
                                @else
                                    <h2 style="color:  #133E8D"> <a href="#" style="color:  #133E8D">About Primus
                                            National League Click here</a></h2>
                                @endif
                            </marquee>
                        </div>
                    </div>
                    <div class="col">
                        <img alt="" height="100px" width="" class="img-responsive banner-image"
                            src="{{ asset('static/img/federation/primus.png') }}" /><a class="mobile-nav"
                            href="#mobile-nav"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="mainmenu">
        <div class="container">
            <!-- Menu-->
            <ul class="sf-menu" id="menu">
                <li class="current"><a href="/">Home</a></li>
                <li class="current"><a href="{{ route('about') }}">About</a></li>
                <li class="current">
                    <a href="">Competitions</a>
                    <ul class="sub-current">
                        <li>
                            <a href="#">{{ $competions[0]->name }}</a>
                            <ul class="sub-current">
                                @if ($menDay)
                                    <li><a href="#}">Primus
                                            National</a></li>
                                @else
                                    <li><a href="#">Primus
                                            National</a></li>
                                @endif
                                <li><a href="#">Second Division</a></li>
                                <li><a href="#">Third Division</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">{{ $competions[1]->name }}</a>
                            <ul class="sub-current">
                                @if ($womenDay)
                                    <li><a href="{{ route('fixtures.show', [$season->id, $competions[1]->id, $womenDay->dayID]) }}">First
                                            Division</a></li>
                                @else
                                    <li><a href="{{ route('fixtures.show', [$season->id, $competions[1]->id, 1]) }}">First
                                            Division</a></li>
                                @endif
                                <li><a href="#">Second Division</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Peace Cup</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="#">National Team</a>
                    <ul class="sub-current">
                        <li>
                            <a href="#">{{ $competions[0]->name }}</a>
                            <ul class="sub-current">
                                <li><a href="{{ route('seniorMen.news') }}">Senior</a></li>
                                <li><a href="{{ route('u23.news') }}">U-23 Olympic</a></li>
                                <li><a href="{{ route('u17.news') }}">U-17</a></li>
                                <li><a href="{{ route('otherMen.news') }}">Other</a></li>
                                <!-- <li><a href="#">History</a></li> -->
                            </ul>
                        </li>
                        <li>
                            <a href="#">{{ $competions[1]->name }}</a>
                            <ul class="sub-current">
                                <li><a href="{{ route('seniorWomen.news') }}">Senior</a></li>
                                <li><a href="{{ route('u20Women.news') }}">U-20</a></li>
                                <li><a href="{{ route('otherWomen.news') }}">Other</a></li>
                                <!-- <li><a href="#">History</a></li> -->
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="#">Other</a>
                            <ul class="sub-current">
                                <li><a href="#">Results</a></li>
                                <li><a href="#">Fixtures</a></li>
                                <li><a href="#">Statistics</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </li>
                <li class="current">
                    <a href="#">Resources</a>
                    <ul class="sub-current">
                        <li><a href="{{ route('report') }}">Report</a></li>
                        <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                        <li>
                            <a href="javascript:void(0);">Rules &amp; Regulations</a>
                            <ul class="sub-current">
                                <li><a href="{{ route('laws.page.show') }}">Laws of The Games</a></li>
                                <li><a href="{{ route('rules.page.show') }}">Others</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                        <li><a href="{{ route('gallery.images') }}">Gallery</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="">Development</a>
                    <ul class="sub-current">
                        <li><a href="{{ route('grassroots.news') }}">Grassroots Football</a></li>
                        <li><a href="{{ route('schools.news') }}">Football for schools</a></li>
                        <li><a href="{{ route('youth.news') }}">Youth Development</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="#">Career</a>
                    <ul class="sub-current">
                        <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                        <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                        <li><a href="{{ route('career.page.show') }}">Others</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="#">Contact</a>
                    <ul class="sub-current">
                        <li><a href="{{ route('information') }}">Information</a></li>
                        <li><a href="{{ route('whistleblowers') }}">Whistleblowers</a></li>
                    </ul>
                </li>
                @if (!Auth::check())
                    <li class="">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
            <!-- End Menu-->
        </div>
    </nav>
    <div id="mobile-nav">
        <!-- Menu-->
        <ul class="" id="">
            <li class=""><a href="/">Home</a></li>
            <li class=""><a href="{{ route('about') }}">About</a></li>
            <li class="">
                <a href="javascript:void(0);">Competitions</a>
                <ul class="#">
                    <li>
                        <a href="#">{{ $competions[0]->name }}</a>
                        <ul class="#">
                            @if ($menDay)
                                <li><a href="#}">Primus
                                        National</a></li>
                            @else
                                <li><a href="#">Primus
                                        National</a></li>
                            @endif
                            <li><a href="#">Second Division</a></li>
                            <li><a href="#">Third Division</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">{{ $competions[1]->name }}</a>
                        <ul class="#">
                            @if ($womenDay)
                                <li><a href="{{ route('fixtures.show', [$season->id, $competions[1]->id, $womenDay->dayID]) }}">First
                                        Division</a></li>
                            @else
                                <li><a href="{{ route('fixtures.show', [$season->id, $competions[1]->id, 1]) }}">First Division</a>
                                </li>
                            @endif
                            <li><a href="#">Second Division</a></li>
                        </ul>
                    </li>

                    <li><a href="#">Peace Cup</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:void(0);">National Team</a>
                <ul class="#">
                    <li>
                        <a href="#">{{ $competions[0]->name }}</a>
                        <ul class="#">
                            <li><a href="{{ route('seniorMen.news') }}">Senior</a></li>
                            <li><a href="{{ route('u23.news') }}">U-23 Olympic</a></li>
                            <li><a href="{{ route('u17.news') }}">U-17</a></li>
                            <li><a href="{{ route('otherMen.news') }}">Other</a></li>
                            <!-- <li><a href="#">History</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="#">{{ $competions[1]->name }}</a>
                        <ul class="#">
                            <li><a href="{{ route('seniorWomen.news') }}">Senior</a></li>
                            <li><a href="{{ route('u20Women.news') }}">U-20</a></li>
                            <li><a href="route('otherWomen.news') }}">Other</a></li>
                            <!-- <li><a href="#">History</a></li> -->
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="#">Other</a>
                        <ul class="#">
                            <li><a href="#">Results</a></li>
                            <li><a href="#">Fixtures</a></li>
                            <li><a href="#">Statistics</a></li>
                        </ul>
                    </li> -->
                </ul>
            </li>
            <li class="javascript:void(0);">
                <a href="#">Resources</a>
                <ul class="#">
                    <li><a href="{{ route('report') }}">Report</a></li>
                    <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                    <li>
                        <a href="">Rules &amp; Regulations</a>
                        <ul class="#">
                            <li><a href="{{ route('laws.page.show') }}">Laws of The Game</a></li>
                            <li><a href="{{ route('rules.page.show') }}">Others</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                    <li><a href="{{ route('gallery.images') }}">Gallery</a></li>
                </ul>
            </li>
            <li class="">
                <a href="">Development</a>
                <ul class="#">
                    <li><a href="{{ route('grassroots.news') }}">Grassroots Football</a></li>
                    <li><a href="{{ route('schools.news') }}">Football for schools</a></li>
                    <li><a href="{{ route('youth.news') }}">Youth Development</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#">Career</a>
                <ul class="#">
                    <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                    <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                    <li><a href="{{ route('career.page.show') }}">Others</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#">Contact</a>
                <ul class="#">
                    <li><a href="{{ route('information') }}">Information</a></li>
                    <li><a href="#">Whistleblowers</a></li>
                </ul>
            </li>
            @if (!Auth::check())
                <li class="">
                    <a href="{{ route('login') }}">Login</a>
                </li>
            @endif
        </ul>
        <!-- End Menu-->
    </div>

    <!-- built files will be auto injected -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Library - Js -->
    <script src="{{ asset('libraries/lib.js') }}"></script>
    <!-- Bootstrap JS File v3.3.5 -->
    <script src="{{ asset('libraries/jquery.countdown.min.js') }}"></script>

    <script src="{{ asset('libraries/lightslider-master/lightslider.js') }}"></script>
    <!-- Library - Google Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn3Z6i1AYolP3Y2SGis5qhbhRwmxxo1wU"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
</body>

</html>
