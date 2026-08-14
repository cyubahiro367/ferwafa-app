@extends('layouts.admin')

@section('title', 'Create Day')

@section('content')
    <a class="fw-admin-back" href="{{ route('day.season') }}">← Back to Days</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Create Day</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('create.day.season') }}" class="fw-admin-submit-guard">
                @csrf

                <div class="fw-admin-form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="fw-admin-form-control">
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="abbreviation">Abbreviation</label>
                    <input type="text" name="abbreviation" id="abbreviation" class="fw-admin-form-control">
                    @error('abbreviation')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="seasonID">Season</label>
                    <select name="seasonID" id="seasonID" class="fw-admin-form-control">
                        @foreach($seasons as $season)
                            <option value="{{ $season['id'] }}">{{ date('Y', strtotime($season['from'])) }}-{{ date('Y', strtotime($season['to'])) }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
