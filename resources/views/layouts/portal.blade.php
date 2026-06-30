<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Alumni — ISP-Bié</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', 'Arial', sans-serif;
            background: #f0f4f8;
            color: #1a2332;
        }

        /* ── Sidebar ── */
        .portal-sidebar {
            width: 240px;
            background: linear-gradient(180deg, #1e3a5f 0%, #162d4a 100%);
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 18px rgba(30,58,95,0.18);
            z-index: 100;
        }

        .portal-sidebar-brand {
            padding: 24px 24px 8px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .portal-sidebar-brand .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .portal-sidebar-brand .brand-logo img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .portal-sidebar-brand .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .portal-sidebar-brand .brand-sub {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.55);
            margin-top: 2px;
        }

        .portal-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 0;
        }

        .portal-nav-section {
            padding: 4px 16px 2px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.4);
            margin-top: 12px;
        }

        .portal-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 8px;
            margin: 2px 10px;
            transition: background 0.15s, color 0.15s;
        }

        .portal-nav a:hover,
        .portal-nav a.active {
            background: rgba(255,255,255,0.12);
            color: #fff;
        }

        .portal-nav a svg {
            flex-shrink: 0;
            opacity: 0.75;
        }

        .portal-nav a:hover svg,
        .portal-nav a.active svg {
            opacity: 1;
        }

        .portal-sidebar-footer {
            padding: 14px 16px;
            border-top: 1px solid rgba(255,255,255,0.12);
            flex-shrink: 0;
        }

        .portal-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .portal-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.88rem;
            flex-shrink: 0;
        }

        .portal-user-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: #fff;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .portal-user-role {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.5);
        }

        .portal-logout-btn {
            width: 100%;
            background: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.85);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 7px;
            padding: 8px 0;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
        }

        .portal-logout-btn:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        /* ── Top bar ── */
        .portal-topbar {
            margin-left: 240px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .portal-topbar-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e3a5f;
        }

        .portal-topbar-badge {
            background: #1e3a5f;
            color: #fff;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ── Main content ── */
        .portal-main {
            margin-left: 240px;
            padding: 32px;
            min-height: calc(100vh - 57px);
        }

        /* ── Mobile toggle ── */
        .portal-mobile-toggle {
            display: none;
            position: fixed;
            top: 14px;
            left: 14px;
            z-index: 200;
            background: #1e3a5f;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 10px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .portal-mobile-toggle { display: flex; align-items: center; }
            .portal-sidebar {
                transform: translateX(-100%);
                transition: transform 0.25s;
                width: 220px;
            }
            .portal-sidebar.open { transform: translateX(0); }
            .portal-topbar,
            .portal-main { margin-left: 0; }
            .portal-topbar { padding: 14px 16px 14px 60px; }
            .portal-main { padding: 20px 16px; }
        }
    </style>
</head>
<body>

    <button class="portal-mobile-toggle" id="sidebarToggle" aria-label="Abrir menu" onclick="document.querySelector('.portal-sidebar').classList.toggle('open')">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

    <aside class="portal-sidebar" id="portalSidebar">
        <div class="portal-sidebar-brand">
            <a href="{{ route('portal.dashboard') }}" class="brand-logo">
                <img src="/images/logo.png" alt="ISP-Bié" onerror="this.style.display='none'">
                <div>
                    <div class="brand-name">ISP-Bié</div>
                    <div class="brand-sub">Portal Alumni</div>
                </div>
            </a>
        </div>

        <nav class="portal-nav">
            <div class="portal-nav-section">Menu Principal</div>

            <a href="{{ route('portal.dashboard') }}" class="{{ request()->routeIs('portal.dashboard') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('portal.noticias') }}" class="{{ request()->routeIs('portal.noticias*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                    <path stroke-linecap="round" d="M7 9h10M7 13h6"/>
                </svg>
                Noticias
            </a>

            <a href="{{ route('portal.diretorio') }}" class="{{ request()->routeIs('portal.diretorio') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Directorio
            </a>

            <a href="{{ route('portal.documentos') }}" class="{{ request()->routeIs('portal.documentos*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Documentos
            </a>

            <div class="portal-nav-section" style="margin-top:16px;">Conta</div>

            <a href="{{ route('portal.perfil') }}" class="{{ request()->routeIs('portal.perfil*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path stroke-linecap="round" d="M4 20c0-4 3.6-6 8-6s8 2 8 6"/>
                </svg>
                Meu Perfil
            </a>
        </nav>

        <div class="portal-sidebar-footer">
            <div class="portal-user-info">
                <div class="portal-user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <div>
                    <div class="portal-user-name">{{ Auth::user()->name ?? '' }}</div>
                    <div class="portal-user-role">Alumni</div>
                </div>
            </div>
            <form method="POST" action="{{ route('portal.logout') }}">
                @csrf
                <button type="submit" class="portal-logout-btn">Sair</button>
            </form>
        </div>
    </aside>

    <div class="portal-topbar">
        <span class="portal-topbar-title">@yield('page-title', 'Portal Alumni')</span>
        <span class="portal-topbar-badge">Alumni</span>
    </div>

    <main class="portal-main">
        @yield('content')
    </main>

    <script>
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            var sidebar = document.getElementById('portalSidebar');
            var toggle  = document.getElementById('sidebarToggle');
            if (sidebar && sidebar.classList.contains('open')) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });
    </script>
</body>
</html>
