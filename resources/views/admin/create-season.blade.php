@extends('layouts.admin')

@section('title', 'Create Season')

@section('content')
    <a class="fw-admin-back" href="{{ route('season') }}">← Back to Seasons</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Create Season</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('create.season') }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf

                <div class="fw-admin-form-group">
                    <label for="from">Start Date</label>
                    <input type="date" name="from" id="from" class="fw-admin-form-control">
                    @error('from')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="to">End Date</label>
                    <input type="date" name="to" id="to" class="fw-admin-form-control">
                    @error('to')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
