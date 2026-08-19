@php
    $requireUser = $requireUser ?? false;
    $userId = $userId ?? null;
    $from = $from ?? now()->subMonth()->toDateString();
    $to = $to ?? now()->toDateString();
    $users = $users ?? collect();
    $seasonOptions = $seasonOptions ?? null;
    $seasonID = $seasonID ?? null;
    $dayOptions = $dayOptions ?? null;
    $dayID = $dayID ?? null;
@endphp
<div class="fw-admin-panel fw-admin-list-filters-panel">
    <div class="fw-admin-panel-body fw-admin-form">
        <form method="GET" action="{{ $action }}" class="fw-admin-list-filters">
            @if(!empty($seasonOptions))
                <div class="fw-admin-list-filter-field">
                    <label for="seasonID">Season</label>
                    <select name="seasonID" id="seasonID" class="form-control">
                        @foreach ($seasonOptions as $season)
                            <option value="{{ $season['id'] }}" @selected((int) $seasonID === (int) $season['id'])>
                                {{ $season['from'] }} - {{ $season['to'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if(is_array($dayOptions) || $dayOptions instanceof \Illuminate\Support\Collection)
                <div class="fw-admin-list-filter-field">
                    <label for="dayID">Day</label>
                    <select name="dayID" id="dayID" class="form-control">
                        <option value="">All days</option>
                        @foreach ($dayOptions as $day)
                            @php $dayRow = is_array($day) ? $day : $day->toArray(); @endphp
                            <option value="{{ $dayRow['id'] }}" @selected(isset($dayID) && (int) $dayID === (int) $dayRow['id'])>
                                {{ $dayRow['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="fw-admin-list-filter-field fw-admin-list-filter-user">
                <label for="userID">{{ $requireUser ? 'User' : 'Created by' }}</label>
                <select name="userID" id="userID" class="form-control" @required($requireUser)>
                    @unless($requireUser)
                        <option value="">All users</option>
                    @else
                        <option value="">Select a user…</option>
                    @endunless
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected((int) $userId === (int) $user->id)>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="fw-admin-list-filter-field">
                <label for="from">From</label>
                <input type="date" name="from" id="from" class="form-control" value="{{ $from }}">
            </div>

            <div class="fw-admin-list-filter-field">
                <label for="to">To</label>
                <input type="date" name="to" id="to" class="form-control" value="{{ $to }}">
            </div>

            <div class="fw-admin-list-filter-field fw-admin-list-filter-submit">
                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">{{ $submitLabel ?? 'Filter' }}</button>
                <button type="submit" name="format" value="xlsx" class="fw-admin-btn fw-admin-btn-secondary">Excel</button>
                <button type="submit" name="format" value="pdf" class="fw-admin-btn fw-admin-btn-secondary" formtarget="_blank">PDF</button>
            </div>
        </form>
    </div>
</div>
