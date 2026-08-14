@extends('layouts.admin')

@section('title', 'Update Suspended Player')

@section('content')
    <div class="fw-admin-page-header">
        <div>
            <h1>Update Suspended Player</h1>
        </div>
    </div>

    <div class="fw-admin-panel">
        <div class="fw-admin-panel-body fw-admin-form">
            @if(session('error'))
                <div class="fw-admin-flash fw-admin-flash-error">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="fw-admin-flash fw-admin-flash-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="fw-admin-flash fw-admin-flash-error">
                    <ul class="mb-0 pl-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                action="{{ route('update.player-suspended', [request()->route('divisionID'), request()->route('categoryID'), $playerSuspended->id]) }}"
                enctype="multipart/form-data"
                id="updatePlayerForm"
                class="fw-admin-submit-guard">
                @csrf
                @method('PUT')

                <div class="fw-admin-form-group">
                    <label for="seasonID">Season <span class="text-danger">*</span></label>
                    <select name="seasonID" id="seasonID" class="fw-admin-form-control" required>
                        @foreach ($seasons as $season)
                            <option value="{{ $season['id'] }}"
                                {{ $playerSuspended->seasonID == $season['id'] ? 'selected' : '' }}>
                                {{ $season['from'] }} - {{ $season['to'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('seasonID')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="dayID">Day <span class="text-danger">*</span></label>
                    <select name="dayID" id="dayID" class="fw-admin-form-control" required>
                        <option value="">Loading days...</option>
                    </select>
                    @error('dayID')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="name">Player Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="fw-admin-form-control"
                        value="{{ old('name', $playerSuspended->name) }}"
                        placeholder="Enter player's full name"
                        required>
                    @error('name')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="teamID">Team <span class="text-danger">*</span></label>
                    <select name="teamID" id="teamID" class="fw-admin-form-control" required>
                        <option value="">Select Team</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team['id'] }}"
                                {{ old('teamID', $playerSuspended->teamID) == $team['id'] ? 'selected' : '' }}>
                                {{ $team['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('teamID')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fw-admin-form-group">
                    <label for="reason">Suspension Reason <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text" name="reason" id="reason"
                            class="fw-admin-form-control"
                            value="{{ old('reason', $playerSuspended->reason) }}"
                            placeholder="Enter suspension reason (max 30 characters)"
                            maxlength="30"
                            required>
                        <div id="reasonSuggestions" class="suggestion-box"></div>
                    </div>
                    <div id="charCount" class="character-counter">0/30 characters</div>
                    @error('reason')
                        <div class="fw-admin-flash fw-admin-flash-error" style="margin-top:8px;">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Start typing to see matching existing reasons
                    </small>
                </div>

                <button type="submit" class="fw-admin-btn fw-admin-btn-primary">
                    <i class="fas fa-save"></i> Update Player
                </button>
                <a href="{{ route('player-suspended', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                    class="btn btn-outline-secondary ml-2">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
        $(document).ready(function() {
            console.log('Document ready, initializing update page...');
            
            // Store current player suspended day ID
            const playerSuspendedDayId = {{ $playerSuspended->dayID ?? 'null' }};
            console.log('Player suspended day ID:', playerSuspendedDayId);
            
            // Initialize character counter for reason field
            const reasonInput = $('#reason');
            const charCounter = $('#charCount');
            
            function updateCharCounter() {
                const length = reasonInput.val().length;
                charCounter.text(length + '/30 characters');
                
                // Change color based on length
                charCounter.removeClass('warning danger');
                if (length > 25) {
                    charCounter.addClass('danger');
                } else if (length > 20) {
                    charCounter.addClass('warning');
                }
            }
            
            reasonInput.on('input', updateCharCounter);
            updateCharCounter(); // Initial update
            
            // Day selection functionality
            function loadDays(seasonId, selectedDayId = null) {
                console.log('Loading days for season:', seasonId, 'with selected day:', selectedDayId);
                
                if (!seasonId) {
                    $('#dayID').html('<option value="">Select Season First</option>');
                    return;
                }
                
                // Show loading message
                $('#dayID').html('<option value="">Loading days...</option>');
                
                // Fetch days from API
                $.ajax({
                    url: '/api/days/' + seasonId,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Days data received:', data);
                        
                        // Clear loading message
                        $('#dayID').empty();
                        
                        // Add default option
                        $('#dayID').append('<option value="">Select Day</option>');
                        
                        // Check data format
                        var days = [];
                        if (data.results && Array.isArray(data.results)) {
                            days = data.results;
                        } else if (Array.isArray(data)) {
                            days = data;
                        } else if (data.data && Array.isArray(data.data)) {
                            days = data.data;
                        }
                        
                        if (days.length === 0) {
                            $('#dayID').html('<option value="">No days found for this season</option>');
                            return;
                        }
                        
                        // Add days to select
                        days.forEach(function(day) {
                            var optionText = day.name || ('Day ' + day.id) || ('Date: ' + (day.date || 'N/A'));
                            var isSelected = false;
                            
                            // Check if this day should be selected
                            if (selectedDayId && day.id == selectedDayId) {
                                isSelected = true;
                            }
                            
                            var option = $('<option></option>')
                                .val(day.id)
                                .text(optionText);
                            
                            if (isSelected) {
                                option.prop('selected', true);
                            }
                            
                            $('#dayID').append(option);
                        });
                        
                        // If no day was selected from the API results, check if we should use the player suspended day
                        if (selectedDayId && !$('#dayID').val() && playerSuspendedDayId) {
                            // Create a special option for the player's day
                            $('#dayID').append(
                                $('<option></option>')
                                    .val(playerSuspendedDayId)
                                    .text('Player Suspension Day (ID: ' + playerSuspendedDayId + ')')
                                    .prop('selected', true)
                            );
                        }
                        
                        // Also check old input in case of form validation errors
                        var oldDayId = @json(old('dayID', ''));
                        if (oldDayId) {
                            $('#dayID').val(oldDayId);
                        }
                        
                        console.log('Days loaded successfully:', days.length + ' days');
                        console.log('Selected day:', $('#dayID').val());
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load days:', error);
                        console.error('Response:', xhr.responseText);
                        
                        // Fallback: Create option with player suspended day
                        $('#dayID').empty().append('<option value="">Error loading days</option>');
                        
                        if (playerSuspendedDayId) {
                            $('#dayID').append(
                                $('<option></option>')
                                    .val(playerSuspendedDayId)
                                    .text('Player Suspension Day (ID: ' + playerSuspendedDayId + ')')
                                    .prop('selected', true)
                            );
                        }
                    }
                });
            }
            
            // Handle season change
            $('#seasonID').on('change', function() {
                var seasonId = $(this).val();
                console.log('Season changed to:', seasonId);
                
                // Load days for the new season
                loadDays(seasonId);
            });
            
            // Initialize with current season
            var initialSeason = $('#seasonID').val();
            if (initialSeason) {
                // Load days and pre-select the player's day
                loadDays(initialSeason, playerSuspendedDayId);
            }
            
            // Reason autocomplete functionality
            let suggestionTimeout;
            const suggestionBox = $('#reasonSuggestions');
            
            reasonInput.on('input', function() {
                const query = $(this).val().trim();
                
                // Clear previous timeout
                clearTimeout(suggestionTimeout);
                
                // Hide suggestions if query is too short
                if (query.length < 2) {
                    suggestionBox.hide().empty();
                    return;
                }
                
                // Set new timeout for API call
                suggestionTimeout = setTimeout(function() {
                    fetchReasons(query);
                }, 300);
            });
            
            function fetchReasons(query) {
                // Fetch existing suspension reasons from your database
                $.ajax({
                    url: '/api/suspension-reasons/search',
                    method: 'GET',
                    data: { 
                        query: query,
                        limit: 5 
                    },
                    success: function(data) {
                        displaySuggestions(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch reasons:', error);
                        // Show some common suggestions as fallback
                        const commonSuggestions = [
                            "Red card offense",
                            "Violent conduct", 
                            "Serious foul play",
                            "Using offensive language",
                            "Unsportsmanlike behavior",
                            "Disrespecting officials",
                            "Fighting",
                            "Doping violation",
                            "Missed doping test",
                            "Field invasion",
                            "Throwing objects"
                        ];
                        
                        const filtered = commonSuggestions.filter(reason => 
                            reason.toLowerCase().includes(query.toLowerCase())
                        );
                        
                        displaySuggestions(filtered.slice(0, 5));
                    }
                });
            }
            
            function displaySuggestions(suggestions) {
                suggestionBox.empty();
                
                if (!suggestions || suggestions.length === 0) {
                    suggestionBox.hide();
                    return;
                }
                
                suggestions.forEach(function(suggestion) {
                    const suggestionItem = $('<div class="suggestion-item"></div>')
                        .text(suggestion)
                        .on('click', function() {
                            reasonInput.val(suggestion);
                            suggestionBox.hide();
                            updateCharCounter();
                        })
                        .on('mouseenter', function() {
                            $(this).addClass('selected');
                        })
                        .on('mouseleave', function() {
                            $(this).removeClass('selected');
                        });
                    
                    suggestionBox.append(suggestionItem);
                });
                
                suggestionBox.show();
            }
            
            // Hide suggestions when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#reason, #reasonSuggestions').length) {
                    suggestionBox.hide();
                }
            });
            
            // Hide suggestions on escape key
            reasonInput.on('keydown', function(e) {
                if (e.key === 'Escape') {
                    suggestionBox.hide();
                }
                
                // Arrow key navigation for suggestions
                if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    navigateSuggestions(e.key);
                }
                
                // Enter key to select suggestion
                if (e.key === 'Enter' && suggestionBox.is(':visible')) {
                    e.preventDefault();
                    selectFirstSuggestion();
                }
            });
            
            function navigateSuggestions(key) {
                const items = suggestionBox.find('.suggestion-item');
                if (items.length === 0) return;
                
                const currentIndex = items.index(items.filter('.selected'));
                let newIndex;
                
                if (key === 'ArrowDown') {
                    newIndex = currentIndex < items.length - 1 ? currentIndex + 1 : 0;
                } else {
                    newIndex = currentIndex > 0 ? currentIndex - 1 : items.length - 1;
                }
                
                items.removeClass('selected');
                items.eq(newIndex).addClass('selected');
            }
            
            function selectFirstSuggestion() {
                const selectedItem = suggestionBox.find('.suggestion-item.selected').first();
                const firstItem = suggestionBox.find('.suggestion-item').first();
                
                if (selectedItem.length) {
                    reasonInput.val(selectedItem.text());
                } else if (firstItem.length) {
                    reasonInput.val(firstItem.text());
                }
                
                suggestionBox.hide();
                updateCharCounter();
            }
            
            // Form validation
            $('#updatePlayerForm').on('submit', function(e) {
                const reason = reasonInput.val().trim();
                const dayId = $('#dayID').val();
                const seasonId = $('#seasonID').val();
                
                // Basic validation
                if (!seasonId) {
                    e.preventDefault();
                    alert('Please select a season');
                    $('#seasonID').focus();
                    return false;
                }
                
                if (!dayId) {
                    e.preventDefault();
                    alert('Please select a day');
                    $('#dayID').focus();
                    return false;
                }
                
                if (reason.length > 30) {
                    e.preventDefault();
                    alert('Suspension reason cannot exceed 30 characters');
                    reasonInput.focus();
                    return false;
                }
                
                if (reason.length === 0) {
                    e.preventDefault();
                    alert('Please enter a suspension reason');
                    reasonInput.focus();
                    return false;
                }
                
                // Check if name is entered
                const playerName = $('input[name="name"]').val().trim();
                if (!playerName) {
                    e.preventDefault();
                    alert('Please enter player name');
                    $('input[name="name"]').focus();
                    return false;
                }
                
                // Check if team is selected
                const teamId = $('select[name="teamID"]').val();
                if (!teamId) {
                    e.preventDefault();
                    alert('Please select a team');
                    $('select[name="teamID"]').focus();
                    return false;
                }
                
                // Optional: Confirm update
                if (!confirm('Are you sure you want to update this suspended player?')) {
                    e.preventDefault();
                    return false;
                }
                
                return true;
            });
            
            console.log('Update page initialization complete');
        });
    </script>
@endpush
