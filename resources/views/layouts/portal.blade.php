<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Portal Alumni') — ISP-Bié</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: #f5f6fa; }
        [x-cloak] { display: none !important; }
        .nav-link-active { color: #F05A28 !important; border-bottom: 2px solid #F05A28; }
        .nav-link { color: #1e3a5f; font-weight: 600; font-size: 0.88rem; padding: 4px 0; border-bottom: 2px solid transparent; transition: color 0.15s, border-color 0.15s; text-decoration: none; }
        .nav-link:hover { color: #F05A28; border-color: #F05A28; }
        .dropdown-item { display: block; padding: 9px 18px; font-size: 0.87rem; color: #1e3a5f; text-decoration: none; transition: background 0.12s; }
        .dropdown-item:hover { background: #fff8f5; color: #F05A28; }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════════════════
     TOPO — barra laranja fina + navbar branca
     ═══════════════════════════════════════════════════════ --}}
<div style="background:#F05A28;height:4px;"></div>

<header style="background:#fff;border-bottom:1px solid #e8eaf0;position:sticky;top:0;z-index:100;box-shadow:0 1px 8px rgba(30,58,95,0.06);">
<div style="max-width:1100px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:62px;">

    {{-- Logo --}}
    <a href="{{ route('portal.dashboard') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;flex-shrink:0;">
        <img src="/images/logo.png" alt="ISP-Bié" style="width:36px;height:36px;object-fit:contain;" onerror="this.style.display='none'">
        <div>
            <div style="font-size:0.82rem;font-weight:800;color:#1e3a5f;letter-spacing:0.01em;line-height:1.1;">ISP-BIÉ</div>
            <div style="font-size:0.68rem;font-weight:600;color:#F05A28;letter-spacing:0.08em;text-transform:uppercase;">Portal Alumni</div>
        </div>
    </a>

    {{-- Nav — Desktop --}}
    <nav style="display:flex;align-items:center;gap:28px;" class="hidden-mobile">
        <a href="{{ route('portal.dashboard') }}"
           class="nav-link {{ request()->routeIs('portal.dashboard') ? 'nav-link-active' : '' }}">
            Início
        </a>
        <a href="{{ route('portal.noticias') }}"
           class="nav-link {{ request()->routeIs('portal.noticias*') ? 'nav-link-active' : '' }}">
            Notícias
        </a>
        <a href="{{ route('portal.diretorio') }}"
           class="nav-link {{ request()->routeIs('portal.diretorio') ? 'nav-link-active' : '' }}">
            Directório
        </a>
        <a href="{{ route('portal.documentos') }}"
           class="nav-link {{ request()->routeIs('portal.documentos*') ? 'nav-link-active' : '' }}">
            Documentos
        </a>
    </nav>

    {{-- User avatar + dropdown --}}
    <div style="position:relative;display:flex;align-items:center;gap:12px;" id="userDropdownWrap">
        {{-- Site público --}}
        <a href="{{ route('welcome') }}"
           style="font-size:0.78rem;color:#6b7280;text-decoration:none;font-weight:500;white-space:nowrap;"
           class="hidden-mobile">
            ← Site ISP-Bié
        </a>

        <button onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                style="display:flex;align-items:center;gap:8px;background:none;border:none;cursor:pointer;padding:4px 8px 4px 4px;border-radius:40px;transition:background 0.15s;"
                onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='none'">
            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#1e3a5f,#F05A28);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.95rem;flex-shrink:0;">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <span style="font-size:0.85rem;font-weight:600;color:#1e3a5f;max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" class="hidden-mobile">
                {{ explode(' ', Auth::user()->name ?? 'Alumni')[0] }}
            </span>
            <svg width="14" height="14" fill="none" stroke="#6b7280" stroke-width="2" viewBox="0 0 24 24" class="hidden-mobile"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </button>

        <div id="userDropdown" class="hidden"
             style="position:absolute;top:calc(100% + 8px);right:0;background:#fff;border-radius:12px;box-shadow:0 8px 32px rgba(30,58,95,0.14);border:1px solid #e8eaf0;min-width:200px;overflow:hidden;z-index:200;">
            <div style="padding:14px 18px 10px;border-bottom:1px solid #f0f1f5;">
                <div style="font-size:0.85rem;font-weight:700;color:#1e3a5f;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->name ?? '' }}</div>
                <div style="font-size:0.74rem;color:#9ca3af;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->email ?? '' }}</div>
            </div>
            <a href="{{ route('portal.perfil') }}" class="dropdown-item" style="border-bottom:1px solid #f5f6fa;">
                <span style="display:flex;align-items:center;gap:8px;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c0-4 3.6-6 8-6s8 2 8 6"/></svg>
                    Meu Perfil
                </span>
            </a>
            <a href="{{ route('portal.diretorio') }}" class="dropdown-item" style="border-bottom:1px solid #f5f6fa;">
                <span style="display:flex;align-items:center;gap:8px;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Directório Alumni
                </span>
            </a>
            <form method="POST" action="{{ route('portal.logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="dropdown-item" style="width:100%;text-align:left;border:none;background:none;cursor:pointer;color:#dc2626;font-weight:600;">
                    <span style="display:flex;align-items:center;gap:8px;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Sair
                    </span>
                </button>
            </form>
        </div>
    </div>

    {{-- Hamburguer mobile --}}
    <button id="mobileNavToggle" onclick="document.getElementById('mobileNav').classList.toggle('hidden')"
            style="display:none;background:none;border:none;cursor:pointer;padding:6px;"
            class="show-mobile">
        <svg width="22" height="22" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

</div>
</header>

{{-- Mobile nav --}}
<div id="mobileNav" class="hidden" style="background:#fff;border-bottom:2px solid #F05A28;padding:12px 24px 16px;">
    <a href="{{ route('portal.dashboard') }}" style="display:block;padding:10px 0;font-weight:600;color:#1e3a5f;text-decoration:none;border-bottom:1px solid #f0f1f5;">Início</a>
    <a href="{{ route('portal.noticias') }}"  style="display:block;padding:10px 0;font-weight:600;color:#1e3a5f;text-decoration:none;border-bottom:1px solid #f0f1f5;">Notícias</a>
    <a href="{{ route('portal.diretorio') }}" style="display:block;padding:10px 0;font-weight:600;color:#1e3a5f;text-decoration:none;border-bottom:1px solid #f0f1f5;">Directório</a>
    <a href="{{ route('portal.documentos') }}" style="display:block;padding:10px 0;font-weight:600;color:#1e3a5f;text-decoration:none;border-bottom:1px solid #f0f1f5;">Documentos</a>
    <a href="{{ route('portal.perfil') }}"    style="display:block;padding:10px 0;font-weight:600;color:#1e3a5f;text-decoration:none;border-bottom:1px solid #f0f1f5;">Meu Perfil</a>
    <form method="POST" action="{{ route('portal.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" style="background:none;border:none;padding:10px 0;font-size:0.9rem;font-weight:600;color:#dc2626;cursor:pointer;">Sair</button>
    </form>
</div>

{{-- ═══════════════════════════════════════════════════════
     CONTEÚDO
     ═══════════════════════════════════════════════════════ --}}
<main style="max-width:1100px;margin:0 auto;padding:36px 24px 64px;">
    @if(session('success'))
        <div style="background:#ecfdf5;border:1px solid #6ee7b7;color:#065f46;padding:12px 18px;border-radius:10px;margin-bottom:24px;font-size:0.88rem;font-weight:500;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fef2f2;border:1px solid #fca5a5;color:#991b1b;padding:12px 18px;border-radius:10px;margin-bottom:24px;font-size:0.88rem;font-weight:500;">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

{{-- ═══════════════════════════════════════════════════════
     RODAPÉ
     ═══════════════════════════════════════════════════════ --}}
<footer style="background:#1e3a5f;color:rgba(255,255,255,0.6);text-align:center;padding:20px;font-size:0.78rem;">
    <span style="color:#F05A28;font-weight:700;">ISP-Bié</span> Portal Alumni &mdash; Exclusivo para ex-estudantes
    &nbsp;·&nbsp;
    <a href="{{ route('welcome') }}" style="color:rgba(255,255,255,0.5);text-decoration:none;">Voltar ao site</a>
</footer>

<style>
    @media (max-width: 768px) {
        .hidden-mobile { display: none !important; }
        .show-mobile { display: block !important; }
    }
    @media (min-width: 769px) {
        .show-mobile { display: none !important; }
    }
</style>

<script>
    // Fechar dropdown ao clicar fora
    document.addEventListener('click', function(e) {
        var wrap = document.getElementById('userDropdownWrap');
        var dd   = document.getElementById('userDropdown');
        if (dd && wrap && !wrap.contains(e.target)) {
            dd.classList.add('hidden');
        }
    });
</script>
</body>
</html>
