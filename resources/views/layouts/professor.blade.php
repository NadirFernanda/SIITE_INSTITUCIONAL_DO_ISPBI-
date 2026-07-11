<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Painel Professor') — ISP-Bié</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f0f9ff;min-height:100vh;display:flex}
/* Sidebar */
.sidebar{width:220px;background:#0e7490;color:#fff;display:flex;flex-direction:column;min-height:100vh;flex-shrink:0}
.sidebar-brand{padding:22px 20px 18px;border-bottom:1px solid rgba(255,255,255,.15)}
.sidebar-brand .title{font-size:1.1rem;font-weight:800;line-height:1.2}
.sidebar-brand .sub{font-size:0.72rem;color:#a5f3fc;margin-top:3px}
.sidebar-nav{padding:16px 0;flex:1}
.sidebar-nav a{display:flex;align-items:center;gap:9px;padding:10px 20px;color:rgba(255,255,255,.85);text-decoration:none;font-size:0.88rem;font-weight:500;transition:background .15s}
.sidebar-nav a:hover,.sidebar-nav a.active{background:rgba(255,255,255,.15);color:#fff}
.sidebar-footer{padding:16px 20px;border-top:1px solid rgba(255,255,255,.15);font-size:0.8rem;color:#a5f3fc}
.sidebar-footer .name{font-weight:700;color:#fff;margin-bottom:2px}
.sidebar-footer form button{background:transparent;border:1px solid rgba(255,255,255,.35);color:#a5f3fc;padding:5px 12px;border-radius:6px;cursor:pointer;font-size:0.78rem;margin-top:8px;width:100%}
.sidebar-footer form button:hover{background:rgba(255,255,255,.15);color:#fff}
/* Content */
.main{flex:1;padding:32px 28px;min-width:0}
</style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="title">ISP-Bié</div>
        <div class="sub">Painel do Professor</div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('professor.notas.index') }}"
           class="{{ request()->routeIs('professor.notas.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            Lançar Notas
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="name">{{ auth()->user()->name }}</div>
        <div>Professor</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </div>
</aside>
<main class="main">
    @yield('content')
</main>
</body>
</html>
