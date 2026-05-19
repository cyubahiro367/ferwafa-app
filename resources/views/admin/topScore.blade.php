<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ferwafa - Top Scores</title>

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

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">
                        <h4>Available Top Scores</h4>
                        <div class="card-header-form">
                            <div class="input-group">
                                <a href="{{ route('add.top-score', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                   class="btn btn-primary">
                                    <i class="far fa-user"></i>&nbsp; Add Top Score
                                </a>
                                &nbsp;&nbsp;
                                {{-- Standalone form (no nesting) --}}
                                <form action="{{ route('top-score', [request()->route('divisionID'), request()->route('categoryID')]) }}"
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Goals</th>
                                    <th>Team Name</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($topScores as $key => $topScore)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $topScore['name'] }}</td>
                                        <td>{{ $topScore['goals'] }}</td>
                                        <td>{{ $topScore['teamName'] }}</td>
                                        <td>
                                            <a href="{{ route('top-score.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $topScore['id']]) }}"
                                               class="btn btn-outline-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm delete-top-score"
                                                    data-toggle="modal"
                                                    data-target="#confirmDeleteModal"
                                                    data-score-id="{{ $topScore['id'] }}"
                                                    data-category-id="{{ request()->route('categoryID') }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
                Are you sure you want to delete this player from the top scorers?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteScoreForm" method="POST" action="">
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
        $('.delete-top-score').on('click', function () {
            var scoreId    = $(this).data('score-id');
            var categoryId = $(this).data('category-id');

            var actionUrl = "{{ route('delete.top-score', [':category', ':score']) }}"
                .replace(':category', categoryId)
                .replace(':score', scoreId);

            $('#deleteScoreForm').attr('action', actionUrl);
        });
    });
</script>
</body>
</html>
