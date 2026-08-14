<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — FERWAFA</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|sora:500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fw-admin.css') . '?v=' . filemtime(public_path('css/fw-admin.css')) }}">
    <link href="{{ asset('static/img/federation/ferwafa.png') }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
    @stack('styles')
</head>
<body class="fw-admin-body">
    <div class="fw-admin-overlay" id="fwAdminOverlay"></div>
    <div class="fw-admin-shell">
        @include('partials.admin-sidebar')
        <div class="fw-admin-main">
            <header class="fw-admin-topbar">
                <button type="button" class="fw-admin-menu-btn" id="fwAdminMenuBtn" aria-label="Open menu">
                    <i class="fas fa-bars"></i>
                </button>
                @php
                    $fwInitials = collect(explode(' ', trim(Auth::user()->name)))
                        ->filter()
                        ->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                        ->take(2)
                        ->implode('');
                @endphp
                <div class="fw-admin-user-dropdown" id="fwAdminUserDropdown">
                    <button type="button"
                            class="fw-admin-user-trigger"
                            id="fwAdminUserTrigger"
                            aria-haspopup="true"
                            aria-expanded="false"
                            aria-controls="fwAdminUserMenu"
                            aria-label="Account menu">
                        <span class="fw-admin-avatar">{{ $fwInitials }}</span>
                    </button>
                    <div class="fw-admin-user-menu" role="menu" id="fwAdminUserMenu" hidden>
                        <div class="fw-admin-user-menu-label">
                            Signed in as <strong>{{ Auth::user()->name }}</strong>
                        </div>
                        <div class="fw-admin-user-menu-divider" role="separator"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="fw-admin-user-logout" role="menuitem">Logout</button>
                        </form>
                    </div>
                </div>
            </header>
            <main class="fw-admin-content">
                @if (session('message'))
                    <div class="fw-admin-flash fw-admin-flash-success">{{ session('message') }}</div>
                @endif
                @if (session('errors') && !is_object(session('errors')))
                    <div class="fw-admin-flash fw-admin-flash-error">{{ session('errors') }}</div>
                @endif
                @if ($errors->any())
                    <div class="fw-admin-flash fw-admin-flash-error">
                        <ul class="mb-0 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        (function () {
            function initFwAdmin() {
                var btn = document.getElementById('fwAdminMenuBtn');
                var overlay = document.getElementById('fwAdminOverlay');
                function toggleSidebar() {
                    document.body.classList.toggle('fw-admin-sidebar-open');
                }
                if (btn) btn.addEventListener('click', toggleSidebar);
                if (overlay) overlay.addEventListener('click', toggleSidebar);

                document.querySelectorAll('[data-fw-toggle]').forEach(function (el) {
                    if (el.getAttribute('data-fw-toggle-initialized') === '1') return;
                    el.setAttribute('data-fw-toggle-initialized', '1');

                    var target = document.getElementById(el.getAttribute('data-fw-toggle'));
                    if (target && target.classList.contains('is-open')) {
                        el.classList.add('is-open');
                    }

                    el.addEventListener('click', function (e) {
                        e.preventDefault();
                        var panel = document.getElementById(el.getAttribute('data-fw-toggle'));
                        if (!panel) return;
                        panel.classList.toggle('is-open');
                        el.classList.toggle('is-open', panel.classList.contains('is-open'));
                    });
                });

                var userDropdown = document.getElementById('fwAdminUserDropdown');
                var userTrigger = document.getElementById('fwAdminUserTrigger');
                var userMenu = document.getElementById('fwAdminUserMenu');
                function setUserMenuOpen(open) {
                    if (!userDropdown || !userTrigger || !userMenu) return;
                    userDropdown.classList.toggle('is-open', open);
                    userTrigger.setAttribute('aria-expanded', open ? 'true' : 'false');
                    if (open) {
                        userMenu.removeAttribute('hidden');
                    } else {
                        userMenu.setAttribute('hidden', '');
                    }
                }
                function closeUserMenu() {
                    setUserMenuOpen(false);
                }
                if (userTrigger && userDropdown) {
                    userTrigger.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        setUserMenuOpen(!userDropdown.classList.contains('is-open'));
                    });
                    document.addEventListener('click', function (e) {
                        if (!userDropdown.contains(e.target)) closeUserMenu();
                    });
                    document.addEventListener('keydown', function (e) {
                        if (e.key === 'Escape' && userDropdown.classList.contains('is-open')) {
                            closeUserMenu();
                            userTrigger.focus();
                        }
                    });
                }

                document.querySelectorAll('form.fw-admin-submit-guard').forEach(function (form) {
                    form.addEventListener('submit', function () {
                        var submitBtn = form.querySelector('[type="submit"], button.btn-primary, #publishBtn');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            if (!submitBtn.dataset.originalText) {
                                submitBtn.dataset.originalText = submitBtn.textContent;
                            }
                            submitBtn.textContent = submitBtn.dataset.loadingText || 'Saving…';
                        }
                    });
                });

                if (window.jQuery) {
                    if (jQuery.fn.summernote) {
                        jQuery('.summernote').summernote({ height: 240 });
                        jQuery('.summernote-simple').summernote({ height: 180, toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['para', ['ul', 'ol', 'paragraph']]
                        ]});
                    }
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initFwAdmin);
            } else {
                initFwAdmin();
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>