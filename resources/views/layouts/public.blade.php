<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'FERWAFA – Rwanda Football Federation')</title>
    <meta content="Ferwafa" name="description" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"  href="{{ asset('images/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed"                href="{{ asset('images/apple-icon-57x57.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Barlow:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fw-public.css') }}" />
    @stack('styles')
</head>
<body>
    @include('partials.fw-topbar')
    @include('partials.fw-navbar', ['active' => trim($__env->yieldContent('active'))])

    @yield('content')

    @include('partials.fw-footer')

    <script>
        document.getElementById('fwHamburger')?.addEventListener('click', function () {
            document.getElementById('fwMobileNav').classList.add('open');
        });
        document.getElementById('fwMobileClose')?.addEventListener('click', function () {
            document.getElementById('fwMobileNav').classList.remove('open');
        });
        document.querySelectorAll('.fw-mob-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var target = document.getElementById(btn.dataset.target);
                var wasOpen = target.classList.contains('open');
                btn.closest('li').parentElement.querySelectorAll('.fw-mob-sub').forEach(function (s) { s.classList.remove('open'); });
                btn.closest('li').parentElement.querySelectorAll('.fw-mob-toggle').forEach(function (b) { b.classList.remove('open'); });
                if (!wasOpen) { target.classList.add('open'); btn.classList.add('open'); }
            });
        });
        document.querySelectorAll('.fw-mob-sub-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var target = document.getElementById(btn.dataset.target);
                var wasOpen = target.classList.contains('open');
                btn.closest('.fw-mob-sub').querySelectorAll('.fw-mob-subsub').forEach(function (s) { s.classList.remove('open'); });
                btn.closest('.fw-mob-sub').querySelectorAll('.fw-mob-sub-toggle').forEach(function (b) { b.classList.remove('open'); });
                if (!wasOpen) { target.classList.add('open'); btn.classList.add('open'); }
            });
        });
        var yearEl = document.getElementById('fwFooterYear');
        if (yearEl) yearEl.textContent = new Date().getFullYear();
    </script>
    @stack('scripts')
</body>
</html>
