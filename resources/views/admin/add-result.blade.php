<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ferwafa - Add Goal Results</title>

    <link rel="shortcut icon" href="{{ asset('static/img/federation/ferwafa.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    {{-- Plugin CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
</head>

<body>
@include('admin.sidebar')

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Goal Results</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('create.game.result', [request()->route('divisionID'), request()->route('categoryID'), $gameID]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Home Team Goals --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3">
                                    {{ $team->homeTeam }}
                                </label>
                                <input type="hidden" name="homeTeamID" value="{{ $team->homeTeamID }}">
                                <div class="col-sm-12 col-md-7">
                                    <input type="number" name="homeTeamGoals" class="form-control" min="0">
                                    @error('homeTeamGoals')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Away Team Goals --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3">
                                    {{ $team->awayTeam }}
                                </label>
                                <input type="hidden" name="awayTeamID" value="{{ $team->awayTeamID }}">
                                <div class="col-sm-12 col-md-7">
                                    <input type="number" name="awayTeamGoals" class="form-control" min="0">
                                    @error('awayTeamGoals')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group row mb-4">
                                <div class="col-sm-12 col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Core JS (load once, in correct order) --}}
<script src="{{ asset('assets/js/app.min.js') }}"></script>

{{-- Plugin JS --}}
<script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/bundles/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('assets/bundles/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('assets/bundles/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/page/ckeditor.js') }}"></script>

{{-- Template & Custom JS --}}
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
