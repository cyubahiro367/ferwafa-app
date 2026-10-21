@php
    $filterFormAction = $filterFormAction ?? '';
    $seasonID = $seasonID ?? null;
    $seasons = $seasons ?? [];
    $days = $days ?? collect();
    $day = $day ?? null;
    $showGroupFilter = $showGroupFilter ?? false;
    $groups = $groups ?? collect();
    $groupID = $groupID ?? null;
    $divisionID = (int) ($divisionID ?? request()->route('divisionID') ?? 0);
    $isSecondDivision = $divisionID === 2;
@endphp
<form action="{{ $filterFormAction }}" method="GET" style="display:flex;flex-wrap:wrap;gap:16px;align-items:flex-end;margin-bottom:28px;" id="competitionFiltersForm">
    <div class="fw-form-group" style="margin:0;min-width:180px;">
        <label class="fw-form-label" for="seasonSelect">Season</label>
        <select id="seasonSelect" name="seasonID" class="fw-form-select" required>
            @foreach ($seasons as $season)
                <option value="{{ $season['id'] }}"
                    data-plays-in-groups="{{ ($season['playsInGroups'] ?? true) ? '1' : '0' }}"
                    {{ (int) $seasonID === (int) $season['id'] ? 'selected' : '' }}>
                    {{ $season['from'] }} - {{ $season['to'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="fw-form-group" style="margin:0;min-width:140px;">
        <label class="fw-form-label" for="daySelect">Matchday</label>
        <select id="daySelect" name="dayID" class="fw-form-select" required>
            @foreach ($days as $value)
                <option value="{{ $value->id }}" {{ ($day->id ?? null) == $value->id ? 'selected' : '' }}>
                    {{ $value->abbreviation ?? $value->name }}
                </option>
            @endforeach
        </select>
    </div>
    @if ($isSecondDivision)
        <div class="fw-form-group" id="groupFilterWrap" style="margin:0;min-width:140px;{{ $showGroupFilter ? '' : 'display:none;' }}">
            <label class="fw-form-label" for="groupSelect">Group</label>
            <select id="groupSelect" name="groupID" class="fw-form-select" @if($showGroupFilter) required @endif>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ (int) $groupID === (int) $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif
    <button type="submit" class="fw-btn-gold">Show Matches</button>
</form>

<script>
(function () {
    var seasonSelect = document.getElementById('seasonSelect');
    var daySelect = document.getElementById('daySelect');
    var groupWrap = document.getElementById('groupFilterWrap');
    var groupSelect = document.getElementById('groupSelect');
    var isSecondDivision = {{ $isSecondDivision ? 'true' : 'false' }};

    if (!seasonSelect || !daySelect) {
        return;
    }

    function syncGroupField() {
        if (!isSecondDivision || !groupWrap || !groupSelect) {
            return;
        }
        var option = seasonSelect.options[seasonSelect.selectedIndex];
        var show = option && option.getAttribute('data-plays-in-groups') === '1';
        groupWrap.style.display = show ? '' : 'none';
        groupSelect.required = show;
        if (!show) {
            groupSelect.removeAttribute('name');
        } else {
            groupSelect.setAttribute('name', 'groupID');
        }
    }

    function loadDaysForSeason(seasonId, selectedDayId) {
        if (!seasonId) {
            daySelect.innerHTML = '';
            return;
        }

        daySelect.innerHTML = '<option value="">Loading…</option>';
        daySelect.disabled = true;

        fetch('/api/days/' + seasonId, {
            headers: { 'Accept': 'application/json' }
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Failed to load days');
                }
                return response.json();
            })
            .then(function (data) {
                var days = Array.isArray(data) ? data : (data.results || data.data || []);
                daySelect.innerHTML = '';

                if (!days.length) {
                    var empty = document.createElement('option');
                    empty.value = '';
                    empty.textContent = 'No matchdays';
                    daySelect.appendChild(empty);
                    daySelect.disabled = false;
                    return;
                }

                days.forEach(function (dayRow) {
                    var option = document.createElement('option');
                    option.value = dayRow.id;
                    option.textContent = dayRow.abbreviation || dayRow.name || ('Day ' + dayRow.id);
                    if (selectedDayId && String(selectedDayId) === String(dayRow.id)) {
                        option.selected = true;
                    }
                    daySelect.appendChild(option);
                });

                if (!selectedDayId && daySelect.options.length) {
                    // Prefer highest day id (latest matchday) after season change
                    daySelect.selectedIndex = daySelect.options.length - 1;
                }

                daySelect.disabled = false;
            })
            .catch(function () {
                daySelect.innerHTML = '<option value="">Error loading days</option>';
                daySelect.disabled = false;
            });
    }

    seasonSelect.addEventListener('change', function () {
        syncGroupField();
        loadDaysForSeason(seasonSelect.value, null);
    });

    syncGroupField();
})();
</script>
