<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Técnico — ISP-Bié</title>
    <style>
        body { margin:0; font-family:'Segoe UI','Arial',sans-serif; background:#f8fafc; }
        .sidebar {
            width:220px; background:#1e3a5f; color:#fff; height:100vh;
            position:fixed; top:0; left:0; padding-top:20px;
            box-shadow:2px 0 16px rgba(14,92,47,0.12);
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
        .sidebar .badge {
            margin-left:auto; background:#F05A28; color:#fff;
            font-size:0.72rem; font-weight:700; border-radius:20px;
            padding:2px 8px; min-width:20px; text-align:center;
        }
        .main-content { margin-left:220px; padding:36px 28px; min-height:100vh; }
        .header {
            background:#1e3a5f; padding:18px 36px; margin-left:220px;
            font-size:1.1rem; font-weight:600; color:#fff;
            border-radius:0 0 16px 16px;
            box-shadow:0 2px 8px rgba(14,92,47,0.10);
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
            <span>Painel Técnico</span>
        </div>
        <div style="flex:1;">
            <a href="{{ route('tecnico.candidaturas.index') }}"
               class="{{ request()->routeIs('tecnico.candidaturas.*') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                    <path stroke-linecap="round" d="M8 7h8M8 11h8M8 15h5"/>
                </svg>
                Candidaturas
                @php $pendente = \App\Models\Candidatura::where('status','pendente')->count(); @endphp
                @if($pendente > 0)
                    <span class="badge">{{ $pendente }}</span>
                @endif
            </a>
            <a href="{{ route('tecnico.relatorios') }}"
               class="{{ request()->routeIs('tecnico.relatorios*') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v5m-5 5l2 2 4-4"/></svg>
                Relatórios
            </a>
            <a href="{{ route('tecnico.salas.index') }}"
               class="{{ request()->routeIs('tecnico.salas.*') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="7" width="20" height="13" rx="2"/><path d="M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/>
                    <path stroke-linecap="round" d="M12 12v4M10 14h4"/>
                </svg>
                Salas de Exame
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
        Instituto Superior Politécnico do Bié — Área Técnica
    </div>

    <div class="main-content">
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>
