<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', 'Arial', sans-serif;
            background: #f8fafc;
        }
        .sidebar {
            width: 240px;
            background: #1565c0;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 16px rgba(21,101,192,0.10);
            border-radius: 0 18px 18px 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .sidebar h2 {
            margin-left: 24px;
            margin-bottom: 32px;
            font-size: 2em;
            font-weight: 700;
            letter-spacing: 1px;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            font-size: 1.08em;
            border-radius: 10px;
            margin: 2px 14px;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #0d47a1;
            color: #fff;
            box-shadow: 0 2px 8px rgba(21,101,192,0.10);
        }
        .main-content {
            margin-left: 240px;
            padding: 40px 32px;
            background: #f8fafc;
            min-height: calc(100vh - 80px);
        }
        .header {
            background: #1565c0;
            padding: 22px 40px;
            border-bottom: 3px solid #0d47a1;
            margin-left: 240px;
            font-size: 1.5em;
            font-weight: 600;
            color: #fff;
            border-radius: 0 0 18px 18px;
            box-shadow: 0 2px 8px rgba(21,101,192,0.08);
        }
        @media (max-width: 900px) {
            .sidebar {
                width: 100vw;
                height: auto;
                position: relative;
                border-radius: 0;
                box-shadow: none;
                flex-direction: row;
                align-items: center;
                padding: 0;
                gap: 0;
            }
            .sidebar h2 { display: none; }
            .sidebar a {
                font-size: 1em;
                padding: 10px 12px;
                margin: 0 2px;
                border-radius: 0;
            }
            .main-content, .header {
                margin-left: 0;
                padding: 16px;
                border-radius: 0;
            }
            .header {
                background: #1565c0;
                color: #fff;
                border-bottom: 2px solid #0d47a1;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar" style="display:flex;flex-direction:column;height:100vh;">
        <h2>Painel</h2>
        <div style="flex:1 1 auto;display:flex;flex-direction:column;">
            <a href="/admin/noticias">
                <span style="vertical-align:middle;margin-right:8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="2" fill="#fff"/><rect x="6" y="8" width="6" height="2" rx="1" fill="#1565c0"/><rect x="6" y="12" width="12" height="2" rx="1" fill="#1565c0"/></svg>
                </span>Notícias
            </a>
            <a href="/admin/estatisticas">
                <span style="vertical-align:middle;margin-right:8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="3" y="13" width="4" height="8" rx="1" fill="#fff"/><rect x="9" y="9" width="4" height="12" rx="1" fill="#fff"/><rect x="15" y="5" width="4" height="16" rx="1" fill="#fff"/></svg>
                </span>Estatísticas
            </a>
            <a href="/admin/carrossel">
                <span style="vertical-align:middle;margin-right:8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="4" y="7" width="16" height="10" rx="2" stroke="#fff" stroke-width="2" fill="none"/><rect x="7" y="10" width="4" height="4" rx="1" fill="#fff"/><rect x="13" y="10" width="4" height="4" rx="1" fill="#fff"/></svg>
                </span>Carrossel
            </a>
            <a href="/admin/concursos">
                <span style="vertical-align:middle;margin-right:8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M3 11v2a1 1 0 001 1h1v3a1 1 0 001 1h2v-6H5a1 1 0 01-1-1v-2H3z" fill="#fff"/><path d="M21 7.5V16a1 1 0 01-1 1h-2v-9h2a1 1 0 011 0z" fill="#fff"/><path d="M16 8l6-3v2l-6 3V8z" fill="#fff"/></svg>
                </span>Concursos
            </a>
            <a href="/admin/alumni">
                <span style="vertical-align:middle;margin-right:8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M2 7l10-4 10 4-10 4-10-4z" stroke="#fff" stroke-width="2" fill="none"/><path d="M6 10v4c0 2 4 4 6 4s6-2 6-4v-4" stroke="#fff" stroke-width="2" fill="none"/></svg>
                </span>Alumni
            </a>
            <a href="/admin/usuarios">
                <span style="vertical-align:middle;margin-right:8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3" stroke="#fff" stroke-width="2" fill="none"/><path d="M6 19c0-2.2 3-3.5 6-3.5s6 1.3 6 3.5" stroke="#fff" stroke-width="2" fill="none"/></svg>
                </span>Utilizadores
            </a>
            <a href="/admin/configuracoes">
                <span style="vertical-align:middle;margin-right:8px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="4" stroke="#fff" stroke-width="2" fill="none"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                </span>Configurações
            </a>
        </div>
        <div style="margin:18px;margin-top:auto;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%;background:#fff;color:#1565c0;font-weight:700;padding:10px 0;border:none;border-radius:8px;box-shadow:0 1px 4px rgba(21,101,192,0.08);margin-bottom:8px;cursor:pointer;transition:background 0.2s;">Sair</button>
            </form>
        </div>
    </div>
    <div class="header">
        <h2>Instituto Superior Politécnico do Bié</h2>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>
