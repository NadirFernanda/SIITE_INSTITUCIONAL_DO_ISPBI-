<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Professor — ISP-Bié</title>
    <style>
        body { margin:0; font-family:'Segoe UI','Arial',sans-serif; background:#f8fafc; }
        .sidebar {
            width:220px; background:#1e3a5f; color:#fff; height:100vh;
            position:fixed; top:0; left:0; padding-top:20px;
            box-shadow:2px 0 16px rgba(124,58,237,0.15);
            border-radius:0 18px 18px 0;
            display:flex; flex-direction:column; gap:4px;
        }
        .sidebar-logo {
            margin:0 24px 28px; font-size:1.1rem; font-weight:700;
            color:#fff; line-height:1.3;
        }
        .sidebar-logo span { display:block; font-size:0.78rem; font-weight:400; color:#a8c4e0; margin-top:2px; }
        .sidebar a {
            color:#fff; text-decoration:none; display:flex; align-items:center;
            gap:8px; padding:11px 26px; font-size:1rem; border-radius:10px;
            margin:2px 12px; transition:background 0.2s; font-weight:500;
        }
        .sidebar a:hover, .sidebar a.active { background:#0f1f3d; }
        .main-content { margin-left:220px; padding:36px 28px; min-height:100vh; }
        .header {
            background:#1e3a5f; padding:18px 36px; margin-left:220px;
            font-size:1.1rem; font-weight:600; color:#fff;
            border-radius:0 0 16px 16px;
            box-shadow:0 2px 8px rgba(124,58,237,0.12);
        }
        @media(max-width:860px){
            .sidebar{width:100vw;height:auto;position:relative;border-radius:0;flex-direction:row;align-items:center;padding:0;gap:0;}
            .sidebar-logo{display:none;}
            .sidebar a{font-size:0.9rem;padding:9px 10px;margin:0 2px;border-radius:0;}
            .main-content,.header{margin-left:0;padding:14px;border-radius:0;}
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            ISP-Bié
            <span>Painel Professor</span>
        </div>
        <div style="flex:1;">
            <a href="{{ route('professor.salas.index') }}"
               class="{{ request()->routeIs('professor.salas.*') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 017 12V7a2 2 0 012-2z"/>
                </svg>
                Por Sala
            </a>
            <a href="{{ route('professor.candidaturas.index') }}"
               class="{{ request()->routeIs('professor.candidaturas.*') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                    <path stroke-linecap="round" d="M8 7h8M8 11h8M8 15h5"/>
                </svg>
                Pesquisa Rápida
            </a>
        </div>
        <div style="margin:16px 12px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        style="width:100%;background:#fff;color:#1e3a5f;font-weight:700;padding:9px 0;border:none;border-radius:8px;cursor:pointer;">
                    Sair
                </button>
            </form>
        </div>
    </div>

    <div class="header">
        Instituto Superior Politécnico do Bié — Lançamento de Notas
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>
