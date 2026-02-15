<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Form Kesmas - UPTD Labkesda' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root{
            --bg-body:#e0f2fe;
            --sheet-bg:rgba(255,255,255,0.96);
            --primary:#2563eb;
            --primary-soft:#dbeafe;
            --accent:#06b6d4;
            --border:#e5e7eb;
            --border-strong:#9ca3af;
            --text:#0f172a;
            --muted:#6b7280;
            --radius:20px;
            --shadow:0 22px 60px rgba(15,23,42,.32);
            --chip-bg:#eff6ff;
            --chip-text:#1d4ed8;
        }

        body[data-theme="dark"]{
            --bg-body:#020617;
            --sheet-bg:rgba(15,23,42,0.95);
            --primary:#6366f1;
            --primary-soft:#1e293b;
            --accent:#22d3ee;
            --border:#1f2937;
            --border-strong:#4b5563;
            --text:#e5e7eb;
            --muted:#94a3b8;
            --chip-bg:#1e3a8a;
            --chip-text:#e0e7ff;
            --shadow:0 28px 80px rgba(15,23,42,.9);
        }

        *{box-sizing:border-box;margin:0;padding:0;}

        body{
            font-family:'Inter',system-ui,-apple-system,Segoe UI,sans-serif;
            min-height:100vh;
            background:radial-gradient(circle at top,#bfdbfe,#eff6ff);
            transition:background .3s ease,color .2s ease;
            padding:12px;
            color:var(--text);
            display:flex;
            align-items:flex-start;
            justify-content:center;
        }
        body[data-theme="dark"]{
            background:radial-gradient(circle at top,#020617,#020617);
        }

        .sheet-wrap{
            width:100%;
            max-width:960px;
            background:var(--sheet-bg);
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            padding:14px 14px 16px;
            border:1px solid rgba(148,163,184,.55);
            backdrop-filter:blur(16px);
            position:relative;
            overflow:hidden;
            margin-bottom:40px;
        }
        .sheet-wrap::before{
            content:"";
            position:absolute;
            inset:-40%;
            background:
                radial-gradient(circle at top left,rgba(56,189,248,.15),transparent 55%),
                radial-gradient(circle at bottom right,rgba(59,130,246,.16),transparent 55%);
            pointer-events:none;
        }
        .sheet-inner{
            position:relative;
            z-index:2;
        }

        .theme-toggle{
            position:absolute;
            top:10px;
            right:10px;
            z-index:3;
        }
        .toggle-btn{
            border-radius:999px;
            border:1px solid var(--border);
            background:rgba(248,250,252,.95);
            padding:3px 9px;
            font-size:11px;
            display:flex;
            align-items:center;
            gap:5px;
            cursor:pointer;
            box-shadow:0 10px 25px rgba(15,23,42,.25);
            color:var(--text);
        }
        body[data-theme="dark"] .toggle-btn{
            background:rgba(15,23,42,.96);
        }
        .toggle-btn span.icon{
            font-size:14px;
        }
    </style>

    @stack('styles')

</head>
<body>

<div class="sheet-wrap">
    <div class="theme-toggle">
        <button type="button" class="toggle-btn" id="themeToggle">
            <span class="icon" id="themeIcon">🌙</span>
            <span id="themeLabel">Dark mode</span>
        </button>
    </div>

    <div class="sheet-inner">
        @yield('content')
    </div>
</div>

<!-- JS -->
<script src="/js/kesmas-theme.js"></script>

@stack('scripts')

</body>
</html>
