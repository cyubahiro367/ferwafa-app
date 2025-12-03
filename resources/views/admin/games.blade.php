<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link href="{{ asset('static/img/federation/ferwafa.png') }}" rel="shortcut icon" />
    <title>Ferwafa</title>
</head>


<body>
    @include('admin.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="display: inline-block">Seasons</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ route('add.game', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                            class="btn btn-primary">
                                            <i class="far fa-user"> &nbsp;</i>Add Match
                                        </a>
                                        &nbsp;&nbsp;
                                        <form
                                            action="{{ route('fixtures', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                            method="GET">
                                            <select class="btn btn-primary" name="seasonID">
                                                @foreach ($seasons as $season)
                                                    <option value="{{ $season['id'] }}"
                                                        {{ $seasonID === $season['id'] ? 'selected' : '' }}>
                                                        {{ $season['from'] }} - {{ $season['to'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (session()->has('error'))
                            <div class="badge badge-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <div class="card-body p-0">
                            <div class="row">
                                @if (request()->route('divisionID') == 2)
                                    <div class="table-responsive col-sm-12 col-md-6 col-xl-6 ">
                                        <div>
                                            <h2>Group A</h2>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                @endif

                                @foreach ($games as $data)
                                    <table class="table table-striped">
                                        <tr>
                                            <th style="text-align: center; background-color:#133E8D; color:white"
                                                colspan="9">{{ $data[0]['dayName'] }}</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Home Team</th>
                                            <th>Away Team</th>
                                            <th>Stade</th>
                                            <th>Date</th>
                                            <th>Home Team Goals</th>
                                            <th>Away Team Goals</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                        @foreach ($data as $key => $game)
                                            @if ($game['groupID'] == 1 || is_null($game['groupID']))
                                                <tr @if ($game['isPlayed']) style='font-weight: bold' @endif>
                                                    <td class="text-truncate">{{ $key + 1 }}</td>
                                                    <td> {{ $game['homeTeam'] }}</td>
                                                    <td>{{ $game['awayTeam'] }} </td>
                                                    <td> {{ $game['stadium'] }}</td>
                                                    <td> {{ $game['date'] }}</td>
                                                    <td>
                                                        @if (!$game['isPlayed'])
                                                            -
                                                        @else
                                                            {{ $game['homeTeamGoals'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!$game['isPlayed'])
                                                            -
                                                        @else
                                                            {{ $game['awayTeamGoals'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('game.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $game['id']]) }}"
                                                            class="btn btn-outline-primary">Add Scores</a>

                                                    </td>

                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-outline-danger delete-game"
                                                            data-toggle="modal" data-target="#confirmDeleteModal"
                                                            data-game-id="{{ $game['id'] }}"
                                                            data-category-id="{{ request()->route('categoryID') }}">Delete</button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                @endforeach
                            </div>
                            @if (request()->route('divisionID') == 2)
                                <div class="table-responsive col-sm-12 col-md-6 col-xl-6">
                                    <div>
                                        <h2>Group B</h2>
                                    </div>
                                    @foreach ($games as $data)
                                        <table class="table table-striped">
                                            <tr>
                                                <th style="text-align: center; background-color:#133E8D; color:white"
                                                    colspan="9">{{ $data[0]['dayName'] }}</th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Home Team</th>
                                                <th>Away Team</th>
                                                <th>Stade</th>
                                                <th>Date</th>
                                                <th>Home Team Goals</th>
                                                <th>Away Team Goals</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                            @foreach ($data as $key => $game)
                                                @if ($game['groupID'] == 2)
                                                    <tr
                                                        @if ($game['isPlayed']) style='font-weight: bold' @endif>
                                                        <td class="text-truncate">{{ $key + 1 }}</td>
                                                        <td> {{ $game['homeTeam'] }}</td>
                                                        <td>{{ $game['awayTeam'] }} </td>
                                                        <td> {{ $game['stadium'] }}</td>
                                                        <td> {{ $game['date'] }}</td>
                                                        <td>
                                                            @if (!$game['isPlayed'])
                                                                -
                                                            @else
                                                                {{ $game['homeTeamGoals'] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!$game['isPlayed'])
                                                                -
                                                            @else
                                                                {{ $game['awayTeamGoals'] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('game.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $game['id']]) }}"
                                                                class="btn btn-outline-primary">Add Scores</a>

                                                        </td>

                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-outline-danger delete-game"
                                                                data-toggle="modal" data-target="#confirmDeleteModal"
                                                                data-game-id="{{ $game['id'] }}"
                                                                data-category-id="{{ request()->route('categoryID') }}">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </table>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Game ?
                </div>
                <div class="modal-footer">
                    <form id="deleteGameForm" method="POST" action="{{ route('delete.game', [0, 0]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script type="module" src="{{ asset('src/main.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.delete-game').click(function() {
                var gameId = $(this).data('game-id');
                var categoryId = $(this).data('category-id');
                var form = $('#deleteGameForm');
                var action = form.attr('action');
                form.attr('action', action.replace(0, categoryId).replace(0, gameId));
            });
        });
    </script>
</body>
