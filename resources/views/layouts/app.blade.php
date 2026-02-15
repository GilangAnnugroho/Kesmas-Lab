<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Kesmas</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary:#2563eb;
            --accent:#06b6d4;
            --sidebar:#0f172a;
            --sidebar-active:#1e293b;
            --bg:#0b1120;
            --bg-soft:#020617;
            --text:#0f172a;
            --radius:18px;
        }

        *{box-sizing:border-box;margin:0;padding:0;}

        body{
            margin:0;
            font-family:'Inter', sans-serif;
            background:radial-gradient(circle at top,#0f172a,#020617);
            color:var(--text);
        }

        .layout{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:250px;
            background:linear-gradient(180deg,#020617,#0b1120);
            color:#e2e8f0;
            padding:18px 14px;
            display:flex;
            flex-direction:column;
            box-shadow:12px 0 40px rgba(15,23,42,.8);
        }
        .brand{
            font-size:18px;
            font-weight:700;
            margin-bottom:18px;
            padding:8px 10px;
            border-radius:999px;
            text-align:center;
            background:linear-gradient(90deg,#2563eb,#06b6d4);
            box-shadow:0 12px 28px rgba(37,99,235,.6);
        }
        .brand span{
            font-size:11px;
            display:block;
            font-weight:500;
            opacity:.85;
        }

        .nav-section-title{
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:.16em;
            color:#64748b;
            margin:6px 4px 6px;
        }

        .nav-item{
            display:flex;
            align-items:center;
            gap:8px;
            padding:9px 10px;
            border-radius:10px;
            color:#cbd5e1;
            text-decoration:none;
            margin-bottom:4px;
            font-size:13px;
            transition:.18s ease;
        }
        .nav-item:hover{
            background:rgba(15,23,42,.9);
            transform:translateY(-1px);
        }
        .nav-item.active{
            background:linear-gradient(90deg,rgba(37,99,235,.9),rgba(6,182,212,.9));
            color:white;
            box-shadow:0 14px 30px rgba(15,23,42,.85);
        }
        .nav-icon{
            width:22px;
            text-align:center;
        }

        .sidebar-footer{
            margin-top:auto;
            margin-bottom:4px;
            font-size:11px;
            color:#64748b;
        }

        .content{
            flex:1;
            background:radial-gradient(circle at top,#1e293b,#020617);
            padding:16px 18px 22px;
            color:#e5e7eb;
        }

        .navbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:18px;
        }
        .navbar-title{
            font-size:20px;
            font-weight:600;
        }
        .navbar-right{
            display:flex;
            align-items:center;
            gap:10px;
            font-size:13px;
        }
        .badge-role{
            padding:4px 10px;
            border-radius:999px;
            border:1px solid rgba(148,163,184,.7);
            background:rgba(15,23,42,.7);
        }

        .page-content{
            max-width:1200px;
            margin:0 auto;
        }

        .card{
            background:radial-gradient(circle at top left,#0f172a,#020617);
            border-radius:var(--radius);
            border:1px solid rgba(148,163,184,.6);
            box-shadow:0 22px 60px rgba(15,23,42,.9);
            padding:18px 20px;
            margin-bottom:18px;
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">
            Admin Kesmas
            <span>UPTD Labkesda Kab. Cirebon</span>
        </div>

        <div class="nav-section-title">Main</div>

        <a href="{{ route('admin.kesmas.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.kesmas.dashboard') ? 'active' : '' }}">
            <div class="nav-icon">📊</div>
            <div>Dashboard</div>
        </a>

        <a href="{{ route('admin.kesmas.registrations.index') }}"
           class="nav-item {{ request()->routeIs('admin.kesmas.registrations.*') ? 'active' : '' }}">
            <div class="nav-icon">📋</div>
            <div>Registrasi</div>
        </a>

        <a href="{{ route('admin.kesmas.parameters.index') }}"
           class="nav-item {{ request()->routeIs('admin.kesmas.parameters.*') ? 'active' : '' }}">
            <div class="nav-icon">⚙️</div>
            <div>Master Parameter</div>
        </a>

        <div class="sidebar-footer">
            <div>Logged in as</div>
            <div style="font-weight:500;">{{ auth()->user()->name ?? 'Admin' }}</div>
        </div>
    </aside>

    <main class="content">
        <div class="navbar">
            <div class="navbar-title">@yield('title')</div>

            <div class="navbar-right">
                <span class="badge-role">
                    🔐 Admin Kesmas
                </span>

                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit"
                            style="
                                border:none;
                                background:linear-gradient(90deg,#ef4444,#f97316);
                                color:white;
                                border-radius:999px;
                                padding:6px 12px;
                                font-size:12px;
                                cursor:pointer;
                                box-shadow:0 12px 30px rgba(15,23,42,.8);
                            ">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="page-content">
            @yield('content')
        </div>
    </main>

</div>

@stack('scripts')
</body>
</html>
