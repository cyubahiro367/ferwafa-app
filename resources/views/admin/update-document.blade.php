@extends('layouts.admin')

@section('title', 'Update Document')

@section('content')
    <a class="fw-admin-back" href="{{ route('reports.view') }}">← Back to Documents</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Update Document</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('update.report', $report->id) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $report->title) }}" class="fw-admin-form-control">
                    @error('title')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="typeID">Type</label>
                    <select name="typeID" id="typeID" class="fw-admin-form-control">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ (string) old('typeID', $report->type_id) === (string) $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="reportFile">Select PDF File</label>
                    @if ($report->url)
                        <div style="margin-bottom:10px;">
                            <a href="{{ route('report.doc', $report->id) }}" target="_blank" rel="noopener" class="fw-admin-btn fw-admin-btn-secondary fw-admin-btn-sm">View current PDF</a>
                        </div>
                    @endif
                    <input type="file" name="reportFile" id="reportFile" class="fw-admin-form-control">
                    <p class="fw-admin-muted" style="margin-top:8px;font-size:13px;">Leave empty to keep the current file.</p>
                    @error('reportFile')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
