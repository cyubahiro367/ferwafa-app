<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
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
                            <h4>Available Reports</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ route('add.doc') }}" class="btn btn-primary">
                                            <i class="far fa-user"> &nbsp;</i>Add Report
                                        </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control" placeholder="Search" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                    @foreach($reports as $key => $report)
                                    <tr>
                                        <td>{{ $key+1}} </td>
                                        <td>{{ $report['title']}} </td>
                                        <td>{{ $report['type']}}</td>
                                        <td>

                                            <div>
                                                <a href="{{ route('report.doc', $report['url']) }}?v=1" target="_blank" class="btn btn-outline-success">Open</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-outline-danger delete-game" data-toggle="modal" data-target="#confirmDeleteModal" data-game-id="{{ $report['id'] }}">Delete</button>

                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('document.page.edit', $report['id']) }}" class="btn btn-outline-primary">Edit</a>
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
                    Are you sure you want to delete this Document ?
                </div>
                <div class="modal-footer">
                    <form id="deleteGameForm" method="POST" action="{{ route('delete.report', 0) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="/src/main.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-game').click(function() {
                var gameId = $(this).data('game-id');
                var form = $('#deleteGameForm');
                var action = form.attr('action');
                // Update the form action with the correct game ID
                form.attr('action', action.replace('0', gameId));
            });
        });
    </script>

</body>