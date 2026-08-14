@extends('layouts.admin')

@section('title', 'Add Document')

@section('content')
    <a class="fw-admin-back" href="{{ route('reports.view') }}">← Back to Documents</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Add Document</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('create.report') }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf

                <div class="fw-admin-form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="fw-admin-form-control">
                    @error('title')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="typeID">Type</label>
                    <select name="typeID" id="typeID" class="fw-admin-form-control">
                        @foreach ($types as $type)
                            <option value="{{ $type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="reportFile">Select PDF File</label>
                    <input type="file" name="reportFile" id="reportFile" class="fw-admin-form-control">
                    @error('reportFile')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
