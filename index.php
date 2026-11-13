<?php
$year = date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LocalRaket helps local businesses get found, get chosen, and grow with confidence.">
    <meta name="theme-color" content="#f7f8f4">
    <title>LocalRaket — Good things grow locally</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #17241d;
            --muted: #657168;
            --paper: #f7f8f4;
            --green: #c9f36a;
            --green-dark: #91c930;
            --line: #e4e9e0;
            --white: #fff;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; text-decoration: none; }

        .shell {
            width: min(1120px, calc(100% - 48px));
            margin: 0 auto;
        }

        .site-header {
            height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -0.8px;
        }

        .brand-mark {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: var(--green);
            font-size: 17px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 34px;
            color: #48554c;
            font-size: 13px;
            font-weight: 600;
        }

        .nav-links a:hover { color: var(--ink); }

        .button {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 20px;
            border: 0;
            border-radius: 8px;
            background: var(--ink);
            color: var(--white);
            font: inherit;
            font-size: 13px;
            font-weight: 700;
            transition: transform 160ms ease, background 160ms ease;
        }

        .button:hover { transform: translateY(-2px); background: #2a3c31; }

        .button-light {
            min-height: 40px;
            padding: 0 15px;
            background: var(--white);
            color: var(--ink);
        }

        .button-light:hover { background: var(--green); color: var(--ink); }

        .hero {
            min-height: 590px;
            display: grid;
            grid-template-columns: 1fr 0.9fr;
            align-items: center;
            gap: 52px;
            padding: 65px 0 76px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #59665c;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green-dark);
            box-shadow: 0 0 0 4px #e8f4d5;
        }

        h1, h2, h3, p { margin-top: 0; }

        h1 {
            max-width: 600px;
            margin: 20px 0 18px;
            font-size: clamp(46px, 6vw, 72px);
            line-height: 0.99;
            letter-spacing: -5px;
        }

        h1 span {
            position: relative;
            z-index: 0;
            white-space: nowrap;
        }

        h1 span::after {
            position: absolute;
            z-index: -1;
            right: -3px;
            bottom: 3px;
            left: -3px;
            height: 20px;
            border-radius: 4px;
            background: var(--green);
            content: "";
            transform: rotate(-1.5deg);
        }

        .hero-copy {
            max-width: 450px;
            margin-bottom: 27px;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.75;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .text-link {
            color: #455249;
            font-size: 13px;
            font-weight: 700;
        }

        .text-link span { margin-left: 5px; }

        .social-proof {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 42px;
            color: #6a756d;
            font-size: 11px;
        }

        .avatars { display: flex; padding-left: 4px; }

        .avatar {
            width: 29px;
            height: 29px;
            display: grid;
            place-items: center;
            margin-left: -4px;
            border: 2px solid var(--paper);
            border-radius: 50%;
            background: #e7c7a2;
            font-size: 13px;
        }

        .avatar:nth-child(2) { background: #b9d1c0; }
        .avatar:nth-child(3) { background: #e8c1be; }
        .social-proof strong { color: var(--ink); }

        .visual {
            position: relative;
            min-height: 414px;
            display: grid;
            place-items: center;
        }

        .visual-blob {
            position: absolute;
            width: min(370px, 90%);
            aspect-ratio: 1;
            border-radius: 47% 53% 56% 44% / 45% 42% 58% 55%;
            background: #e7f2d5;
            transform: rotate(-11deg);
        }

        .dashboard {
            position: relative;
            width: min(390px, 100%);
            padding: 22px;
            border: 1px solid #e8ede7;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 24px 70px rgba(32, 54, 38, 0.12);
            transform: rotate(2deg);
        }

        .dash-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .dash-title { font-size: 12px; font-weight: 800; }

        .dash-label {
            display: block;
            margin-top: 5px;
            color: #879189;
            font-size: 10px;
        }

        .dash-period {
            padding: 7px 9px;
            border: 1px solid #edf0ec;
            border-radius: 6px;
            color: #67736a;
            font-size: 9px;
        }

        .metric {
            display: flex;
            align-items: baseline;
            gap: 10px;
        }

        .metric strong {
            font-size: 36px;
            letter-spacing: -2px;
        }

        .metric span {
            color: #38854a;
            font-size: 10px;
            font-weight: 800;
        }

        .chart {
            height: 132px;
            margin: 5px 0 12px;
            border-bottom: 1px solid #edf0ec;
            background: repeating-linear-gradient(to bottom, transparent 0, transparent 32px, #eef2ed 33px);
        }

        .chart svg { width: 100%; height: 100%; overflow: visible; }

        .chart-line {
            fill: none;
            stroke: #8bc843;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 4;
        }

        .chart-fill { fill: url(#chartFill); }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            color: #a0a9a2;
            font-size: 9px;
        }

        .dash-footer {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
            background: #f5f8f1;
        }

        .search-icon {
            width: 25px;
            height: 25px;
            display: grid;
            place-items: center;
            border-radius: 7px;
            background: var(--green);
            font-size: 12px;
        }

        .dash-footer strong { display: block; font-size: 10px; }
        .dash-footer small { color: #7d897f; font-size: 9px; }

        .floating-card {
            position: absolute;
            right: -5px;
            bottom: 49px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border: 1px solid #eef0eb;
            border-radius: 10px;
            background: var(--white);
            box-shadow: 0 12px 35px rgba(32, 54, 38, 0.11);
            transform: rotate(-3deg);
        }

        .floating-icon {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #eaf5db;
            font-size: 16px;
        }

        .floating-card strong { display: block; font-size: 11px; }
        .floating-card small { color: #7d897f; font-size: 9px; }

        .trust {
            padding: 29px 0 33px;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            text-align: center;
        }

        .trust p {
            margin-bottom: 21px;
            color: #929b93;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .partner-list {
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 22px;
            color: #7e8980;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -0.7px;
        }

        .partner-list span:nth-child(2) { font-family: Georgia, serif; font-weight: 700; }
        .partner-list span:nth-child(3) { letter-spacing: 1px; }
        .partner-list span:nth-child(4) { font-style: italic; }
        .partner-list span:nth-child(5) { font-size: 14px; letter-spacing: 1px; }

        .services { padding: 91px 0 96px; }

        .section-heading {
            max-width: 510px;
            margin: 0 auto 44px;
            text-align: center;
        }

        .section-heading .eyebrow { justify-content: center; }

        h2 {
            margin: 15px 0 12px;
            font-size: clamp(32px, 4vw, 43px);
            line-height: 1.08;
            letter-spacing: -2.2px;
        }

        .section-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 17px;
        }

        .service-card {
            min-height: 220px;
            padding: 25px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.55);
        }

        .service-icon {
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            margin-bottom: 26px;
            border-radius: 10px;
            background: #edf5e3;
            font-size: 17px;
        }

        .service-card h3 {
            margin-bottom: 9px;
            font-size: 16px;
            letter-spacing: -0.4px;
        }

        .service-card p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .cta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 52px;
            padding: 39px 44px;
            border-radius: 14px;
            background: var(--green);
        }

        .cta h2 {
            max-width: 510px;
            margin: 0;
            font-size: 31px;
            letter-spacing: -1.5px;
        }

        .cta p {
            margin: 7px 0 0;
            color: #4a5a3d;
            font-size: 13px;
        }

        .cta .button { flex-shrink: 0; }

        .site-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 0 28px;
            border-top: 1px solid var(--line);
            color: #758078;
            font-size: 11px;
        }

        .site-footer p { margin: 0; }
        .footer-links { display: flex; gap: 20px; }
        .footer-links a:hover { color: var(--ink); }

        @media (max-width: 760px) {
            .shell { width: min(100% - 36px, 560px); }
            .site-header { height: 70px; }
            .nav-links { gap: 17px; }
            .nav-links > a:not(.button-light) { display: none; }
            .hero {
                min-height: auto;
                grid-template-columns: 1fr;
                gap: 5px;
                padding: 65px 0 43px;
            }
            h1 { max-width: 540px; font-size: clamp(48px, 11vw, 68px); letter-spacing: -3.8px; }
            .hero-copy { font-size: 15px; }
            .social-proof { margin-top: 31px; }
            .visual { min-height: 385px; margin-top: 10px; }
            .dashboard { width: min(390px, 88%); }
            .floating-card { right: 0; }
            .trust { padding: 25px 0; }
            .partner-list { flex-wrap: wrap; justify-content: center; gap: 17px 30px; font-size: 14px; }
            .services { padding: 70px 0; }
            .service-grid { grid-template-columns: 1fr; gap: 12px; }
            .service-card { min-height: 0; padding: 22px; }
            .service-icon { margin-bottom: 18px; }
            .cta { align-items: flex-start; flex-direction: column; padding: 30px 25px; }
            .cta h2 { font-size: 28px; }
        }

        @media (max-width: 420px) {
            .hero-actions { align-items: flex-start; flex-direction: column; gap: 15px; }
            .visual { min-height: 345px; }
            .dashboard { padding: 18px; }
            .floating-card { right: -3px; bottom: 22px; }
            .site-footer { align-items: flex-start; flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>
    <header class="site-header shell">
        <a class="brand" href="#" aria-label="LocalRaket home">
            <span class="brand-mark" aria-hidden="true">↗</span>
            <span>localraket</span>
        </a>
        <nav class="nav-links" aria-label="Main navigation">
            <a href="#services">What we do</a>
            <a href="#about">Why local</a>
            <a class="button button-light" href="mailto:hello@localraket.test">Let’s talk <span aria-hidden="true">↗</span></a>
        </nav>
    </header>

    <main>
        <section class="hero shell" id="about">
            <div>
                <div class="eyebrow"><span class="eyebrow-dot"></span> Your neighborhood growth team</div>
                <h1>Good things grow <span>locally.</span></h1>
                <p class="hero-copy">We help ambitious local businesses get found, get chosen, and grow — with smart marketing that feels like you.</p>
                <div class="hero-actions">
                    <a class="button" href="mailto:hello@localraket.test">Get your free growth plan <span aria-hidden="true">↗</span></a>
                    <a class="text-link" href="#services">See what we do <span aria-hidden="true">↓</span></a>
                </div>
                <div class="social-proof">
                    <div class="avatars" aria-hidden="true">
                        <span class="avatar">👩🏻</span>
                        <span class="avatar">👨🏽</span>
                        <span class="avatar">👩🏾</span>
                    </div>
                    <span>Helping <strong>120+ local teams</strong> grow with confidence</span>
                </div>
            </div>

            <div class="visual" aria-label="Illustration of growing local business results">
                <div class="visual-blob"></div>
                <div class="dashboard">
                    <div class="dash-top">
                        <div>
                            <span class="dash-title">Your local reach</span>
                            <span class="dash-label">People finding you this month</span>
                        </div>
                        <span class="dash-period">Last 30 days⌄</span>
                    </div>
                    <div class="metric">
                        <strong>8,492</strong>
                        <span>↗ 24.8%</span>
                    </div>
                    <div class="chart">
                        <svg viewBox="0 0 340 130" preserveAspectRatio="none" role="img" aria-label="A rising line chart">
                            <defs>
                                <linearGradient id="chartFill" x1="0" x2="0" y1="0" y2="1">
                                    <stop offset="0%" stop-color="#c9f36a" stop-opacity=".42"/>
                                    <stop offset="100%" stop-color="#c9f36a" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                            <path class="chart-fill" d="M0 105 C25 95 26 81 53 89 S93 75 112 83 S151 61 174 72 S208 43 232 56 S269 34 286 43 S319 17 340 10 V130 H0 Z"/>
                            <path class="chart-line" d="M0 105 C25 95 26 81 53 89 S93 75 112 83 S151 61 174 72 S208 43 232 56 S269 34 286 43 S319 17 340 10"/>
                            <circle cx="340" cy="10" r="5" fill="#8bc843"/>
                        </svg>
                    </div>
                    <div class="chart-labels"><span>May 01</span><span>May 08</span><span>May 15</span><span>May 22</span><span>May 30</span></div>
                    <div class="dash-footer">
                        <span class="search-icon" aria-hidden="true">⌕</span>
                        <span><strong>Showing up where it matters</strong><small>Local search visibility is up this month</small></span>
                    </div>
                </div>
                <div class="floating-card">
                    <span class="floating-icon" aria-hidden="true">✦</span>
                    <span><strong>More good-fit customers</strong><small>That's what growth looks like</small></span>
                </div>
            </div>
        </section>

        <section class="trust shell" aria-label="Businesses we work with">
            <p>Good company for the neighborhood</p>
            <div class="partner-list">
                <span>the good cup</span>
                <span>Oak &amp; Ivy</span>
                <span>COMMON GROUND</span>
                <span>little sunday</span>
                <span>FIELDWORK STUDIO</span>
            </div>
        </section>

        <section class="services shell" id="services">
            <div class="section-heading">
                <div class="eyebrow"><span class="eyebrow-dot"></span> Small business, big energy</div>
                <h2>Everything you need to get growing.</h2>
                <p>No confusing jargon or cookie-cutter plans. Just the right mix of local know-how and digital smarts.</p>
            </div>
            <div class="service-grid">
                <article class="service-card">
                    <span class="service-icon" aria-hidden="true">⌕</span>
                    <h3>Be easy to find</h3>
                    <p>Show up when nearby customers are searching for exactly what you do.</p>
                </article>
                <article class="service-card">
                    <span class="service-icon" aria-hidden="true">✳</span>
                    <h3>Look like the real deal</h3>
                    <p>Build a brand and online presence that turns a quick look into a first hello.</p>
                </article>
                <article class="service-card">
                    <span class="service-icon" aria-hidden="true">↗</span>
                    <h3>Keep the good going</h3>
                    <p>Bring customers back and turn happy regulars into your best word of mouth.</p>
                </article>
            </div>
        </section>

        <section class="cta shell">
            <div>
                <h2>Your next chapter starts around the corner.</h2>
                <p>Tell us where you want to go. We'll help you map the way.</p>
            </div>
            <a class="button" href="mailto:hello@localraket.test">Let’s make it happen <span aria-hidden="true">↗</span></a>
        </section>
    </main>

    <footer class="site-footer shell">
        <a class="brand" href="#" aria-label="LocalRaket home">
            <span class="brand-mark" aria-hidden="true">↗</span>
            <span>localraket</span>
        </a>
        <p>© <?= htmlspecialchars($year, ENT_QUOTES, 'UTF-8') ?> LocalRaket. Made for the neighborhood.</p>
        <div class="footer-links">
            <a href="mailto:hello@localraket.test">Contact</a>
            <a href="#about">Back to top ↑</a>
        </div>
    </footer>
</body>
</html>
