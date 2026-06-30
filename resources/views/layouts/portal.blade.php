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
            padding: 6px;
            border-radius: 8px;
            color: #1e3a5f;
        }
        .p-hamburger:hover { background: #f4f6fb; }

        /* Mobile menu */
        .p-mobile-menu {
            display: none;
            background: #fff;
            border-bottom: 3px solid #F05A28;
            padding: 8px 0 16px;
        }
        .p-mobile-menu.open { display: block; }
        .p-mobile-link {
            display: block;
            padding: 12px 28px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e3a5f;
            text-decoration: none;
            border-bottom: 1px solid #f5f6fa;
            transition: background 0.12s, color 0.12s;
        }
        .p-mobile-link:hover, .p-mobile-link.active { background: #fff4f0; color: #F05A28; }
        .p-mobile-logout {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 12px 28px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #dc2626;
            cursor: pointer;
        }
        .p-mobile-logout:hover { background: #fff5f5; }

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
            .p-nav-links, .p-site-link, .p-avatar-name, .p-chevron { display: none; }
            .p-hamburger { display: flex; }
            .p-main { padding: 24px 16px 60px; }
            .p-nav-inner { padding: 0 16px; }
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

{{-- Mobile menu (hidden by default via CSS) --}}
<div class="p-mobile-menu" id="mobileMenu">
    <a href="{{ route('portal.dashboard') }}"  class="p-mobile-link {{ request()->routeIs('portal.dashboard')   ? 'active' : '' }}">Início</a>
    <a href="{{ route('portal.noticias') }}"   class="p-mobile-link {{ request()->routeIs('portal.noticias*')   ? 'active' : '' }}">Notícias</a>
    <a href="{{ route('portal.diretorio') }}"  class="p-mobile-link {{ request()->routeIs('portal.diretorio')   ? 'active' : '' }}">Directório</a>
    <a href="{{ route('portal.documentos') }}" class="p-mobile-link {{ request()->routeIs('portal.documentos*') ? 'active' : '' }}">Documentos</a>
    <a href="{{ route('portal.perfil') }}"     class="p-mobile-link {{ request()->routeIs('portal.perfil*')     ? 'active' : '' }}">Meu Perfil</a>
    <a href="{{ route('welcome') }}"           class="p-mobile-link" style="color:#9ca3af;">← Site ISP-Bié</a>
    <form method="POST" action="{{ route('portal.logout') }}">
        @csrf
        <button type="submit" class="p-mobile-logout">Sair</button>
    </form>
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
        document.getElementById('mobileMenu').classList.toggle('open');
    }
    document.addEventListener('click', function(e) {
        var dd   = document.getElementById('portalDropdown');
        var btn  = document.querySelector('.p-avatar-btn');
        if (dd && btn && !btn.contains(e.target) && !dd.contains(e.target)) {
            dd.classList.remove('open');
        }
    });
</script>
</body>
</html>
