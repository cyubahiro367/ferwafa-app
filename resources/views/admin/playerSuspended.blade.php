<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferwafa - Suspended Players</title>

    <!-- Favicon -->
    <link href="{{ asset('static/img/federation/ferwafa.png') }}" rel="shortcut icon" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables CSS (optional) -->
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    @include('admin.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Suspended Players</h4>
                            <div class="card-header-form">
                                <div class="row">
                                    <div class="col-12 d-flex align-items-center">
                                        <!-- Add Player Button -->
                                        <a href="{{ route('add.player-suspended', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                            class="btn btn-primary">
                                            <i class="far fa-user"></i> Add Player
                                        </a>

                                        <!-- Filter Form -->
                                        <form
                                            action="{{ route('player-suspended', [request()->route('divisionID'), request()->route('categoryID')]) }}"
                                            method="GET" class="ml-3 d-flex align-items-center">

                                            <!-- Season Select -->
                                            <select class="btn btn-primary mr-2" name="seasonID" id="seasonID">
                                                @foreach ($seasons as $season)
                                                    <option value="{{ $season['id'] }}"
                                                        {{ $seasonID === $season['id'] ? 'selected' : '' }}>
                                                        {{ $season['from'] }} - {{ $season['to'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <!-- Day Select with Select2 -->
                                            <select class="btn btn-primary mr-2" name="dayID" id="dayID">
                                                <option value="">Select date</option>
                                            </select>

                                            <!-- Search Button -->
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Message -->
                        @if (session()->has('error'))
                            <div class="alert alert-danger m-3">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <!-- Success Message -->
                        @if (session()->has('success'))
                            <div class="alert alert-success m-3">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <!-- Table Content -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped" id="suspendedPlayersTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Team Name</th>
                                            <th>Suspension Reason</th>
                                            <th>Day</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($playerSuspendeds ?? [] as $key => $playerSuspended)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $playerSuspended['name'] ?? 'N/A' }}</td>
                                                <td>{{ $playerSuspended['teamName'] ?? 'N/A' }}</td>
                                                <td>{{ $playerSuspended['reason'] ?? 'N/A' }}</td>
                                                <td>{{ $playerSuspended['period'] ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('player-suspended.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $playerSuspended['id']]) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="far fa-edit"></i> Edit
                                                    </a>

                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger delete-player"
                                                        data-toggle="modal" data-target="#confirmDeleteModal"
                                                        data-player-id="{{ $playerSuspended['id'] }}"
                                                        data-player-name="{{ $playerSuspended['name'] ?? 'this player' }}">
                                                        <i class="far fa-trash-alt"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <p class="text-muted">No suspended players found.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="playerNameDisplay"></strong> from suspended players?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deletePlayerForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts - Load jQuery FIRST, but handle the conflict -->
    <!-- jQuery 3.3.1 (compatible with your app.min.js) -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Save reference to jQuery before other scripts load -->
    <script>
        var jq331 = jQuery.noConflict(true);
        console.log('jQuery 3.3.1 loaded and saved as jq331');
    </script>

    <!-- Now load app.min.js which might also load jQuery -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <!-- After app.min.js, restore our jQuery if needed -->
    <script>
        // Check if jQuery was overwritten
        if (window.jQuery && window.jQuery.fn.jquery !== '3.3.1') {
            console.log('jQuery was overwritten by app.min.js, restoring...');
            window.jQuery = window.$ = jq331;
        } else if (!window.jQuery) {
            console.log('jQuery not present, restoring from saved reference');
            window.jQuery = window.$ = jq331;
        }
        console.log('Final jQuery version:', jQuery.fn.jquery);
    </script>

    <!-- Now load other dependencies that need jQuery -->
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS - Use a version compatible with jQuery 3.3.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

    <!-- Template Scripts -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Custom Scripts -->
    <script>
        // Wait for everything to load
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit to ensure all scripts are loaded
            setTimeout(initializePage, 500);
        });

        function initializePage() {
            console.log('Initializing page...');
            console.log('jQuery version available:', typeof jQuery !== 'undefined' ? jQuery.fn.jquery : 'undefined');
            console.log('Select2 available:', typeof jQuery.fn.select2 !== 'undefined');

            // Use jQuery safely
            if (typeof jQuery === 'undefined') {
                console.error('jQuery not available!');
                return;
            }

            var $ = jQuery;

            // Initialize Select2
            if (typeof $.fn.select2 === 'function') {
                console.log('Initializing Select2...');

                // Initialize day select
                $('#dayID').select2({
                    placeholder: "Select date",
                    allowClear: true,
                    width: 'auto',
                    dropdownParent: $('body')
                });

                console.log('Basic Select2 initialized');

                // Now set up AJAX if needed
                try {
                    $('#dayID').select2({
                        ajax: {
                            url: function() {
                                var seasonId = $('#seasonID').val();
                                if (!seasonId) {
                                    console.log('No season selected');
                                    return null;
                                }
                                return '/api/days/' + seasonId;
                            },
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    search: params.term || "",
                                    page: params.page || 1,
                                    perPage: 10
                                };
                            },
                            processResults: function(data, params) {
                                console.log('Processing days data:', data);
                                params.page = params.page || 1;

                                var results = [];
                                if (data.results) {
                                    results = data.results;
                                } else if (Array.isArray(data)) {
                                    results = data;
                                }

                                var formattedResults = results.map(function(day) {
                                    return {
                                        id: day.id,
                                        text: day.name || 'Day ' + day.id
                                    };
                                });

                                console.log('Formatted results:', formattedResults);
                                return {
                                    results: formattedResults,
                                    pagination: {
                                        more: data.current_page < data.last_page
                                    }
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 0,
                        placeholder: "Select date",
                        allowClear: true,
                        width: 'auto',
                        dropdownParent: $('body')
                    });

                    console.log('Select2 with AJAX initialized');

                    // Set selected day if exists
                    @if (isset($dayID) && $dayID)
                        var selectedDayId = @json($dayID);
                        if (selectedDayId && selectedDayId !== '') {
                            // Check if option exists
                            if ($('#dayID').find('option[value="' + selectedDayId + '"]').length === 0) {
                                // Create a new option
                                var selectedDayText = '{{ $selectedDayName ?? 'Selected Day' }}';
                                var newOption = new Option(selectedDayText, selectedDayId, true, true);
                                $('#dayID').append(newOption).trigger('change');
                            } else {
                                $('#dayID').val(selectedDayId).trigger('change');
                            }
                        }
                    @endif

                } catch (error) {
                    console.error('Error initializing Select2 with AJAX:', error);
                    // Fallback to simple Select2
                    $('#dayID').select2({
                        placeholder: "Select date",
                        allowClear: true,
                        width: 'auto'
                    });
                }

                // Reload days when season changes
                $('#seasonID').on('change', function() {
                    console.log('Season changed to:', $(this).val());
                    $('#dayID').val(null).trigger('change');
                });

            } else {
                console.error('Select2 not available!');
                // Fallback: Make it a regular select but styled like btn-primary
                $('#dayID').css({
                    'background-color': '#295886',
                    'color': 'white',
                    'border': '1px solid #295886',
                    'border-radius': '4px',
                    'padding': '6px 12px',
                    'height': '38px'
                });
            }

            // Handle delete button click
            $(document).on('click', '.delete-player', function(e) {
                e.preventDefault();

                var playerId = $(this).data('player-id');
                var playerName = $(this).data('player-name');
                var divisionId = '{{ request()->route('divisionID') }}';
                var categoryId = '{{ request()->route('categoryID') }}';

                $('#playerNameDisplay').text(playerName);

                var deleteUrl =
                    '{{ route('delete.player-suspended', [':divisionId', ':categoryId', ':playerId']) }}';
                deleteUrl = deleteUrl.replace(':divisionId', divisionId)
                    .replace(':categoryId', categoryId)
                    .replace(':playerId', playerId);

                $('#deletePlayerForm').attr('action', deleteUrl);
            });

            // Initialize DataTable if available
            // if (typeof $.fn.DataTable === 'function') {
            //     @if (isset($playerSuspendeds) && count($playerSuspendeds) > 0)
            //         $('#suspendedPlayersTable').DataTable({
            //             "pageLength": 10,
            //             "ordering": true,
            //             "searching": true,
            //             "language": {
            //                 "search": "Search:",
            //                 "lengthMenu": "Show _MENU_ entries",
            //                 "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            //                 "paginate": {
            //                     "first": "First",
            //                     "last": "Last",
            //                     "next": "Next",
            //                     "previous": "Previous"
            //                 }
            //             }
            //         });
            //         console.log('DataTable initialized');
            //     @endif
            // }

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            console.log('Page initialization complete');
        }
    </script>
</body>

</html>
