<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ferwafa - Fixtures</title>

    <link rel="shortcut icon" href="{{ asset('static/img/federation/ferwafa.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
@include('admin.sidebar')

@php $divisionID = request()->route('divisionID'); @endphp

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">
                        <h4>Fixtures</h4>
                        <div class="card-header-form">
                            <div class="input-group">
                                <a href="{{ route('add.game', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                   class="btn btn-primary">
                                    <i class="far fa-user"></i>&nbsp; Add Match
                                </a>
                                &nbsp;&nbsp;
                                {{-- Standalone form (no nesting) --}}
                                <form action="{{ route('fixtures', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                      method="GET" class="d-flex align-items-center">
                                    <select class="btn btn-primary" name="seasonID">
                                        @foreach ($seasons as $season)
                                            <option value="{{ $season['id'] }}"
                                                {{ $seasonID === $season['id'] ? 'selected' : '' }}>
                                                {{ $season['from'] }} - {{ $season['to'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary ml-1">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger m-3">{{ session('error') }}</div>
                    @endif

                    <div class="card-body p-0">
                        <div class="row">

                            {{-- ===== Group A / Single Division column ===== --}}
                            <div class="{{ $divisionID == 2 ? 'table-responsive col-sm-12 col-md-6 col-xl-6' : 'table-responsive col-12' }}">
                                @if ($divisionID == 2)
                                    <h2 class="px-3 pt-3">Group A</h2>
                                @endif

                                @foreach ($games as $data)
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="9" style="text-align:center; background-color:#133E8D; color:#fff;">
                                                {{ $data[0]['dayName'] }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Home Team</th>
                                            <th>Away Team</th>
                                            <th>Stade</th>
                                            <th>Date</th>
                                            <th>Home Goals</th>
                                            <th>Away Goals</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $key => $game)
                                            @if ($game['groupID'] == 1 || is_null($game['groupID']))
                                                <tr @if ($game['isPlayed']) style="font-weight:bold" @endif>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $game['homeTeam'] }}</td>
                                                    <td>{{ $game['awayTeam'] }}</td>
                                                    <td>{{ $game['stadium'] }}</td>
                                                    <td>{{ $game['date'] }}</td>
                                                    <td>{{ $game['isPlayed'] ? $game['homeTeamGoals'] : '-' }}</td>
                                                    <td>{{ $game['isPlayed'] ? $game['awayTeamGoals'] : '-' }}</td>
                                                    <td>
                                                        <a href="{{ route('game.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $game['id']]) }}"
                                                           class="btn btn-outline-primary btn-sm">Add Scores</a>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                                class="btn btn-outline-danger btn-sm delete-game"
                                                                data-toggle="modal"
                                                                data-target="#confirmDeleteModal"
                                                                data-game-id="{{ $game['id'] }}"
                                                                data-category-id="{{ request()->route('categoryID') }}">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>

                            {{-- ===== Group B (division 2 only) ===== --}}
                            @if ($divisionID == 2)
                                <div class="table-responsive col-sm-12 col-md-6 col-xl-6">
                                    <h2 class="px-3 pt-3">Group B</h2>

                                    @foreach ($games as $data)
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th colspan="9" style="text-align:center; background-color:#133E8D; color:#fff;">
                                                    {{ $data[0]['dayName'] }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Home Team</th>
                                                <th>Away Team</th>
                                                <th>Stade</th>
                                                <th>Date</th>
                                                <th>Home Goals</th>
                                                <th>Away Goals</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($data as $key => $game)
                                                @if ($game['groupID'] == 2)
                                                    <tr @if ($game['isPlayed']) style="font-weight:bold" @endif>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $game['homeTeam'] }}</td>
                                                        <td>{{ $game['awayTeam'] }}</td>
                                                        <td>{{ $game['stadium'] }}</td>
                                                        <td>{{ $game['date'] }}</td>
                                                        <td>{{ $game['isPlayed'] ? $game['homeTeamGoals'] : '-' }}</td>
                                                        <td>{{ $game['isPlayed'] ? $game['awayTeamGoals'] : '-' }}</td>
                                                        <td>
                                                            <a href="{{ route('game.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $game['id']]) }}"
                                                               class="btn btn-outline-primary btn-sm">Add Scores</a>
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                    class="btn btn-outline-danger btn-sm delete-game"
                                                                    data-toggle="modal"
                                                                    data-target="#confirmDeleteModal"
                                                                    data-game-id="{{ $game['id'] }}"
                                                                    data-category-id="{{ request()->route('categoryID') }}">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
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

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
     aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this game?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteGameForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Core JS (load once, in correct order) --}}
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.delete-game').on('click', function () {
            var gameId     = $(this).data('game-id');
            var categoryId = $(this).data('category-id');

            var actionUrl = "{{ route('delete.game', [':category', ':game']) }}"
                .replace(':category', categoryId)
                .replace(':game', gameId);

            $('#deleteGameForm').attr('action', actionUrl);
        });
    });
</script>
</body>
</html>
