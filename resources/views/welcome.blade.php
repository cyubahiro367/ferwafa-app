<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FERWAFA – Rwanda Football Federation</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet" />
    <style>
        :root {
            --blue: #133E8D;
            --blue-deep: #0B2760;
            --gold: #F5A800;
            --gold-dark: #C98500;
            --white: #FFFFFF;
            --mist: #E8EEF8;
            --text: #1a1a2e;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Barlow', sans-serif;
            color: var(--text);
            background: var(--blue-deep);
            overflow-x: hidden;
        }

        /* ── Hero ── */
        .hero {
            position: relative;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
            color: var(--white);
        }

        .hero-media {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 30%;
            transform: scale(1.08);
            animation: heroZoom 18s ease-out forwards;
        }

        .hero-media::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(11, 39, 96, 0.35) 0%, rgba(11, 39, 96, 0.55) 45%, rgba(11, 39, 96, 0.92) 100%),
                linear-gradient(90deg, rgba(19, 62, 141, 0.55) 0%, transparent 55%);
        }

        .hero-pattern {
            position: absolute;
            inset: 0;
            z-index: 1;
            opacity: 0.12;
            background-image:
                radial-gradient(circle at 20% 80%, var(--gold) 0.6px, transparent 0.7px),
                radial-gradient(circle at 80% 20%, var(--white) 0.5px, transparent 0.6px);
            background-size: 28px 28px, 36px 36px;
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            width: min(1120px, calc(100% - 48px));
            margin: 0 auto;
            padding: 0 0 clamp(56px, 10vh, 96px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: clamp(28px, 5vh, 48px);
            opacity: 0;
            animation: riseIn 0.9s ease 0.15s forwards;
        }

        .brand-mark {
            width: clamp(64px, 9vw, 88px);
            height: clamp(64px, 9vw, 88px);
            border-radius: 50%;
            border: 2px solid var(--gold);
            background: var(--blue);
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 0 0 6px rgba(245, 168, 0, 0.18);
        }

        .brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand-name {
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            font-size: clamp(42px, 9vw, 92px);
            letter-spacing: 0.06em;
            line-height: 0.95;
            text-transform: uppercase;
        }

        .brand-name span {
            display: block;
            font-size: 0.28em;
            letter-spacing: 0.22em;
            font-weight: 500;
            color: var(--gold);
            margin-top: 10px;
        }

        .headline {
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            font-size: clamp(22px, 3.4vw, 36px);
            line-height: 1.15;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            max-width: 16ch;
            margin-bottom: 16px;
            opacity: 0;
            animation: riseIn 0.9s ease 0.35s forwards;
        }

        .lede {
            font-size: clamp(16px, 1.8vw, 19px);
            font-weight: 400;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.82);
            max-width: 36ch;
            margin-bottom: 32px;
            opacity: 0;
            animation: riseIn 0.9s ease 0.5s forwards;
        }

        .cta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            opacity: 0;
            animation: riseIn 0.9s ease 0.65s forwards;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            font-family: 'Oswald', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 2px;
            transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: var(--gold);
            color: var(--blue-deep);
            border: 2px solid var(--gold);
        }

        .btn-primary:hover { background: var(--gold-dark); border-color: var(--gold-dark); }

        .btn-ghost {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255, 255, 255, 0.45);
        }

        .btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .scroll-cue {
            position: absolute;
            z-index: 2;
            left: 50%;
            bottom: 22px;
            transform: translateX(-50%);
            width: 22px;
            height: 36px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-radius: 12px;
            opacity: 0;
            animation: fadeIn 0.8s ease 1.1s forwards;
        }

        .scroll-cue::after {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            width: 4px;
            height: 8px;
            margin-left: -2px;
            background: var(--gold);
            border-radius: 2px;
            animation: scrollDot 1.6s ease-in-out infinite;
        }

        /* ── About strip ── */
        .about {
            background:
                linear-gradient(135deg, var(--mist) 0%, var(--white) 55%, #F7F1E3 100%);
            padding: clamp(72px, 12vh, 120px) 0;
        }

        .about-inner {
            width: min(880px, calc(100% - 48px));
            margin: 0 auto;
            text-align: center;
        }

        .about-label {
            font-family: 'Oswald', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--gold-dark);
            margin-bottom: 18px;
        }

        .about-title {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(28px, 4vw, 44px);
            font-weight: 700;
            text-transform: uppercase;
            color: var(--blue);
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .about-copy {
            font-size: clamp(16px, 1.6vw, 18px);
            line-height: 1.7;
            color: rgba(26, 26, 46, 0.78);
            max-width: 52ch;
            margin: 0 auto;
        }

        /* ── Footer ── */
        .site-footer {
            background: var(--blue-deep);
            color: rgba(255, 255, 255, 0.65);
            padding: 28px 24px;
            text-align: center;
            font-size: 13px;
            letter-spacing: 0.04em;
        }

        .site-footer strong {
            color: var(--gold);
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            letter-spacing: 0.12em;
        }

        @keyframes heroZoom {
            from { transform: scale(1.08); }
            to { transform: scale(1); }
        }

        @keyframes riseIn {
            from { opacity: 0; transform: translateY(28px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scrollDot {
            0%, 100% { opacity: 1; transform: translateY(0); }
            50% { opacity: 0.35; transform: translateY(10px); }
        }

        @media (max-width: 640px) {
            .hero-inner { width: calc(100% - 36px); }
            .brand { gap: 14px; }
            .brand-name span { letter-spacing: 0.14em; }
            .headline { max-width: none; }
            .lede { max-width: none; }
            .btn { width: 100%; }
            .scroll-cue { display: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            .hero-media img,
            .brand,
            .headline,
            .lede,
            .cta-row,
            .scroll-cue,
            .scroll-cue::after {
                animation: none !important;
            }
            .hero-media img { transform: none; }
            .brand, .headline, .lede, .cta-row { opacity: 1; }
        }
    </style>
</head>
<body>
    <section class="hero" aria-label="Welcome">
        <div class="hero-media" aria-hidden="true">
            <img src="{{ asset('images/amavubi.jpeg') }}" alt="" />
        </div>
        <div class="hero-pattern" aria-hidden="true"></div>

        <div class="hero-inner">
            <div class="brand">
                <div class="brand-mark">
                    <img src="{{ asset('images/file.png') }}" alt="FERWAFA crest" />
                </div>
                <h1 class="brand-name">
                    FERWAFA
                    <span>Rwanda Football Federation</span>
                </h1>
            </div>

            <p class="headline">Welcome to the home of Rwandan football</p>
            <p class="lede">
                Governing, growing, and celebrating the beautiful game across Rwanda.
            </p>

            <div class="cta-row">
                <a class="btn btn-primary" href="#about">Discover FERWAFA</a>
                <a class="btn btn-ghost" href="mailto:ferwafa.info@ferwafa.rw">Contact us</a>
            </div>
        </div>

        <div class="scroll-cue" aria-hidden="true"></div>
    </section>

    <section class="about" id="about">
        <div class="about-inner">
            <p class="about-label">Our mission</p>
            <h2 class="about-title">Football for every Rwandan</h2>
            <p class="about-copy">
                FERWAFA leads national teams, competitions, and grassroots programmes —
                building the game from community pitches to the Amavubi stage.
            </p>
        </div>
    </section>

    <footer class="site-footer">
        <strong>FERWAFA</strong> &nbsp;·&nbsp; © <span id="year"></span> Rwanda Football Federation
    </footer>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>
