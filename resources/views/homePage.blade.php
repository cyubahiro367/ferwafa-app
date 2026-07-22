<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FERWAFA – Rwanda Football Federation</title>
    <meta content="Ferwafa" name="description" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />

    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"  href="{{ asset('images/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed"                href="{{ asset('images/apple-icon-57x57.png') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lib.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/Stroke-Gap-Icon/stroke-gap-icon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navigation-menu.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lightslider-master/lightslider.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shortcode.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Barlow:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
    :root {
      --blue:      #133E8D;
      --blue-mid:  #1a51b8;
      --gold:      #F5A800;
      --gold-dark: #C98500;
      --white:     #FFFFFF;
      --off-white: #F4F6FB;
      --grey:      #8C95A6;
      --text:      #1a1a2e;
      --card-bg:   #FFFFFF;
      --border:    rgba(19,62,141,0.10);
      --shadow-sm: 0 2px 12px rgba(19,62,141,0.08);
      --shadow-md: 0 8px 32px rgba(19,62,141,0.14);
      --radius:    4px;
      --nav-h:     72px;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; overflow-x: hidden; }
    body { font-family: 'Barlow', sans-serif; background: var(--white); color: var(--text); overflow-x: hidden; max-width: 100vw; }

    .fw-wrap { max-width: 1280px; margin: 0 auto; padding: 0 28px; }
    .fw-section-label {
      display: inline-flex; align-items: center; gap: 10px;
      font-family: 'Oswald', sans-serif; font-size: 11px; font-weight: 600;
      letter-spacing: 3px; text-transform: uppercase; color: var(--gold); margin-bottom: 14px;
    }
    .fw-section-label::before { content: ''; display: block; width: 30px; height: 2px; background: var(--gold); }
    .fw-section-title {
      font-family: 'Oswald', sans-serif; font-size: clamp(26px,3.5vw,40px);
      font-weight: 700; line-height: 1.1; color: var(--blue); text-transform: uppercase;
    }

    /* TOP BAR */
    .fw-topbar { background: var(--blue); height: 36px; display: flex; align-items: center; justify-content: center; }
    .fw-topbar-inner { display: flex; justify-content: center; align-items: center; gap: 32px; width: 100%; padding: 0 32px; flex-wrap: wrap; }
    .fw-topbar-left { display: flex; gap: 20px; }
    .fw-topbar-left a { color: rgba(255,255,255,0.75); font-size: 12px; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color .2s; }
    .fw-topbar-left a:hover { color: var(--gold); }
    .fw-topbar-right { display: flex; gap: 14px; }
    .fw-topbar-right a { color: rgba(255,255,255,0.75); font-size: 13px; text-decoration: none; transition: color .2s; }
    .fw-topbar-right a:hover { color: var(--gold); }

    /* NAVBAR */
    .fw-navbar {
      background: var(--white); height: var(--nav-h);
      border-bottom: 3px solid var(--gold);
      position: sticky; top: 0; z-index: 1000;
      box-shadow: var(--shadow-sm);
    }
    .fw-navbar .fw-wrap { max-width: 100%; padding: 0 32px; }
    .fw-navbar-inner {
      height: 100%; display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center; gap: 16px;
    }
    .fw-nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; flex-shrink: 0; padding: 8px 16px 8px 0; }
    .fw-nav-logo-img {
      width: 52px; height: 52px; background: var(--blue); border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Oswald', sans-serif; font-size: 9px; font-weight: 700;
      color: var(--white); letter-spacing: 1px; border: 2px solid var(--gold); overflow: hidden;
    }
    .fw-nav-logo-img img { width: 100%; height: 100%; object-fit: cover; }
    .fw-nav-logo-title { font-family: 'Oswald', sans-serif; font-size: 20px; font-weight: 700; color: var(--blue); line-height: 1; letter-spacing: 2px; }
    .fw-nav-logo-sub { font-size: 10px; color: var(--grey); letter-spacing: .5px; white-space: nowrap; margin-top: 3px; }

    .fw-nav-links { display: flex; align-items: center; list-style: none; justify-content: center; }
    .fw-nav-links > li { position: relative; }
    .fw-nav-links > li > a {
      display: flex; align-items: center; gap: 4px;
      padding: 6px 10px; height: var(--nav-h);
      font-family: 'Oswald', sans-serif; font-size: 12px; font-weight: 500;
      letter-spacing: .5px; text-transform: uppercase;
      color: var(--text); text-decoration: none; white-space: nowrap;
      border-bottom: 3px solid transparent; margin-bottom: -3px;
      transition: color .2s, border-color .2s;
    }
    .fw-nav-links > li > a:hover,
    .fw-nav-links > li > a.active { color: var(--blue); border-bottom-color: var(--gold); }
    .fw-nav-links > li > a i { font-size: 10px; }

    .fw-dropdown { position: relative; }
    .fw-dropdown-menu {
      display: none; position: absolute; top: 100%; left: 0;
      background: var(--white); min-width: 220px;
      border-top: 3px solid var(--gold); box-shadow: var(--shadow-md);
      list-style: none; z-index: 999;
    }
    .fw-dropdown:hover .fw-dropdown-menu { display: block; animation: fwFade .15s ease; }
    @keyframes fwFade { from { opacity:0; transform:translateY(-5px); } to { opacity:1; transform:translateY(0); } }
    .fw-dropdown-menu li a {
      display: block; padding: 11px 18px; font-size: 13px; color: var(--text);
      text-decoration: none; border-left: 3px solid transparent; transition: background .15s, color .15s;
    }
    .fw-dropdown-menu li a:hover { background: var(--off-white); color: var(--blue); border-left-color: var(--gold); }
    .fw-sub-drop { position: relative; }
    .fw-sub-drop > a::after { content: ' ›'; float: right; }
    .fw-sub-drop-menu {
      display: none; position: absolute; left: 100%; top: 0;
      background: var(--white); min-width: 200px;
      border-top: 3px solid var(--gold); box-shadow: var(--shadow-md);
      list-style: none; z-index: 999;
    }
    .fw-sub-drop:hover .fw-sub-drop-menu { display: block; }
    .fw-sub-drop-menu li a { display: block; padding: 11px 18px; font-size: 13px; color: var(--text); text-decoration: none; border-left: 3px solid transparent; transition: background .15s, color .15s; }
    .fw-sub-drop-menu li a:hover { background: var(--off-white); color: var(--blue); border-left-color: var(--gold); }

    .fw-nav-cta {
      background: var(--gold) !important; color: var(--text) !important;
      padding: 7px 14px !important; height: auto !important; margin: 0 4px;
      border-radius: var(--radius); font-weight: 700 !important; white-space: nowrap;
      border-bottom: none !important; transition: background .2s !important;
    }
    .fw-nav-cta:hover { background: var(--gold-dark) !important; }
    .fw-hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 8px; background: none; border: none; }
    .fw-hamburger span { width: 24px; height: 2px; background: var(--text); display: block; }

    /* HERO SLIDER */
    .fw-hero {
      position: relative;
      height: calc(100vh - 36px - 72px);
      min-height: 500px;
      background: var(--blue); overflow: hidden;
    }
    .fw-hero-slides { width: 100%; height: 100%; position: relative; }
    .fw-hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity .7s ease; }
    .fw-hero-slide.active { opacity: 1; z-index: 2; }
    .fw-hero-bg {
      position: absolute; inset: 0;
      background-size: cover; background-position: center top;
      transform: scale(1.04); transition: transform 6s ease;
    }
    .fw-hero-slide.active .fw-hero-bg { transform: scale(1); }
    .fw-hero-bg::after {
      content: ''; position: absolute; inset: 0;
      background:
        linear-gradient(to right,  rgba(10,22,40,0.75) 0%, rgba(10,22,40,0.30) 55%, transparent 100%),
        linear-gradient(to top,    rgba(10,22,40,0.80) 0%, transparent 50%);
    }
    .fw-hero-content {
      position: absolute; bottom: 0; left: 0; right: 0;
      z-index: 5; padding: 0 0 80px;
    }
    .fw-hero-inner { max-width: 620px; }
    .fw-hero-tag {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--gold); color: var(--text);
      font-family: 'Oswald', sans-serif; font-size: 11px; font-weight: 700;
      letter-spacing: 2px; text-transform: uppercase;
      padding: 5px 12px; margin-bottom: 18px;
    }
    .fw-hero-title {
      font-family: 'Oswald', sans-serif; font-size: clamp(28px, 4vw, 52px);
      font-weight: 700; color: var(--white); line-height: 1.07;
      text-transform: uppercase; margin-bottom: 14px;
    }
    .fw-hero-sub {
      font-size: 15px; color: rgba(255,255,255,0.82);
      line-height: 1.6; margin-bottom: 28px; max-width: 480px;
    }
    .fw-hero-bottom-bar {
      display: flex; align-items: center; gap: 16px;
    }
    .fw-hero-actions { display: flex; gap: 12px; flex-wrap: nowrap; align-items: center; }

    /* Desktop: controls absolutely positioned bottom-right */
    .fw-hero-controls {
      position: absolute; bottom: 32px; right: 40px;
      z-index: 10; display: flex; align-items: center; gap: 10px;
    }
    .fw-hero-controls-inline { display: none; }
    .fw-hero-prev, .fw-hero-next {
      width: 42px; height: 42px; border-radius: 50%;
      background: rgba(255,255,255,0.15); border: 2px solid rgba(255,255,255,0.3);
      color: var(--white); font-size: 15px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: background .2s, border-color .2s;
    }
    .fw-hero-prev:hover, .fw-hero-next:hover { background: var(--gold); border-color: var(--gold); color: var(--text); }
    .fw-hero-dots { display: flex; gap: 8px; }
    .fw-hero-dot {
      width: 8px; height: 8px; border-radius: 50%;
      background: rgba(255,255,255,0.4); cursor: pointer;
      transition: background .2s, transform .2s;
    }
    .fw-hero-dot.active { background: var(--gold); transform: scale(1.35); }
    .fw-btn-gold {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--gold); color: var(--text);
      font-family: 'Oswald', sans-serif; font-size: 13px; font-weight: 700;
      letter-spacing: 1px; text-transform: uppercase;
      padding: 13px 24px; text-decoration: none;
      border-radius: var(--radius); border: 2px solid var(--gold);
      transition: background .2s, border-color .2s;
    }
    .fw-btn-gold:hover { background: var(--gold-dark); border-color: var(--gold-dark); }
    .fw-btn-ghost {
      display: inline-flex; align-items: center; gap: 8px;
      background: transparent; color: var(--white);
      font-family: 'Oswald', sans-serif; font-size: 13px; font-weight: 600;
      letter-spacing: 1px; text-transform: uppercase;
      padding: 13px 24px; text-decoration: none;
      border-radius: var(--radius); border: 2px solid rgba(255,255,255,0.5);
      transition: border-color .2s, background .2s;
    }
    .fw-btn-ghost:hover { border-color: var(--white); background: rgba(255,255,255,0.1); }

    /* TICKER */
    .fw-ticker { background: var(--blue); height: 42px; display: flex; align-items: center; overflow: hidden; }
    .fw-ticker-label {
      background: var(--gold); color: var(--text);
      font-family: 'Oswald', sans-serif; font-size: 11px; font-weight: 700;
      letter-spacing: 2px; text-transform: uppercase;
      padding: 0 18px; height: 100%; display: flex; align-items: center; flex-shrink: 0; gap: 8px;
    }
    .fw-ticker-track { flex: 1; overflow: hidden; height: 100%; display: flex; align-items: center; }
    .fw-ticker-inner { display: flex; align-items: center; animation: fwTick 35s linear infinite; white-space: nowrap; }
    .fw-ticker-inner:hover { animation-play-state: paused; }
    @keyframes fwTick { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .fw-ticker-item { display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.88); font-size: 13px; padding: 0 40px 0 0; }
    .fw-ticker-item::before { content: '●'; color: var(--gold); font-size: 8px; }

    /* SECTIONS */
    .fw-section { padding: 76px 0; }
    .fw-section-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; }
    .fw-view-all {
      font-family: 'Oswald', sans-serif; font-size: 12px; font-weight: 600;
      letter-spacing: 1px; text-transform: uppercase; color: var(--blue);
      text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
      border-bottom: 2px solid var(--gold); padding-bottom: 2px; transition: color .2s;
    }
    .fw-view-all:hover { color: var(--gold); }

    /* NEWS GRID */
    .fw-news-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 26px; }
    .fw-news-featured { grid-column: 1; grid-row: 1 / 3; }
    .fw-news-card {
      display: flex; flex-direction: column; height: 100%;
      background: var(--card-bg); border-radius: var(--radius); overflow: hidden;
      text-decoration: none; color: var(--text);
      box-shadow: var(--shadow-sm); transition: box-shadow .25s, transform .25s;
    }
    .fw-news-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
    .fw-news-card-img { overflow: hidden; position: relative; height: 200px; }
    .fw-news-featured .fw-news-card-img { height: auto; min-height: 380px; flex: 1; }
    .fw-news-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
    .fw-news-card:hover .fw-news-card-img img { transform: scale(1.04); }
    .fw-news-card-cat {
      position: absolute; top: 14px; left: 14px;
      background: var(--blue); color: var(--white);
      font-family: 'Oswald', sans-serif; font-size: 10px; font-weight: 700;
      letter-spacing: 2px; text-transform: uppercase; padding: 4px 10px;
    }
    .fw-news-card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; }
    .fw-news-card-meta { font-size: 12px; color: var(--grey); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
    .fw-news-card-meta i { color: var(--gold); }
    .fw-news-card-title { font-family: 'Oswald', sans-serif; font-size: 17px; font-weight: 600; line-height: 1.3; text-transform: uppercase; color: var(--text); margin-bottom: 10px; }
    .fw-news-featured .fw-news-card-title { font-size: 22px; }
    .fw-news-card-excerpt { font-size: 14px; color: #555; line-height: 1.6; flex: 1; margin-bottom: 14px; }
    .fw-news-card-link { font-family: 'Oswald', sans-serif; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--blue); display: flex; align-items: center; gap: 6px; }
    .fw-news-right { display: flex; flex-direction: column; gap: 16px; }
    .fw-news-list-item {
      display: flex; background: var(--card-bg); border-radius: var(--radius); overflow: hidden;
      text-decoration: none; color: var(--text);
      box-shadow: var(--shadow-sm); transition: box-shadow .25s, transform .2s;
    }
    .fw-news-list-item:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .fw-news-list-img { width: 124px; min-width: 124px; overflow: hidden; }
    .fw-news-list-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
    .fw-news-list-item:hover .fw-news-list-img img { transform: scale(1.05); }
    .fw-news-list-body { padding: 14px 16px; display: flex; flex-direction: column; justify-content: center; }
    .fw-news-list-meta { font-size: 11px; color: var(--grey); margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
    .fw-news-list-meta i { color: var(--gold); }
    .fw-news-list-title { font-family: 'Oswald', sans-serif; font-size: 14px; font-weight: 600; line-height: 1.3; text-transform: uppercase; color: var(--text); }

    /* COMPETITIONS */
    .fw-comp-bar { background: var(--blue); padding: 60px 0; }
    .fw-comp-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px,1fr)); gap: 14px; margin-top: 32px; }
    .fw-comp-card {
      background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1);
      border-radius: var(--radius); padding: 24px 18px;
      text-decoration: none; color: var(--white);
      display: flex; flex-direction: column; gap: 12px;
      position: relative; overflow: hidden; transition: background .25s, transform .25s;
    }
    .fw-comp-card::before { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: var(--gold); transform: scaleX(0); transform-origin: left; transition: transform .3s; }
    .fw-comp-card:hover { background: rgba(255,255,255,0.13); transform: translateY(-4px); }
    .fw-comp-card:hover::before { transform: scaleX(1); }
    .fw-comp-icon { width: 44px; height: 44px; border-radius: 50%; background: rgba(245,168,0,0.15); border: 2px solid rgba(245,168,0,0.4); display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--gold); }
    .fw-comp-name { font-family: 'Oswald', sans-serif; font-size: 15px; font-weight: 600; text-transform: uppercase; line-height: 1.2; }
    .fw-comp-meta { font-size: 12px; color: rgba(255,255,255,0.5); }

    /* NATIONAL TEAMS */
    .fw-teams-section { background: var(--off-white); }
    .fw-teams-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; margin-top: 32px; }
    .fw-team-card { background: var(--white); border-radius: var(--radius); overflow: hidden; text-decoration: none; color: var(--text); box-shadow: var(--shadow-sm); transition: box-shadow .25s, transform .25s; }
    .fw-team-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }
    .fw-team-card-header { background: var(--blue); padding: 28px 20px; display: flex; align-items: center; justify-content: space-between; position: relative; overflow: hidden; }
    .fw-team-card-header::before { content: ''; position: absolute; right: -16px; top: -16px; width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.06); }
    .fw-team-badge { width: 54px; height: 54px; border-radius: 50%; background: var(--white); display: flex; align-items: center; justify-content: center; font-family: 'Oswald', sans-serif; font-size: 8px; font-weight: 700; color: var(--blue); text-align: center; border: 3px solid var(--gold); }
    .fw-team-flag { display: flex; flex-direction: column; gap: 4px; }
    .fw-team-flag span { width: 34px; height: 4px; border-radius: 2px; }
    .fw-team-card-body { padding: 18px; }
    .fw-team-name { font-family: 'Oswald', sans-serif; font-size: 17px; font-weight: 700; text-transform: uppercase; color: var(--text); margin-bottom: 6px; }
    .fw-team-desc { font-size: 13px; color: var(--grey); line-height: 1.5; margin-bottom: 14px; }
    .fw-team-link { font-family: 'Oswald', sans-serif; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--blue); display: flex; align-items: center; gap: 6px; }

    /* PARTNERS */
    .fw-partners { background: var(--white); padding: 56px 0; border-top: 1px solid var(--border); }
    .fw-partners-label { text-align: center; font-family: 'Oswald', sans-serif; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: var(--grey); margin-bottom: 32px; }
    .fw-partners-row { display: flex; align-items: center; justify-content: center; gap: 48px; flex-wrap: wrap; }
    .fw-partner-logo { display: flex; align-items: center; justify-content: center; width: 120px; height: 80px; filter: grayscale(1) opacity(.45); transition: filter .3s, transform .3s; }
    .fw-partner-logo:hover { filter: grayscale(0) opacity(1); transform: scale(1.08); }
    .fw-partner-logo img { max-width: 100%; max-height: 100%; object-fit: contain; }

    /* ══ MOBILE NAV ══════════════════════════════════════════════ */
    .fw-mobile-nav {
      display: none; position: fixed; inset: 0;
      background: var(--blue); z-index: 2000;
      overflow-y: auto; overflow-x: hidden;
      flex-direction: column; width: 100%;
    }
    .fw-mobile-nav.open { display: flex; }

    .fw-mobile-nav-header {
      display: flex; justify-content: space-between; align-items: center;
      padding: 14px 20px;
      background: rgba(0,0,0,0.25);
      border-bottom: 3px solid var(--gold);
      position: sticky; top: 0; z-index: 1;
      width: 100%;
    }
    .fw-mobile-nav-brand { display: flex; align-items: center; gap: 12px; }
    .fw-mobile-nav-brand img {
      width: 42px; height: 42px; border-radius: 50%;
      border: 2px solid var(--gold); object-fit: cover; flex-shrink: 0;
    }
    .fw-mobile-nav-brand span {
      font-family: 'Oswald', sans-serif; font-size: 20px; font-weight: 700;
      color: #fff; letter-spacing: 2px;
    }
    /* Close button — solid gold circle */
    .fw-mobile-close {
      width: 38px; height: 38px; border-radius: 50%;
      background: var(--gold); border: none;
      color: #1a1a2e; font-size: 16px; font-weight: 700;
      cursor: pointer; display: flex; align-items: center; justify-content: center;
      transition: background .2s, transform .2s; flex-shrink: 0;
    }
    .fw-mobile-close:hover { background: var(--gold-dark); transform: rotate(90deg); }

    /* Link list */
    .fw-mobile-links { list-style: none; padding: 0 0 48px; flex: 1; width: 100%; overflow-x: hidden; }
    .fw-mobile-links > li { border-bottom: 1px solid rgba(255,255,255,0.08); width: 100%; }

    /* Top-level row */
    .fw-mob-row { display: flex; align-items: stretch; width: 100%; }
    .fw-mob-row > a {
      flex: 1; padding: 16px 16px 16px 20px;
      font-family: 'Oswald', sans-serif; font-size: 14px; font-weight: 600;
      letter-spacing: 1px; text-transform: uppercase;
      color: #fff; text-decoration: none;
      display: flex; align-items: center; min-width: 0;
      transition: color .2s, background .2s;
    }
    .fw-mob-row > a:hover { color: var(--gold); background: rgba(0,0,0,0.1); }

    /* Toggle button */
    .fw-mob-toggle {
      width: 52px; min-width: 52px; max-width: 52px; padding: 0;
      background: rgba(255,255,255,0.08); border: none;
      border-left: 1px solid rgba(255,255,255,0.1);
      color: rgba(255,255,255,0.8); font-size: 13px;
      cursor: pointer; display: flex; align-items: center; justify-content: center;
      transition: background .2s, color .2s; flex-shrink: 0;
    }
    .fw-mob-toggle:hover { background: rgba(245,168,0,0.2); color: var(--gold); }
    .fw-mob-toggle.open { background: var(--gold); color: #1a1a2e; }
    .fw-mob-toggle.open i { transform: rotate(180deg); }
    .fw-mob-toggle i { transition: transform .3s; display: block; }

    /* Sub list */
    .fw-mob-sub { list-style: none; display: none; background: rgba(0,0,0,0.18); width: 100%; overflow-x: hidden; }
    .fw-mob-sub.open { display: block; animation: fwSlideDown .2s ease; }
    @keyframes fwSlideDown { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }
    .fw-mob-sub > li { border-top: 1px solid rgba(255,255,255,0.07); width: 100%; }
    .fw-mob-sub > li > a {
      display: block; padding: 13px 20px 13px 32px;
      font-size: 13px; font-family: 'Barlow', sans-serif; font-weight: 500;
      color: rgba(255,255,255,0.85); text-decoration: none;
      border-left: 3px solid transparent;
      transition: color .2s, border-color .2s;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .fw-mob-sub > li > a:hover { color: var(--gold); border-left-color: var(--gold); }

    .fw-mob-sub-row { display: flex; align-items: stretch; width: 100%; }
    .fw-mob-sub-row > a {
      flex: 1; padding: 13px 16px 13px 32px;
      font-size: 13px; font-family: 'Barlow', sans-serif; font-weight: 500;
      color: rgba(255,255,255,0.85); text-decoration: none;
      display: flex; align-items: center; min-width: 0;
      border-left: 3px solid transparent;
      transition: color .2s, border-color .2s;
    }
    .fw-mob-sub-row > a:hover { color: var(--gold); border-left-color: var(--gold); }
    .fw-mob-sub-toggle {
      min-width: 44px; padding: 0 14px;
      background: rgba(255,255,255,0.06); border: none;
      border-left: 1px solid rgba(255,255,255,0.08);
      color: rgba(255,255,255,0.6); font-size: 11px;
      cursor: pointer; display: flex; align-items: center; justify-content: center;
      transition: background .2s, color .2s;
    }
    .fw-mob-sub-toggle:hover { background: rgba(245,168,0,0.2); color: var(--gold); }
    .fw-mob-sub-toggle.open { background: rgba(245,168,0,0.25); color: var(--gold); }
    .fw-mob-sub-toggle.open i { transform: rotate(180deg); }
    .fw-mob-sub-toggle i { transition: transform .3s; display: block; }

    .fw-mob-subsub { list-style: none; display: none; background: rgba(0,0,0,0.15); }
    .fw-mob-subsub.open { display: block; }
    .fw-mob-subsub li a {
      display: block; padding: 11px 20px 11px 56px;
      font-size: 12px; color: rgba(255,255,255,0.65); text-decoration: none;
      border-top: 1px solid rgba(255,255,255,0.05);
      border-left: 3px solid transparent;
      transition: color .2s, border-color .2s;
    }
    .fw-mob-subsub li a::before { content: '–'; margin-right: 8px; color: var(--gold); font-size: 10px; }
    .fw-mob-subsub li a:hover { color: var(--gold); border-left-color: var(--gold); }

    /* ══ RESPONSIVE ══════════════════════════════════════════════ */
    @media (max-width: 1100px) {
      .fw-nav-links { display: none; }
      .fw-hamburger { display: flex; }
      /* keep logo spacing on tablet/mobile */
      .fw-nav-logo { padding: 8px 12px 8px 0; gap: 10px; }
      .fw-nav-logo-img { width: 46px; height: 46px; }
      .fw-nav-logo-title { font-size: 18px; }
      .fw-nav-logo-sub { font-size: 9px; }
    }

    /* Tablet */
    @media (max-width: 768px) {
      .fw-topbar { display: none; }
      .fw-hero { height: calc(100vh - 72px); min-height: 360px; }

      /* content sits 20px from hero bottom — buttons bottom-edge at 20px */
      .fw-hero-content { padding: 0 0 60px; }
      .fw-hero-content .fw-wrap { padding: 0 20px; }
      .fw-hero-inner { max-width: 100%; }
      .fw-hero-title { font-size: clamp(22px, 6vw, 36px); }
      .fw-hero-sub { font-size: 14px; max-width: 100%; margin-bottom: 14px; }

      /* buttons — left side */
      .fw-hero-actions { gap: 8px; margin-top: 4px; }
      .fw-btn-gold, .fw-btn-ghost { padding: 10px 16px; font-size: 12px; }

      /* controls — same bottom (20px) = same horizontal line as buttons */
      .fw-hero-controls { bottom: 20px; right: 16px; gap: 8px; }
      .fw-hero-prev, .fw-hero-next { width: 36px; height: 36px; font-size: 13px; }
      .fw-hero-dot { width: 7px; height: 7px; }

      /* ticker */
      .fw-ticker-label { padding: 0 12px; font-size: 10px; letter-spacing: 1px; }
      .fw-ticker-item { font-size: 12px; padding: 0 24px 0 0; }

      /* news */
      .fw-news-layout { grid-template-columns: 1fr; }
      .fw-news-featured { grid-column: auto; grid-row: auto; }
      .fw-news-featured .fw-news-card-img { min-height: 240px; height: 240px; }

      /* competitions */
      .fw-comp-grid { grid-template-columns: repeat(2,1fr); }
      .fw-comp-bar { padding: 44px 0; }
      .fw-comp-bar .fw-wrap { padding: 0 16px; }

      /* teams */
      .fw-teams-grid { grid-template-columns: 1fr; }

      /* general section padding */
      .fw-section { padding: 44px 0; }
      .fw-wrap { padding: 0 16px; }

      /* partners */
      .fw-partners { padding: 40px 0; }
      .fw-partners-row { gap: 28px; }
    }

    /* Mobile */
    @media (max-width: 480px) {
      .fw-hero { min-height: 320px; }

      /* content padding-bottom = controls bottom → same horizontal line */
      .fw-hero-content { padding: 0 0 52px; }
      .fw-hero-content .fw-wrap { padding: 0 16px; }
      .fw-hero-title { font-size: 22px; }
      .fw-hero-sub { font-size: 13px; margin-bottom: 12px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
      .fw-hero-tag { font-size: 10px; padding: 4px 10px; margin-bottom: 12px; }

      /* buttons — left side, compact */
      .fw-hero-actions { gap: 6px; }
      .fw-btn-gold, .fw-btn-ghost { padding: 9px 12px; font-size: 11px; gap: 5px; }

      /* controls bottom matches content padding-bottom exactly */
      .fw-hero-controls { bottom: 16px; right: 12px; gap: 6px; }
      .fw-hero-dot { width: 7px; height: 7px; }
      .fw-hero-dots { gap: 6px; }
      .fw-hero-prev, .fw-hero-next { width: 32px; height: 32px; font-size: 12px; }

      /* navbar logo on small screens */
      .fw-nav-logo { padding: 6px 8px 6px 0; gap: 8px; }
      .fw-nav-logo-img { width: 40px; height: 40px; }
      .fw-nav-logo-title { font-size: 16px; letter-spacing: 1.5px; }
      .fw-nav-logo-sub { display: none; }

      .fw-comp-grid { grid-template-columns: 1fr; }
      .fw-section-head { flex-direction: column; align-items: flex-start; gap: 12px; }

      .fw-news-list-img { width: 100px; min-width: 100px; }
      .fw-news-list-title { font-size: 13px; }

      .fw-partners-row { gap: 20px; }
      .fw-partner-logo { width: 90px; height: 60px; }

      .fw-wrap { padding: 0 14px; }
    }
    </style>
</head>
<body>

{{-- TOP BAR --}}
<div class="fw-topbar">
    <div class="fw-topbar-inner">
        <div class="fw-topbar-left">
            <a href="mailto:sgoffice@ferwafa.com"><i class="fas fa-envelope"></i> sgoffice@ferwafa.com</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> PO. Box 2000, Kigali, Rwanda</a>
        </div>
        <div class="fw-topbar-right">
            <a href="https://www.facebook.com/RwandaFA/"    target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/FERWAFA"           target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/ferwafa/"    target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/@ferwafatv761" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

{{-- NAVBAR --}}
<nav class="fw-navbar">
    <div class="fw-wrap">
        <div class="fw-navbar-inner">
            <a href="/" class="fw-nav-logo">
                <div class="fw-nav-logo-img">
                    <img src="{{ asset('images/file.png') }}" alt="FERWAFA" />
                </div>
                <div>
                    <div class="fw-nav-logo-title">FERWAFA</div>
                    <div class="fw-nav-logo-sub">Rwanda Football Federation</div>
                </div>
            </a>

            <div style="display:flex;justify-content:center;">
                <ul class="fw-nav-links">
                    <li><a href="/" class="active">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li class="fw-dropdown">
                        <a href="#">Women Football <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop"><a href="#">First Division</a><ul class="fw-sub-drop-menu"><li><a href="#">Fixtures &amp; Results</a></li><li><a href="#">Standings</a></li><li><a href="#">Top Scorers</a></li></ul></li>
                            <li><a href="#">Second Division</a></li>
                            <li class="fw-sub-drop"><a href="#">National Team</a><ul class="fw-sub-drop-menu"><li><a href="{{ route('seniorWomen.news') }}">Senior</a></li><li><a href="{{ route('u20Women.news') }}">U-20</a></li><li><a href="{{ route('otherWomen.news') }}">Other</a></li></ul></li>
                            <li><a href="#">Peace Cup</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#">Competitions <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop"><a href="#">Men Football</a><ul class="fw-sub-drop-menu"><li><a href="#">BK Pro League</a></li><li><a href="#">Second Division</a></li><li><a href="#">Third Division</a></li></ul></li>
                            <li><a href="#">Peace Cup</a></li><li><a href="#">Other Cups</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#">National Teams <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop"><a href="#">Men</a><ul class="fw-sub-drop-menu"><li><a href="{{ route('seniorMen.news') }}">Senior – Amavubi</a></li><li><a href="{{ route('u23.news') }}">U-23 Olympic</a></li><li><a href="{{ route('u17.news') }}">U-17</a></li><li><a href="{{ route('otherMen.news') }}">Other</a></li></ul></li>
                            <li class="fw-sub-drop"><a href="#">Women</a><ul class="fw-sub-drop-menu"><li><a href="{{ route('seniorWomen.news') }}">Senior Women</a></li><li><a href="{{ route('u20Women.news') }}">U-20 Women</a></li></ul></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#">Resources <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                            <li><a href="{{ route('laws.page.show') }}">Laws of the Game</a></li>
                            <li><a href="{{ route('rules.page.show') }}">Rules &amp; Regulations</a></li>
                            <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                            <li><a href="#">Gallery</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#">Development <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('grassroots.news') }}">Grassroots Football</a></li>
                            <li><a href="{{ route('schools.news') }}">Football for Schools</a></li>
                            <li><a href="{{ route('youth.news') }}">Youth Development</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#">Career <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                            <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                            <li><a href="{{ route('career.page.show') }}">Others</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#">Independent Bodies <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop"><a href="#">Judicial Bodies</a><ul class="fw-sub-drop-menu"><li><a href="{{ route('independent-bodies', 1) }}">Conflicts Resolution</a></li><li><a href="{{ route('independent-bodies', 2) }}">Player Status</a></li><li><a href="{{ route('independent-bodies', 3) }}">Ethics Committee</a></li><li><a href="{{ route('independent-bodies', 4) }}">Disciplinary</a></li><li><a href="{{ route('independent-bodies', 5) }}">Appeal Committee</a></li></ul></li>
                            <li><a href="{{ route('independent-bodies', 6) }}">Audit Committee</a></li>
                            <li><a href="{{ route('independent-bodies', 7) }}">Electoral Committee</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#">Contact <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('information') }}">Information</a></li>
                            <li><a href="{{ route('whistleblowers') }}">Whistleblowers</a></li>
                        </ul>
                    </li>
                    @if (!Auth::check())
                        <li><a href="{{ route('login') }}" class="fw-nav-cta">Login</a></li>
                    @endif
                </ul>
            </div>

            <div style="display:flex;justify-content:flex-end;">
                <button class="fw-hamburger" id="fwHamburger">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- MOBILE NAV --}}
<div class="fw-mobile-nav" id="fwMobileNav">
    <div class="fw-mobile-nav-header">
        <div class="fw-mobile-nav-brand">
            <img src="{{ asset('images/file.png') }}" alt="FERWAFA" />
            <span>FERWAFA</span>
        </div>
        <button class="fw-mobile-close" id="fwMobileClose"><i class="fas fa-times"></i></button>
    </div>
    <ul class="fw-mobile-links">
        <li><div class="fw-mob-row"><a href="/">Home</a></div></li>
        <li><div class="fw-mob-row"><a href="{{ route('about') }}">About Us</a></div></li>
        <li>
            <div class="fw-mob-row"><a href="#">Women Football</a><button class="fw-mob-toggle" data-target="mob-women"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-women">
                <li><div class="fw-mob-sub-row"><a href="#">First Division</a><button class="fw-mob-sub-toggle" data-target="mob-w1st"><i class="fas fa-chevron-down"></i></button></div><ul class="fw-mob-subsub" id="mob-w1st"><li><a href="#">Fixtures &amp; Results</a></li><li><a href="#">Standings</a></li><li><a href="#">Top Scorers</a></li></ul></li>
                <li><a href="#">Second Division</a></li>
                <li><div class="fw-mob-sub-row"><a href="#">National Team</a><button class="fw-mob-sub-toggle" data-target="mob-wnat"><i class="fas fa-chevron-down"></i></button></div><ul class="fw-mob-subsub" id="mob-wnat"><li><a href="{{ route('seniorWomen.news') }}">Senior</a></li><li><a href="{{ route('u20Women.news') }}">U-20</a></li><li><a href="{{ route('otherWomen.news') }}">Other</a></li></ul></li>
                <li><a href="#">Peace Cup</a></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Competitions</a><button class="fw-mob-toggle" data-target="mob-comp"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-comp">
                <li><div class="fw-mob-sub-row"><a href="#">Men Football</a><button class="fw-mob-sub-toggle" data-target="mob-cmen"><i class="fas fa-chevron-down"></i></button></div><ul class="fw-mob-subsub" id="mob-cmen"><li><a href="#">BK Pro League</a></li><li><a href="#">Second Division</a></li><li><a href="#">Third Division</a></li></ul></li>
                <li><a href="#">Peace Cup</a></li><li><a href="#">Other Cups</a></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">National Teams</a><button class="fw-mob-toggle" data-target="mob-nat"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-nat">
                <li><div class="fw-mob-sub-row"><a href="#">Men</a><button class="fw-mob-sub-toggle" data-target="mob-nmen"><i class="fas fa-chevron-down"></i></button></div><ul class="fw-mob-subsub" id="mob-nmen"><li><a href="{{ route('seniorMen.news') }}">Senior – Amavubi</a></li><li><a href="{{ route('u23.news') }}">U-23 Olympic</a></li><li><a href="{{ route('u17.news') }}">U-17</a></li><li><a href="{{ route('otherMen.news') }}">Other</a></li></ul></li>
                <li><div class="fw-mob-sub-row"><a href="#">Women</a><button class="fw-mob-sub-toggle" data-target="mob-nwom"><i class="fas fa-chevron-down"></i></button></div><ul class="fw-mob-subsub" id="mob-nwom"><li><a href="{{ route('seniorWomen.news') }}">Senior Women</a></li><li><a href="{{ route('u20Women.news') }}">U-20 Women</a></li></ul></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Resources</a><button class="fw-mob-toggle" data-target="mob-res"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-res">
                <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                <li><a href="{{ route('laws.page.show') }}">Laws of the Game</a></li>
                <li><a href="{{ route('rules.page.show') }}">Rules &amp; Regulations</a></li>
                <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                <li><a href="#">Gallery</a></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Development</a><button class="fw-mob-toggle" data-target="mob-dev"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-dev">
                <li><a href="{{ route('grassroots.news') }}">Grassroots Football</a></li>
                <li><a href="{{ route('schools.news') }}">Football for Schools</a></li>
                <li><a href="{{ route('youth.news') }}">Youth Development</a></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Career</a><button class="fw-mob-toggle" data-target="mob-car"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-car">
                <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                <li><a href="{{ route('career.page.show') }}">Others</a></li>
            </ul>
        </li>
        <li><div class="fw-mob-row"><a href="{{ route('information') }}" style="color:var(--gold);">Contact Us</a></div></li>
        @if (!Auth::check())
            <li><div class="fw-mob-row"><a href="{{ route('login') }}">Login</a></div></li>
        @endif
    </ul>
</div>

{{-- HERO SLIDER --}}
<section class="fw-hero">
    <div class="fw-hero-slides" id="fwSlides">
        @php $si = 0; @endphp
        @foreach ($topResults as $key => $topResult)
            @if ($topResult['is_top'] == 1)
                <div class="fw-hero-slide {{ $si === 0 ? 'active' : '' }}">
                    <div class="fw-hero-bg" style="background-image:url('{{ route('news.images.show', $topResult['image_id']) }}')"></div>
                    <div class="fw-wrap fw-hero-content">
                        <div class="fw-hero-inner">
                            <div class="fw-hero-tag"><i class="fas fa-futbol"></i> Featured</div>
                            <h1 class="fw-hero-title">{{ $topResult['title'] }}</h1>
                            <p class="fw-hero-sub">{{ Str::limit($topResult['caption'], 150) }}</p>
                            <div class="fw-hero-actions" style="margin-bottom:20px">
                                <a href="{{ route('single.news', $topResult['id']) }}" class="fw-btn-gold"><i class="fas fa-arrow-right"></i> Read More</a>
                                <a href="{{ route('all.news') }}" class="fw-btn-ghost"><i class="fas fa-newspaper"></i> All News</a>
                            </div>
                        </div>
                    </div>
                </div>
                @php $si++; @endphp
            @endif
        @endforeach
    </div>

    {{-- Controls: absolute bottom-right on desktop, overlaid bottom-right on mobile --}}
    <div class="fw-hero-controls" id="fwControls">
        <button class="fw-hero-prev" id="fwPrev"><i class="fas fa-chevron-left"></i></button>
        <div class="fw-hero-dots" id="fwDots">
            @php $di = 0; @endphp
            @foreach ($topResults as $topResult)
                @if ($topResult['is_top'] == 1)
                    <div class="fw-hero-dot {{ $di === 0 ? 'active' : '' }}" data-index="{{ $di }}"></div>
                    @php $di++; @endphp
                @endif
            @endforeach
        </div>
        <button class="fw-hero-next" id="fwNext"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

{{-- TICKER --}}
<div class="fw-ticker">
    <div class="fw-ticker-label"><i class="fas fa-bolt"></i> Latest</div>
    <div class="fw-ticker-track">
        <div class="fw-ticker-inner">
            @foreach ($result as $news)<span class="fw-ticker-item">{{ $news['title'] }}</span>@endforeach
            @foreach ($result as $news)<span class="fw-ticker-item">{{ $news['title'] }}</span>@endforeach
        </div>
    </div>
</div>

{{-- LATEST NEWS --}}
<div class="fw-section" style="background:#fff;">
    <div class="fw-wrap">
        <div class="fw-section-head">
            <div>
                <div class="fw-section-label">Recent Updates</div>
                <h2 class="fw-section-title">Latest News</h2>
            </div>
            <a href="{{ route('all.news') }}" class="fw-view-all">All News <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="fw-news-layout">
            @if (isset($result[0]))
                <div class="fw-news-featured">
                    <a href="{{ route('single.news', $result[0]['id']) }}" class="fw-news-card">
                        <div class="fw-news-card-img">
                            <img src="{{ route('news.images.show', $result[0]['image_id']) }}" alt="{{ $result[0]['title'] }}" loading="lazy" />
                            <span class="fw-news-card-cat">News</span>
                        </div>
                        <div class="fw-news-card-body">
                            <div class="fw-news-card-meta"><i class="far fa-calendar"></i> {{ date('jS M Y', strtotime($result[0]['created_at'])) }}</div>
                            <h3 class="fw-news-card-title">{{ $result[0]['title'] }}</h3>
                            <p class="fw-news-card-excerpt">{{ $result[0]['caption'] }}</p>
                            <span class="fw-news-card-link">Read Full Story <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <div class="fw-news-right">
                @foreach ($result as $index => $news)
                    @if ($index > 0 && $index <= 4)
                        <a href="{{ route('single.news', $news['id']) }}" class="fw-news-list-item">
                            <div class="fw-news-list-img"><img src="{{ route('news.images.show', $news['image_id']) }}" alt="{{ $news['title'] }}" loading="lazy" /></div>
                            <div class="fw-news-list-body">
                                <div class="fw-news-list-meta"><i class="far fa-calendar"></i> {{ date('jS M Y', strtotime($news['created_at'])) }}</div>
                                <h4 class="fw-news-list-title">{{ $news['title'] }}</h4>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        <div style="text-align:center;margin-top:44px;">
            <a href="{{ route('all.news') }}" class="fw-view-all" style="font-size:14px;padding:13px 30px;border:2px solid var(--blue);border-radius:var(--radius);display:inline-flex;align-items:center;gap:8px;">
                Read More News <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- COMPETITIONS --}}
<section class="fw-comp-bar">
    <div class="fw-wrap">
        <div class="fw-section-label" style="color:var(--gold);">Rwanda Football</div>
        <h2 class="fw-section-title" style="color:#fff;">Competitions</h2>
        <div class="fw-comp-grid">
            <a href="#" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-shield-halved"></i></div><div><div class="fw-comp-name">BK Pro League</div><div class="fw-comp-meta">Men · First Division</div></div></a>
            <a href="#" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-venus"></i></div><div><div class="fw-comp-name">Women Super League</div><div class="fw-comp-meta">Women · First Division</div></div></a>
            <a href="#" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-layer-group"></i></div><div><div class="fw-comp-name">Second Division</div><div class="fw-comp-meta">Men · Second Tier</div></div></a>
            <a href="#" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-trophy"></i></div><div><div class="fw-comp-name">Peace Cup</div><div class="fw-comp-meta">Cup Competition</div></div></a>
            <a href="#" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-seedling"></i></div><div><div class="fw-comp-name">Youth Leagues</div><div class="fw-comp-meta">U-17 · U-20 · U-23</div></div></a>
            <a href="#" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-globe-africa"></i></div><div><div class="fw-comp-name">CAF / FIFA Events</div><div class="fw-comp-meta">International</div></div></a>
        </div>
    </div>
</section>

{{-- NATIONAL TEAMS --}}
<section class="fw-section fw-teams-section">
    <div class="fw-wrap">
        <div class="fw-section-head">
            <div><div class="fw-section-label">Rwanda's Pride</div><h2 class="fw-section-title">National Teams</h2></div>
            <a href="{{ route('seniorMen.news') }}" class="fw-view-all">All Teams <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="fw-teams-grid">
            <a href="{{ route('seniorMen.news') }}" class="fw-team-card">
                <div class="fw-team-card-header"><div class="fw-team-badge">AMAVUBI<br>STARS</div><div class="fw-team-flag"><span style="background:#00A1DE;"></span><span style="background:#FAD201;"></span><span style="background:#20603D;"></span></div></div>
                <div class="fw-team-card-body"><div class="fw-team-name">Senior Men – Amavubi</div><div class="fw-team-desc">Rwanda's senior men's team competing in AFCON qualifiers and CAF competitions.</div><span class="fw-team-link">View Team <i class="fas fa-arrow-right"></i></span></div>
            </a>
            <a href="{{ route('seniorWomen.news') }}" class="fw-team-card">
                <div class="fw-team-card-header"><div class="fw-team-badge">SENIOR<br>WOMEN</div><div class="fw-team-flag"><span style="background:#00A1DE;"></span><span style="background:#FAD201;"></span><span style="background:#20603D;"></span></div></div>
                <div class="fw-team-card-body"><div class="fw-team-name">Senior Women</div><div class="fw-team-desc">Rwanda's senior women's team competing in WAFCON qualifiers and growing the women's game.</div><span class="fw-team-link">View Team <i class="fas fa-arrow-right"></i></span></div>
            </a>
            <a href="{{ route('u17.news') }}" class="fw-team-card">
                <div class="fw-team-card-header"><div class="fw-team-badge">YOUTH<br>TEAMS</div><div class="fw-team-flag"><span style="background:#00A1DE;"></span><span style="background:#FAD201;"></span><span style="background:#20603D;"></span></div></div>
                <div class="fw-team-card-body"><div class="fw-team-name">Youth Teams</div><div class="fw-team-desc">U-17, U-20 &amp; U-23 squads representing Rwanda's next generation of football talent.</div><span class="fw-team-link">View Teams <i class="fas fa-arrow-right"></i></span></div>
            </a>
        </div>
    </div>
</section>

{{-- PARTNERS --}}
<div class="fw-partners">
    <div class="fw-wrap">
        <p class="fw-partners-label">Our Partners &amp; Affiliates</p>
        <div class="fw-partners-row">
            <a href="https://www.minisports.gov.rw/" target="_blank" class="fw-partner-logo"><img src="{{ asset('images/images.jpeg') }}" alt="MINISPORTS" /></a>
            <a href="https://www.cafonline.com/" target="_blank" class="fw-partner-logo"><img src="../asset/images/pngtree-caf-football-logo-png-image_3643068.jpg" alt="CAF" /></a>
            <a href="https://olympicrwanda.org/" target="_blank" class="fw-partner-logo"><img src="{{ asset('images/Logo Institu CNOSR sans fond.png') }}" alt="Rwanda Olympics" /></a>
            <a href="https://bralirwa.co.rw/" target="_blank" class="fw-partner-logo"><img src="../asset/images/primus.jpg" alt="Primus" /></a>
            <a href="https://www.fifa.com/fifaplus/en" target="_blank" class="fw-partner-logo"><img src="{{ asset('images/fifa.png') }}" alt="FIFA" /></a>
        </div>
    </div>
</div>

@include('footer')

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{ asset('libraries/lib.js') }}"></script>
<script src="{{ asset('libraries/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('libraries/lightslider-master/lightslider.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>

<script>
    // Hero slider
    var fwSlides  = document.querySelectorAll('.fw-hero-slide');
    var fwDots    = document.querySelectorAll('.fw-hero-dot');
    var fwCurrent = 0, fwTimer;
    function fwGoTo(n) {
        fwSlides[fwCurrent].classList.remove('active');
        if (fwDots[fwCurrent]) fwDots[fwCurrent].classList.remove('active');
        fwCurrent = (n + fwSlides.length) % fwSlides.length;
        fwSlides[fwCurrent].classList.add('active');
        if (fwDots[fwCurrent]) fwDots[fwCurrent].classList.add('active');
    }
    function fwStartAuto() { fwTimer = setInterval(function(){ fwGoTo(fwCurrent + 1); }, 5500); }
    function fwResetAuto()  { clearInterval(fwTimer); fwStartAuto(); }
    document.getElementById('fwPrev').addEventListener('click', function(){ fwGoTo(fwCurrent - 1); fwResetAuto(); });
    document.getElementById('fwNext').addEventListener('click', function(){ fwGoTo(fwCurrent + 1); fwResetAuto(); });
    fwDots.forEach(function(d){ d.addEventListener('click', function(){ fwGoTo(+d.dataset.index); fwResetAuto(); }); });
    if (fwSlides.length > 1) fwStartAuto();

    // Mobile nav
    document.getElementById('fwHamburger').addEventListener('click', function(){ document.getElementById('fwMobileNav').classList.add('open'); });
    document.getElementById('fwMobileClose').addEventListener('click', function(){ document.getElementById('fwMobileNav').classList.remove('open'); });

    // Top-level accordion
    document.querySelectorAll('.fw-mob-toggle').forEach(function(btn){
        btn.addEventListener('click', function(){
            var target = document.getElementById(btn.dataset.target);
            var wasOpen = target.classList.contains('open');
            btn.closest('li').parentElement.querySelectorAll('.fw-mob-sub').forEach(function(s){ s.classList.remove('open'); });
            btn.closest('li').parentElement.querySelectorAll('.fw-mob-toggle').forEach(function(b){ b.classList.remove('open'); });
            if (!wasOpen) { target.classList.add('open'); btn.classList.add('open'); }
        });
    });

    // Sub-level accordion
    document.querySelectorAll('.fw-mob-sub-toggle').forEach(function(btn){
        btn.addEventListener('click', function(){
            var target = document.getElementById(btn.dataset.target);
            var wasOpen = target.classList.contains('open');
            btn.closest('.fw-mob-sub').querySelectorAll('.fw-mob-subsub').forEach(function(s){ s.classList.remove('open'); });
            btn.closest('.fw-mob-sub').querySelectorAll('.fw-mob-sub-toggle').forEach(function(b){ b.classList.remove('open'); });
            if (!wasOpen) { target.classList.add('open'); btn.classList.add('open'); }
        });
    });
</script>
</body>
</html>