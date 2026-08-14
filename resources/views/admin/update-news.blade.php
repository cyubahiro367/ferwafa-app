@extends('layouts.admin')

@section('title', 'Update News')

@section('content')
    <a class="fw-admin-back" href="{{ route('news.view') }}">← Back to News</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Update News</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('news.page.update',$result->id) }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @method('PUT')
                @if (session()->has('message'))
                    <div class="fw-admin-flash fw-admin-flash-error">{{ session()->get('message') }}</div>
                @endif

                <div class="fw-admin-form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{$result->title }}" class="fw-admin-form-control">
                    @error('title')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" id="caption" value="{{$result->caption }}" class="fw-admin-form-control">
                    @error('caption')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="statusID">status</label>
                    <select name="statusID" id="statusID" class="fw-admin-form-control">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="newsTypeID">News Type</label>
                    <select name="newsTypeID" id="newsTypeID" class="fw-admin-form-control">
                        @foreach($newsTypes as $newsType)
                            <option value="{{ $newsType->id }}">{{ $newsType->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="is_top">Is Top News</label>
                    <select name="is_top" id="is_top" class="fw-admin-form-control">
                        <option value="0">False</option>
                        <option value="1">True</option>
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="imageInput">Select Image</label>
                    <input type="file" id="imageInput" name="image" class="fw-admin-form-control">
                    @error('image')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="description">Content</label>
                    <textarea name="description" id="description" class="summernote">{{ $result->description}}</textarea>
                    @error('description')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
