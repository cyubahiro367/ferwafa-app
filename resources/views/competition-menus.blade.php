<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-xs-12 bg-red rounded shadow-sm p-4">
            <div class="entry-meta text-center">
                <br>
                <!-- Season Select -->
                <form action="{{ route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $day->id, request()->route('groupID')]) }}" method="GET">
                    {{-- <div class="mb-4"> --}}
                        <label for="seasonSelect" class="form-label fs-5">Select Season:</label>
                        <select id="seasonSelect" name="seasonID" class="form-select form-select-lg" required>
                            @foreach ($seasons as $season)
                                <option value="{{ $season['id'] }}"  {{ $seasonID === $season['id'] ? 'selected' : '' }}>
                                    {{ $season['from'] }} - {{ $season['to'] }}
                                </option>
                            @endforeach
                        </select>

                        <label for="daySelect" class="form-label fs-5">Select Day:</label>
                        <select id="daySelect" name="dayID" class="form-select form-select-lg" required>
                            @foreach ($days as $value)
                                <option value="{{ $value->id }}"  {{ $day->id === $value->id ? 'selected' : '' }}>
                                    {{ $value->abbreviation }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary btn-md">Show match</button>
                    {{-- </div> --}}
                </form>

                <!-- Day Results and Fixtures -->
                <div class="mb-4">
                    @if ($day)
                        <div class="btn-group">
                            <a href="{{ route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $day->id, request()->route('groupID')]) }}" class="btn btn-primary">
                                Results & Fixtures
                            </a>
                            <a href="{{ route('men.first-division-table', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, request()->route('groupID')]) }}" class="btn btn-secondary">
                                Standing
                            </a>
                        </div>
                    @else
                        <h4 class="text-danger">No Available Fixtures</h4>
                    @endif
                </div>
                <!-- Day Select -->
                <div class="days-select mb-4">
                    <br>
                    {{-- <label class="form-label fs-5">Select Day:</label>
                    <div class="d-flex justify-content-center flex-wrap">
                        @foreach ($days as $day)
                            <a href="{{ route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $day->id]) }}" class="btn btn-outline-dark mx-2 my-2">
                                {{ $day->abbreviation }}
                            </a>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
