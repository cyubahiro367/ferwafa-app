@extends('layouts.admin')

@section('title', 'Sendkey')

@section('content')
<a class="fw-admin-back" href="{{ route('dashboard.view') }}">← Back to Dashboard</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Sendkey</h1>
        </div>
    </div>

        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="POST" action="{{ route('sending.key') }}" class="fw-admin-submit-guard">
                            @csrf
                            <div class="fw-admin-panel">
                                <div class="fw-admin-panel-body fw-admin-form">
                                    <div class="section-title">Email</div>
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" required>
                                        @error('email')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="section-title">Select Permission</div>
                                    <div class="form-group">
                                        <select name="key" class="form-control select2">
                                            @foreach($keys as $key)
                                            <option value="{{$key->id}}">{{$key->permissionName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button name="login" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    
@endsection
