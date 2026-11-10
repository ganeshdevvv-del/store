
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1a644d">
    <title>Welcome | A-Z Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            color: #202c28;
            background: #f3f5ef;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
            --ink: #202c28;
            --muted: #65726c;
            --green: #1a644d;
            --green-dark: #124a39;
            --line: #dce2d8;
            --paper: #f3f5ef;
        }

        * { box-sizing: border-box; }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(ellipse at 9% 12%, rgba(205, 221, 193, 0.52), transparent 31rem),
                var(--paper);
        }

        a { color: inherit; }

        .site-header {
            position: relative;
            z-index: 1;
            display: flex;
            width: min(100% - 64px, 1240px);
            min-height: 88px;
            align-items: center;
            justify-content: space-between;
            margin: 0 auto;
            border-bottom: 1px solid rgba(32, 44, 40, 0.12);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-mark {
            display: grid;
            width: 42px;
            aspect-ratio: 1;
            place-items: center;
            border-radius: 6px;
            background: var(--green);
            color: #fff;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 19px;
            font-weight: 700;
        }

        .brand-name {
            display: grid;
            gap: 2px;
            font-size: 15px;
            font-weight: 700;
        }

        .brand-name span {
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .header-login {
            color: var(--ink);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .header-login:hover { color: var(--green); }

        .header-register {
            padding: 11px 16px;
            border: 1px solid var(--green);
            border-radius: 4px;
            color: var(--green-dark);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 160ms ease, color 160ms ease;
        }

        .header-register:hover {
            background: var(--green);
            color: #fff;
        }

        main {
            width: min(100% - 64px, 1240px);
            margin: 0 auto;
        }

        .welcome {
            display: grid;
            min-height: 590px;
            grid-template-columns: 0.92fr 1.08fr;
            align-items: center;
            gap: 64px;
            padding: 54px 0 62px;
        }

        .welcome-copy {
            max-width: 510px;
            animation: rise-in 600ms ease both;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 22px;
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .eyebrow::before {
            width: 26px;
            height: 2px;
            background: #cf6848;
            content: "";
        }

        h1 {
            max-width: 500px;
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 58px;
            font-weight: 500;
            line-height: 1.04;
        }

        h1 span { color: var(--green); }

        .welcome-text {
            max-width: 420px;
            margin: 24px 0 30px;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.75;
        }

        .welcome-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
        }

        .button {
            display: inline-flex;
            min-height: 48px;
            align-items: center;
            justify-content: center;
            gap: 11px;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 160ms ease, color 160ms ease, transform 160ms ease;
        }

        .button:hover { transform: translateY(-2px); }

        .button-primary {
            background: var(--green);
            color: #fff;
        }

        .button-primary:hover { background: var(--green-dark); }

        .button-secondary {
            border-color: #bfc9bf;
            background: transparent;
            color: var(--ink);
        }

        .button-secondary:hover { background: #e8ede5; }

        .button-arrow {
            font-size: 18px;
            line-height: 1;
        }

        .welcome-image {
            position: relative;
            min-height: 450px;
            overflow: hidden;
            background: #dce5d8;
            animation: reveal-image 800ms 100ms ease both;
        }

        .campus-art {
            position: absolute;
            overflow: hidden;
            background:
                linear-gradient(180deg, transparent 0 56%, rgba(84, 119, 87, 0.18) 56% 100%),
                linear-gradient(180deg, #dce9e5 0 56%, #afc5a5 56% 69%, #77936d 69% 100%);
            inset: 0;
        }

        .art-sun {
            position: absolute;
            top: 12%;
            right: 15%;
            width: 58px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #e7bd7d;
        }

        .art-building {
            position: absolute;
            bottom: 25%;
            left: 23%;
            width: 54%;
            height: 43%;
            border: 5px solid #f5f2e7;
            background: #d5d0bd;
            box-shadow: 0 16px 0 rgba(50, 76, 57, 0.12);
        }

        .art-building::before {
            position: absolute;
            top: 18%;
            left: 50%;
            width: 18%;
            height: 82%;
            background: #c3bba4;
            content: "";
            transform: translateX(-50%);
        }

        .art-roof {
            position: absolute;
            z-index: 1;
            top: -25%;
            left: -7%;
            width: 114%;
            height: 27%;
            background: #a45f49;
            clip-path: polygon(8% 0, 92% 0, 100% 100%, 0 100%);
        }

        .art-windows {
            position: absolute;
            top: 32%;
            left: 7%;
            width: 23%;
            height: 29%;
            border: 3px solid #f3ead4;
            background: #77968c;
            box-shadow: 105px 0 0 -3px #77968c, 105px 0 0 0 #f3ead4;
        }

        .art-windows::after {
            position: absolute;
            top: 47%;
            left: 0;
            width: 100%;
            height: 3px;
            background: #f3ead4;
            content: "";
        }

        .art-door {
            position: absolute;
            bottom: 0;
            left: 43%;
            width: 14%;
            height: 31%;
            border: 3px solid #f3ead4;
            border-bottom: 0;
            background: #587769;
        }

        .art-tree {
            position: absolute;
            z-index: 2;
            bottom: 24%;
            width: 12px;
            height: 21%;
            background: #775a42;
        }

        .art-tree::before {
            position: absolute;
            top: -46px;
            left: -23px;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #64866a;
            box-shadow: 14px 13px 0 -5px #78996f, -12px 17px 0 -6px #829f76;
            content: "";
        }

        .art-tree-left { left: 13%; }
        .art-tree-right { right: 12%; transform: scale(1.2); }

        .art-path {
            position: absolute;
            right: 28%;
            bottom: -5%;
            left: 38%;
            height: 30%;
            background: #d5c9a8;
            clip-path: polygon(42% 0, 58% 0, 100% 100%, 0 100%);
        }

        .welcome-image img {
            position: absolute;
            width: 100%;
            height: 100%;
            inset: 0;
            object-fit: cover;
            object-position: center;
            font-size: 0;
        }

        .image-note {
            position: absolute;
            right: 18px;
            bottom: 18px;
            left: 18px;
            display: flex;
            min-height: 58px;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.94);
            color: var(--ink);
            font-size: 13px;
            font-weight: 700;
        }

        .image-note span:last-child {
            color: var(--green);
            font-family: Georgia, "Times New Roman", serif;
            font-size: 21px;
        }

        .quick-access {
            display: grid;
            min-height: 108px;
            grid-template-columns: 1fr auto auto;
            align-items: center;
            gap: 34px;
            border-top: 1px solid var(--line);
        }

        .quick-access p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .quick-access a {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--ink);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .quick-access a:hover { color: var(--green); }

        .quick-access a span {
            color: #cf6848;
            font-size: 17px;
        }

        footer {
            display: flex;
            width: min(100% - 64px, 1240px);
            min-height: 58px;
            align-items: center;
            justify-content: space-between;
            margin: 0 auto;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 11px;
        }

        @keyframes rise-in {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes reveal-image {
            from { opacity: 0; clip-path: inset(0 0 0 8%); }
            to { opacity: 1; clip-path: inset(0); }
        }

        @media (max-width: 800px) {
            .site-header,
            main,
            footer { width: min(100% - 40px, 600px); }

            .welcome {
                min-height: 0;
                grid-template-columns: 1fr;
                gap: 34px;
                padding: 48px 0 38px;
            }

            .welcome-copy { max-width: 580px; }
            .welcome-image { min-height: 360px; }

            .quick-access {
                grid-template-columns: 1fr 1fr;
                gap: 18px;
                padding: 24px 0;
            }

            .quick-access p { grid-column: 1 / -1; }

            footer { min-height: 54px; }
        }

        @media (max-width: 480px) {
            .site-header,
            main,
            footer { width: calc(100% - 32px); }

            .site-header { min-height: 72px; }
            .brand { gap: 9px; }
            .brand-mark { width: 36px; font-size: 17px; }
            .brand-name { font-size: 13px; }
            .header-actions { gap: 13px; }
            .header-login { font-size: 13px; }
            .header-register { padding: 9px 10px; font-size: 12px; }

            .welcome { gap: 28px; padding-top: 40px; }
            h1 { font-size: 44px; }
            .welcome-text { margin: 18px 0 24px; font-size: 15px; }
            .welcome-actions { align-items: stretch; }
            .button { flex: 1 1 100%; }
            .welcome-image { min-height: 300px; }
            .image-note { right: 12px; bottom: 12px; left: 12px; }

            .quick-access { grid-template-columns: 1fr; gap: 16px; }
            .quick-access p { grid-column: auto; }
            footer { align-items: flex-start; flex-direction: column; justify-content: center; gap: 4px; padding: 12px 0; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }

        .portal-page {
            background: #f3f5ef;
            color: #202c28;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        }

        .portal-nav .navbar-brand { color: #202c28; }
        .portal-nav .navbar-brand:hover { color: #1a644d; }

        .portal-brand-mark {
            display: grid;
            width: 42px;
            aspect-ratio: 1;
            place-items: center;
            border-radius: 5px;
            background: #1a644d;
            color: #fff;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 15px;
            font-weight: 700;
        }

        .portal-hero {
            background: #1a644d;
            box-shadow: 0 16px 38px rgba(24, 67, 52, 0.12);
        }

        .portal-copy { padding: clamp(28px, 5vw, 64px); }
        .portal-kicker { color: #f0c77e; font-size: 12px; font-weight: 700; }

        .portal-title {
            max-width: 570px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(38px, 5vw, 62px);
            font-weight: 500;
            line-height: 1.06;
        }

        .portal-intro { max-width: 470px; color: rgba(255, 255, 255, 0.8); line-height: 1.75; }
        .portal-art { min-height: 380px; height: 100%; animation: none; }
        .portal-art .campus-art { background: linear-gradient(180deg, #dce9e5 0 56%, #afc5a5 56% 69%, #77936d 69% 100%); }
        .portal-art .image-note { right: 16px; bottom: 16px; left: 16px; }
        .portal-section-title { font-family: Georgia, "Times New Roman", serif; }

        .access-card {
            border-color: #e2e7df;
            border-radius: 6px;
            transition: border-color 160ms ease, transform 160ms ease, box-shadow 160ms ease;
        }

        .access-card:hover {
            transform: translateY(-3px);
            border-color: #a9c5b5;
            box-shadow: 0 12px 28px rgba(29, 55, 47, 0.08) !important;
        }

        .access-index { color: #bd694c; font-family: Georgia, "Times New Roman", serif; }
        .portal-footer { color: #65726c; }

        @media (max-width: 575.98px) {
            .portal-brand-mark { width: 36px; }
            .portal-brand-subtitle { display: none; }
            .portal-art { min-height: 280px; }
        }
    </style>
</head>
<body class="portal-page">
    <nav class="navbar portal-nav bg-white border-bottom" aria-label="Main navigation">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-2 me-auto" href="index.php">
                <span class="portal-brand-mark" aria-hidden="true">A-Z</span>
                <span class="d-grid lh-sm">
                    <strong class="fs-6">A-Z Student Portal</strong>
                    <small class="portal-brand-subtitle text-secondary mt-1">STUDENT MANAGEMENT SYSTEM</small>
                </span>
            </a>
            <div class="d-flex align-items-center gap-2 gap-sm-3">
                <a class="btn btn-link link-dark text-decoration-none fw-semibold" href="validation/login.php">Log in</a>
                <a class="btn btn-outline-success fw-semibold" href="validation/register.php">Register</a>
            </div>
        </div>
    </nav>

    <main class="container py-4 py-lg-5">
        <section class="portal-hero rounded-3 overflow-hidden mb-5" aria-labelledby="welcome-title">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="portal-copy text-white">
                        <p class="portal-kicker text-uppercase mb-3">Your campus, one place</p>
                        <h1 class="portal-title mb-3" id="welcome-title">Make your next move.</h1>
                        <p class="portal-intro mb-4">Welcome to the A-Z Student Management System. Sign in to your account or create a student profile to get started.</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a class="btn btn-warning fw-semibold px-4 py-2" href="validation/login.php">Sign in <span aria-hidden="true">&rarr;</span></a>
                            <a class="btn btn-outline-light fw-semibold px-4 py-2" href="validation/register.php">Create an account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="welcome-image portal-art">
                        <div class="campus-art" role="img" aria-label="Illustration of a school building and trees on campus">
                            <span class="art-sun"></span>
                            <span class="art-tree art-tree-left"></span>
                            <span class="art-tree art-tree-right"></span>
                            <span class="art-building">
                                <span class="art-roof"></span>
                                <span class="art-windows"></span>
                                <span class="art-door"></span>
                            </span>
                            <span class="art-path"></span>
                        </div>
                        <div class="image-note"><span>Make room for what comes next.</span><span aria-hidden="true">A–Z</span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="access-title">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-3">
                <div>
                    <p class="small text-uppercase text-success fw-bold mb-1">Portal access</p>
                    <h2 class="portal-section-title h3 mb-0" id="access-title">Choose how to continue</h2>
                </div>
                <span class="small text-secondary">Select an account option</span>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <article class="card access-card shadow-sm h-100">
                        <div class="card-body p-4 p-lg-5 d-flex flex-column">
                            <span class="access-index fs-5 mb-3">01 / STUDENT</span>
                            <h3 class="h4">Continue to your account</h3>
                            <p class="text-secondary mb-4">Sign in to open your student portal, or register if you are new.</p>
                            <div class="d-flex flex-wrap gap-2 mt-auto">
                                <a class="btn btn-success px-3" href="validation/login.php">Student login</a>
                                <a class="btn btn-outline-secondary px-3" href="validation/register.php">Register</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6">
                    <article class="card access-card shadow-sm h-100">
                        <div class="card-body p-4 p-lg-5 d-flex flex-column">
                            <span class="access-index fs-5 mb-3">02 / ADMIN</span>
                            <h3 class="h4">Manage the student system</h3>
                            <p class="text-secondary mb-4">Use the administrator role to sign in to the management dashboard.</p>
                            <div class="mt-auto">
                                <a class="btn btn-outline-success px-3" href="validation/login.php">Administrator login <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="row g-3 py-3 border-top" aria-label="Portal information">
            <div class="col-sm-4"><p class="small text-secondary mb-1">01</p><p class="fw-semibold mb-0">One place to start</p></div>
            <div class="col-sm-4"><p class="small text-secondary mb-1">02</p><p class="fw-semibold mb-0">Student and admin access</p></div>
            <div class="col-sm-4"><p class="small text-secondary mb-1">03</p><p class="fw-semibold mb-0">Simple account setup</p></div>
        </section>
    </main>

    <footer class="portal-footer border-top py-3">
        <div class="container d-flex flex-wrap justify-content-between gap-2 small">
            <span>A-Z Student Management System</span>
            <span>Student portal</span>
        </div>
    </footer>
</body>
</html>