<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Update Suspended Player - Ferwafa</title>
    
    <!-- Favicon -->
    <link href="{{ asset('static/img/federation/ferwafa.png') }}" rel="shortcut icon" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    
    <!-- Additional CSS for better form styling -->
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .character-counter {
            font-size: 12px;
            color: #6c757d;
            text-align: right;
            margin-top: 5px;
        }
        .character-counter.warning {
            color: #ffc107;
        }
        .character-counter.danger {
            color: #dc3545;
        }
        .suggestion-box {
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            width: calc(100% - 30px);
            z-index: 1000;
            display: none;
        }
        .suggestion-item {
            padding: 8px 12px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }
        .suggestion-item:hover {
            background-color: #f8f9fa;
        }
        .suggestion-item.selected {
            background-color: #e9ecef;
        }
        .suggestion-item:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')
    
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Suspended Player</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-container">
                                <!-- Display error/success messages -->
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                
                                <!-- Display validation errors -->
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                
                                <form method="POST"
                                    action="{{ route('update.player-suspended', [request()->route('divisionID'), request()->route('categoryID'), $playerSuspended->id]) }}"
                                    enctype="multipart/form-data"
                                    id="updatePlayerForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Season Selection -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Season <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="seasonID" id="seasonID" class="form-control" required>
                                                @foreach ($seasons as $season)
                                                    <option value="{{ $season['id'] }}" 
                                                        {{ $playerSuspended->seasonID == $season['id'] ? 'selected' : '' }}>
                                                        {{ $season['from'] }} - {{ $season['to'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('seasonID')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Day Selection (depends on season) -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Day <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="dayID" id="dayID" class="form-control" required>
                                                <option value="">Loading days...</option>
                                            </select>
                                            @error('dayID')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Player Name -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Player Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="name" class="form-control" 
                                                value="{{ old('name', $playerSuspended->name) }}" 
                                                placeholder="Enter player's full name"
                                                required>
                                            @error('name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Team Selection -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Team <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="teamID" class="form-control" required>
                                                <option value="">Select Team</option>
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team['id'] }}"
                                                        {{ old('teamID', $playerSuspended->teamID) == $team['id'] ? 'selected' : '' }}>
                                                        {{ $team['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teamID')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Suspension Reason with Autocomplete -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Suspension Reason <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="position-relative">
                                                <input type="text" name="reason" id="reason" 
                                                    class="form-control" 
                                                    value="{{ old('reason', $playerSuspended->reason) }}"
                                                    placeholder="Enter suspension reason (max 30 characters)"
                                                    maxlength="30"
                                                    required>
                                                <div id="reasonSuggestions" class="suggestion-box"></div>
                                            </div>
                                            <div id="charCount" class="character-counter">0/30 characters</div>
                                            @error('reason')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Start typing to see matching existing reasons
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Form Actions -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Update Player
                                            </button>
                                            <a href="{{ route('player-suspended', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                                class="btn btn-outline-secondary ml-2">
                                                <i class="fas fa-times"></i> Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Template Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Custom Scripts -->
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
</body>
</html>