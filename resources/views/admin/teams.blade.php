<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ferwafa - Available Teams</title>

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
                    <div class="card-header">
                        <h4>Available Teams</h4>
                        <div class="card-header-form">
                            <div class="input-group">
                                <a href="{{ route('add.team', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                   class="btn btn-primary">
                                    <i class="far fa-user"></i>&nbsp; Add Team
                                </a>
                                &nbsp;&nbsp;
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger m-3">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger m-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($teams as $team)
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled order-list m-b-0">
                                                <li class="team-member team-member-sm">
                                                    <img class="rounded-circle"
                                                         src="{{ route('team.doc', $team['url']) }}?v=1"
                                                         alt="{{ $team['name'] }}"
                                                         data-toggle="tooltip"
                                                         title="{{ $team['name'] }}">
                                                </li>
                                            </ul>
                                        </td>
                                        <td>{{ $team['name'] }}</td>
                                        <td>{{ $team['category'] }}</td>
                                        <td>
                                            <a href="{{ route('team.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $team['id']]) }}"
                                               class="btn btn-outline-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm delete-team"
                                                    data-toggle="modal"
                                                    data-target="#confirmDeleteModal"
                                                    data-team-id="{{ $team['id'] }}"
                                                    data-category-id="{{ request()->route('categoryID') }}"
                                                    data-division-id="{{ request()->route('divisionID') }}">
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
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this team?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteTeamForm" method="POST" action="">
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

{{-- Plugin JS --}}
<script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>

{{-- Template & Custom JS --}}
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.delete-team').on('click', function () {
            var teamId     = $(this).data('team-id');
            var categoryId = $(this).data('category-id');
            var divisionId = $(this).data('division-id');

            var actionUrl  = "{{ route('delete.team', [':division', ':category', ':team']) }}"
                .replace(':division', divisionId)
                .replace(':category', categoryId)
                .replace(':team', teamId);

            $('#deleteTeamForm').attr('action', actionUrl);
        });
    });
</script>
</body>
</html>
