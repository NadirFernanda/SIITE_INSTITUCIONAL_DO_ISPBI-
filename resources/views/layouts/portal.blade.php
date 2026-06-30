<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Portal Alumni') — ISP-Bié</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, Arial, sans-serif;
            background: #f4f6fb;
            color: #1a2332;
            min-height: 100vh;
        }

        /* ── Accent strip ── */
        .p-accent { height: 4px; background: linear-gradient(90deg, #F05A28, #e84417); }

        /* ── Navbar ── */
        .p-nav {
            background: #fff;
            border-bottom: 1px solid #e8eaf0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(30,58,95,0.07);
        }
        .p-nav-inner {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            gap: 16px;
        }
        .p-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .p-brand img { width: 38px; height: 38px; object-fit: contain; }
        .p-brand-name { font-size: 0.9rem; font-weight: 800; color: #1e3a5f; line-height: 1.1; }
        .p-brand-sub  { font-size: 0.65rem; font-weight: 700; color: #F05A28; letter-spacing: 0.1em; text-transform: uppercase; }

        /* Desktop nav links */
        .p-nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: center;
        }
        .p-nav-link {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b5563;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
        }
        .p-nav-link:hover { background: #f4f6fb; color: #1e3a5f; }
        .p-nav-link.active { background: #fff4f0; color: #F05A28; }

        /* User area */
        .p-nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }
        .p-site-link {
            font-size: 0.78rem;
            color: #9ca3af;
            text-decoration: none;
            font-weight: 500;
            white-space: nowrap;
            transition: color 0.15s;
        }
        .p-site-link:hover { color: #F05A28; }

        /* Avatar button */
        .p-avatar-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 10px 4px 4px;
            border-radius: 40px;
            border: 1px solid #e8eaf0;
            transition: background 0.15s, border-color 0.15s;
        }
        .p-avatar-btn:hover { background: #f4f6fb; border-color: #d1d5db; }
        .p-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1e3a5f 0%, #F05A28 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        .p-avatar-name {
            font-size: 0.83rem;
            font-weight: 600;
            color: #1e3a5f;
            max-width: 110px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .p-chevron { color: #9ca3af; }

        /* Dropdown */
        .p-dropdown-wrap { position: relative; }
        .p-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 40px rgba(30,58,95,0.14);
            border: 1px solid #e8eaf0;
            min-width: 210px;
            overflow: hidden;
            z-index: 200;
        }
        .p-dropdown.open { display: block; }
        .p-dropdown-header {
            padding: 14px 18px 12px;
            border-bottom: 1px solid #f0f1f5;
            background: linear-gradient(135deg, #f8faff 0%, #fff4f0 100%);
        }
        .p-dropdown-header .dd-name { font-size: 0.88rem; font-weight: 700; color: #1e3a5f; }
        .p-dropdown-header .dd-email { font-size: 0.74rem; color: #9ca3af; margin-top: 2px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .p-dd-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 18px;
            font-size: 0.86rem;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background 0.12s, color 0.12s;
            border-bottom: 1px solid #f9fafb;
        }
        .p-dd-item:hover { background: #f4f6fb; color: #1e3a5f; }
        .p-dd-item.danger { color: #dc2626; font-weight: 600; border-bottom: none; }
        .p-dd-item.danger:hover { background: #fff5f5; }

        /* Mobile hamburger */
        .p-hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 7px;
            border-radius: 9px;
            color: #1e3a5f;
            transition: background 0.15s;
        }
        .p-hamburger:hover { background: #f4f6fb; }

        /* Mobile overlay */
        .p-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15,31,61,0.45);
            z-index: 300;
            backdrop-filter: blur(2px);
        }
        .p-overlay.open { display: block; }

        /* Mobile drawer */
        .p-drawer {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: min(82vw, 320px);
            background: #fff;
            z-index: 400;
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.28s cubic-bezier(0.4,0,0.2,1);
            box-shadow: -8px 0 40px rgba(30,58,95,0.18);
        }
        .p-drawer.open { transform: translateX(0); }

        /* Drawer header */
        .p-drawer-head {
            padding: 20px 20px 16px;
            background: linear-gradient(135deg, #1e3a5f 0%, #2a5298 100%);
            position: relative;
            flex-shrink: 0;
        }
        .p-drawer-close {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(255,255,255,0.15);
            border: none;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
            transition: background 0.15s;
        }
        .p-drawer-close:hover { background: rgba(255,255,255,0.25); }
        .p-drawer-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 4px;
        }
        .p-drawer-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, #F05A28, #e84417);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            flex-shrink: 0;
            border: 2px solid rgba(255,255,255,0.25);
        }
        .p-drawer-uname { font-size: 0.95rem; font-weight: 700; color: #fff; }
        .p-drawer-uemail { font-size: 0.72rem; color: rgba(255,255,255,0.6); margin-top: 2px; word-break: break-all; }

        /* Drawer nav */
        .p-drawer-nav {
            flex: 1;
            overflow-y: auto;
            padding: 8px 0;
        }
        .p-drawer-section {
            padding: 14px 20px 4px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #9ca3af;
        }
        .p-drawer-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 20px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #374151;
            text-decoration: none;
            transition: background 0.12s, color 0.12s;
            border-left: 3px solid transparent;
        }
        .p-drawer-link:hover { background: #f4f6fb; color: #1e3a5f; border-left-color: #e2e8f0; }
        .p-drawer-link.active { background: #fff4f0; color: #F05A28; border-left-color: #F05A28; }
        .p-drawer-link svg { flex-shrink: 0; color: #9ca3af; }
        .p-drawer-link:hover svg, .p-drawer-link.active svg { color: currentColor; }

        /* Drawer footer */
        .p-drawer-foot {
            border-top: 1px solid #f0f1f5;
            padding: 12px 0 8px;
            flex-shrink: 0;
        }
        .p-drawer-logout {
            display: flex;
            align-items: center;
            gap: 13px;
            width: 100%;
            padding: 13px 20px;
            background: none;
            border: none;
            font-size: 0.9rem;
            font-weight: 600;
            color: #dc2626;
            cursor: pointer;
            text-align: left;
            transition: background 0.12s;
        }
        .p-drawer-logout:hover { background: #fff5f5; }

        /* ── Main content ── */
        .p-main {
            max-width: 1140px;
            margin: 0 auto;
            padding: 36px 28px 72px;
        }

        /* ── Flash messages ── */
        .p-flash-ok  { background: #ecfdf5; border: 1px solid #6ee7b7; color: #065f46; padding: 13px 18px; border-radius: 10px; margin-bottom: 24px; font-size: 0.88rem; font-weight: 500; }
        .p-flash-err { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; padding: 13px 18px; border-radius: 10px; margin-bottom: 24px; font-size: 0.88rem; font-weight: 500; }

        /* ── Footer ── */
        .p-footer {
            background: #1e3a5f;
            text-align: center;
            padding: 20px 24px;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.45);
        }
        .p-footer a { color: rgba(255,255,255,0.45); text-decoration: none; }
        .p-footer a:hover { color: #F05A28; }
        .p-footer strong { color: #F05A28; font-weight: 700; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .p-nav-links, .p-site-link, .p-avatar-name, .p-chevron, .p-dropdown-wrap { display: none; }
            .p-hamburger { display: flex; }
            .p-main { padding: 20px 14px 60px; }
            .p-nav-inner { padding: 0 14px; height: 56px; }
            .p-brand img { width: 32px; height: 32px; }
            .p-brand-name { font-size: 0.82rem; }
        }
    </style>
</head>
<body>

<div class="p-accent"></div>

{{-- ═══ NAVBAR ═══ --}}
<header class="p-nav">
<div class="p-nav-inner">

    <a href="{{ route('portal.dashboard') }}" class="p-brand">
        <img src="/images/logo.png" alt="ISP-Bié" onerror="this.style.display='none'">
        <div>
            <div class="p-brand-name">ISP-BIÉ</div>
            <div class="p-brand-sub">Portal Alumni</div>
        </div>
    </a>

    <nav class="p-nav-links">
        <a href="{{ route('portal.dashboard') }}"  class="p-nav-link {{ request()->routeIs('portal.dashboard')   ? 'active' : '' }}">Início</a>
        <a href="{{ route('portal.noticias') }}"   class="p-nav-link {{ request()->routeIs('portal.noticias*')   ? 'active' : '' }}">Notícias</a>
        <a href="{{ route('portal.diretorio') }}"  class="p-nav-link {{ request()->routeIs('portal.diretorio')   ? 'active' : '' }}">Directório</a>
        <a href="{{ route('portal.documentos') }}" class="p-nav-link {{ request()->routeIs('portal.documentos*') ? 'active' : '' }}">Documentos</a>
    </nav>

    <div class="p-nav-user">
        <a href="{{ route('welcome') }}" class="p-site-link">← Site ISP-Bié</a>

        <div class="p-dropdown-wrap">
            <button class="p-avatar-btn" onclick="toggleDropdown()" type="button">
                <div class="p-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <span class="p-avatar-name">{{ explode(' ', trim(Auth::user()->name ?? 'Alumni'))[0] }}</span>
                <svg class="p-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div class="p-dropdown" id="portalDropdown">
                <div class="p-dropdown-header">
                    <div class="dd-name">{{ Auth::user()->name ?? '' }}</div>
                    <div class="dd-email">{{ Auth::user()->email ?? '' }}</div>
                </div>
                <a href="{{ route('portal.dashboard') }}" class="p-dd-item">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('portal.perfil') }}" class="p-dd-item">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c0-4 3.6-6 8-6s8 2 8 6"/></svg>
                    Meu Perfil
                </a>
                <a href="{{ route('portal.diretorio') }}" class="p-dd-item">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Directório Alumni
                </a>
                <form method="POST" action="{{ route('portal.logout') }}">
                    @csrf
                    <button type="submit" class="p-dd-item danger">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>

    <button class="p-hamburger" onclick="toggleMobileMenu()" type="button" aria-label="Menu">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

</div>
</header>

{{-- Mobile overlay --}}
<div class="p-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

{{-- Mobile drawer --}}
<div class="p-drawer" id="mobileDrawer">

    {{-- Drawer header: user card --}}
    <div class="p-drawer-head">
        <button class="p-drawer-close" onclick="closeMobileMenu()" aria-label="Fechar menu">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="p-drawer-user">
            <div class="p-drawer-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="p-drawer-uname">{{ Auth::user()->name ?? '' }}</div>
                <div class="p-drawer-uemail">{{ Auth::user()->email ?? '' }}</div>
            </div>
        </div>
    </div>

    {{-- Drawer nav --}}
    <nav class="p-drawer-nav">
        <div class="p-drawer-section">Menu</div>

        <a href="{{ route('portal.dashboard') }}" class="p-drawer-link {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
            Início
        </a>
        <a href="{{ route('portal.noticias') }}" class="p-drawer-link {{ request()->routeIs('portal.noticias*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" d="M7 9h10M7 13h6"/></svg>
            Notícias
        </a>
        <a href="{{ route('portal.diretorio') }}" class="p-drawer-link {{ request()->routeIs('portal.diretorio') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Directório
        </a>
        <a href="{{ route('portal.documentos') }}" class="p-drawer-link {{ request()->routeIs('portal.documentos*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            Documentos
        </a>

        <div class="p-drawer-section" style="margin-top:8px;">Conta</div>

        <a href="{{ route('portal.perfil') }}" class="p-drawer-link {{ request()->routeIs('portal.perfil*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c0-4 3.6-6 8-6s8 2 8 6"/></svg>
            Meu Perfil
        </a>
        <a href="{{ route('welcome') }}" class="p-drawer-link" style="color:#9ca3af;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Site ISP-Bié
        </a>
    </nav>

    {{-- Drawer footer: logout --}}
    <div class="p-drawer-foot">
        <form method="POST" action="{{ route('portal.logout') }}">
            @csrf
            <button type="submit" class="p-drawer-logout">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Sair
            </button>
        </form>
    </div>

</div>

{{-- ═══ CONTEÚDO ═══ --}}
<main class="p-main">
    @if(session('success'))
        <div class="p-flash-ok">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="p-flash-err">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

{{-- ═══ FOOTER ═══ --}}
<footer class="p-footer">
    <strong>ISP-Bié</strong> Portal Alumni &mdash; Exclusivo para ex-estudantes
    &nbsp;·&nbsp;
    <a href="{{ route('welcome') }}">Voltar ao site</a>
</footer>

<script>
    function toggleDropdown() {
        document.getElementById('portalDropdown').classList.toggle('open');
    }
    function toggleMobileMenu() {
        document.getElementById('mobileDrawer').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('open');
        document.body.style.overflow = document.getElementById('mobileDrawer').classList.contains('open') ? 'hidden' : '';
    }
    function closeMobileMenu() {
        document.getElementById('mobileDrawer').classList.remove('open');
        document.getElementById('mobileOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('click', function(e) {
        var dd  = document.getElementById('portalDropdown');
        var btn = document.querySelector('.p-avatar-btn');
        if (dd && btn && !btn.contains(e.target) && !dd.contains(e.target)) {
            dd.classList.remove('open');
        }
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeMobileMenu();
    });
</script>
</body>
</html>
