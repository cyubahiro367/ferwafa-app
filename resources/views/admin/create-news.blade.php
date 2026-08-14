@extends('layouts.admin')

@section('title', 'Create News')

@section('content')
    <a class="fw-admin-back" href="{{ route('news.view') }}">← Back to News</a>
    <div class="fw-admin-page-header">
        <div>
            <h1>Create News</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            <form method="POST" action="{{ route('post.news') }}" enctype="multipart/form-data" class="fw-admin-submit-guard">
                @csrf
                @if (session()->has('message'))
                    <div class="fw-admin-flash fw-admin-flash-error">{{ session()->get('message') }}</div>
                @endif

                <div class="fw-admin-form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="fw-admin-form-control" required>
                    @error('title')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" id="caption" class="fw-admin-form-control" maxlength="255" required>

                    <small id="captionWordCount" style="display:block; margin-top:5px;">
                        Word Count: 0 / 255
                    </small>

                    <small id="captionError" style="color:red; display:none;">
                        Maximum 255 words allowed.
                    </small>

                    @error('caption')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="statusID">status</label>
                    <select name="statusID" id="statusID" class="fw-admin-form-control" required>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="newsTypeID">News Type</label>
                    <select name="newsTypeID" id="newsTypeID" class="fw-admin-form-control" required>
                        @foreach($newsTypes as $newsType)
                            <option value="{{ $newsType->id }}">{{ $newsType->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="is_top">Is Top News</label>
                    <select name="is_top" id="is_top" class="fw-admin-form-control" required>
                        <option value="0">False</option>
                        <option value="1">True</option>
                    </select>
                </div>

                <div class="fw-admin-form-group">
                    <label for="imageInput">Select Image</label>
                    <input type="file" id="imageInput" name="image" class="fw-admin-form-control" required>
                    @error('image')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="description">Content</label>
                    <textarea name="description" id="description" class="summernote"></textarea>
                    @error('description')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" id="publishBtn" class="fw-admin-btn fw-admin-btn-primary">Publish</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
        function countWords(text) {
            text = text.trim();
            if (text === "") return 0;
            return text.split(/\s+/).length;
        }

        $('#caption').on('input', function () {
            var text = $(this).val();
            var wordCount = countWords(text);

            $('#captionWordCount').text("Word Count: " + wordCount + " / 255");

            if (wordCount > 255) {
                $('#captionError').show();
                $('#publishBtn').prop('disabled', true);
            } else {
                $('#captionError').hide();
                $('#publishBtn').prop('disabled', false);
            }
        });
    </script>
@endpush
