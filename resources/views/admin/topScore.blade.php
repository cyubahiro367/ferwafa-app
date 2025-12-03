<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset("assets/css/app.min.css")}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/components.css")}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}">
    <link href="{{asset("static/img/federation/ferwafa.png")}}" rel="shortcut icon" />
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
                            <h4>Available Top Scores</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ route('add.top-score', [request()->route('divisionID'), request()->route('categoryID')]) }}" class="btn btn-primary">
                                            <i class="far fa-user"> &nbsp;</i>Add Top Score
                                        </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;
                                        <form action="{{ route('top-score', [request()->route('divisionID'), request()->route('categoryID')]) }}" method="GET">
                                            <select class="btn btn-primary" name="seasonID">
                                                @foreach ($seasons as $season)
                                                    <option value="{{$season['id']}}" {{ $seasonID === $season['id'] ? 'selected' : '' }}>{{ $season['from'] }} - {{ $season['to'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
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
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Goals</th>
                                        <th>Team Name</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                    @foreach ($topScores as $key => $topScore)
                                    <tr>
                                        <td class="text-truncate">{{$key+1}}</td>
                                        <td> {{ $topScore["name"] }}</td>
                                        <td>{{ $topScore["goals"] }}</td>
                                        <td>{{ $topScore["teamName"] }}</td>
                                        <td>
                                            <a href="{{ route('top-score.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $topScore['id']]) }}" class="btn btn-outline-primary">Edit</a>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-outline-danger delete-game" data-toggle="modal" data-target="#confirmDeleteModal" data-game-id="{{ $topScore['id'] }}" data-category-id="{{ request()->route('categoryID')}}">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Player in Top scorers ?
                </div>

                <div class="modal-footer">
                    <form id="deleteGameForm" method="POST" action="{{ route('delete.top-score', [0,0]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script type="module" src="{{asset("src/main.js")}}"></script>
    <script src="{{asset("assets/js/app.min.js")}}"></script>
    <script src="{{asset("assets/js/custom.js")}}"></script>
    <script src="{{asset("assets/js/scripts.js")}}"></script>
    <script src="{{asset("assets/js/scripts.js")}}"></script>
    <script src="{{asset("assets/js/custom.js")}}"></script>
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