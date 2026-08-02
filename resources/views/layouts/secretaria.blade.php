<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretaria — ISP-Bié</title>
    <style>
        body { margin:0; font-family:'Segoe UI','Arial',sans-serif; background:#f8fafc; }
        .sidebar {
            width:230px; background:#1e3a5f; color:#fff; height:100vh;
            position:fixed; top:0; left:0; padding-top:20px;
            box-shadow:2px 0 16px rgba(124,58,237,0.15);
            border-radius:0 18px 18px 0;
            display:flex; flex-direction:column;
        }
        .sidebar-logo { margin:0 24px 28px; }
        .sidebar-logo-title { font-size:1.1rem; font-weight:700; color:#fff; line-height:1.3; }
        .sidebar-logo-sub { font-size:0.75rem; font-weight:400; color:#a8c4e0; margin-top:2px; display:block; }
        .sidebar a {
            color:#fff; text-decoration:none; display:flex; align-items:center;
            gap:8px; padding:11px 26px; font-size:1rem; border-radius:10px;
            margin:2px 12px; transition:background 0.2s; font-weight:500;
        }
        .sidebar a:hover, .sidebar a.active { background:#0f1f3d; }
        .badge { margin-left:auto; background:#F05A28; color:#fff; font-size:0.72rem; font-weight:700; border-radius:20px; padding:2px 8px; }
        .main-content { margin-left:230px; padding:36px 28px; min-height:100vh; }
        .header { background:#1e3a5f; padding:18px 36px; margin-left:230px; font-size:1.1rem; font-weight:600; color:#fff; border-radius:0 0 16px 16px; box-shadow:0 2px 8px rgba(124,58,237,0.12); }
        @media(max-width:860px){
            .sidebar{width:100vw;height:auto;position:relative;border-radius:0;flex-direction:row;align-items:center;padding:0;}
            .sidebar-logo{display:none;}
            .sidebar a{font-size:0.9rem;padding:9px 10px;margin:0 2px;border-radius:0;}
            .main-content,.header{margin-left:0;padding:14px;border-radius:0;}
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-title">ISP-Bié</div>
            <span class="sidebar-logo-sub">Secretaria — Pagamentos</span>
        </div>
        <div style="flex:1;overflow-y:auto;">
            <a href="{{ route('secretaria.candidaturas.index') }}"
               class="{{ request()->routeIs('secretaria.candidaturas.*') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Candidaturas
                @php $semPagamento = \App\Models\Candidatura::where('pagamento_confirmado', false)->count(); @endphp
                @if($semPagamento > 0)
                    <span class="badge">{{ $semPagamento }}</span>
                @endif
            </a>
        </div>
        <div style="margin:16px 12px;">
            <div style="font-size:0.75rem;color:#a8c4e0;margin-bottom:8px;padding:0 14px;">
                {{ Auth::user()->name }}
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%;background:#fff;color:#1e3a5f;font-weight:700;padding:9px 0;border:none;border-radius:8px;cursor:pointer;">Sair</button>
            </form>
        </div>
    </div>
    <div class="header">Instituto Superior Politécnico do Bié — Secretaria</div>
    <div class="main-content">@yield('content')</div>
</body>
</html>
