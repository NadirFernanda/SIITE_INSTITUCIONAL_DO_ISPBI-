<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
        <style>
            body {
                margin: 0;
                font-family: 'Segoe UI', 'Arial', sans-serif;
                background: #f8fafc;
            }
            .sidebar {
                width: 240px;
                background: #2C4A5E;
                color: #fff;
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                padding-top: 20px;
                box-shadow: 2px 0 16px rgba(44,74,94,0.08);
                border-radius: 0 16px 16px 0;
            }
            .sidebar h2 {
                margin-left: 20px;
                margin-bottom: 30px;
                font-size: 2em;
                font-weight: 700;
                letter-spacing: 1px;
            }
            .sidebar a {
                color: #fff;
                text-decoration: none;
                display: block;
                padding: 12px 30px;
                font-size: 1.1em;
                border-radius: 8px;
                margin: 2px 12px;
                transition: background 0.2s, color 0.2s;
            }
            .sidebar a:hover, .sidebar a.active {
                background: #F05A28;
                color: #fff;
            }
            .main-content {
                margin-left: 240px;
                padding: 40px;
                background: #f8fafc;
                min-height: calc(100vh - 80px);
                border-radius: 16px;
                box-shadow: 0 2px 16px rgba(44,74,94,0.06);
            }
            .header {
                background: #fff;
                padding: 20px 40px;
                border-bottom: 2px solid #F05A28;
                margin-left: 240px;
                font-size: 1.5em;
                font-weight: 600;
                color: #2C4A5E;
                border-radius: 0 0 16px 16px;
                box-shadow: 0 2px 8px rgba(44,74,94,0.04);
            }
            @media (max-width: 900px) {
                .sidebar {
                    width: 100vw;
                    height: auto;
                    position: relative;
                    border-radius: 0;
                    box-shadow: none;
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    padding: 0;
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
            }
        </style>
        <div class="sidebar">
            <h2>Painel</h2>
            <a href="/admin/paginas">
                <span style="vertical-align:middle;margin-right:8px;">
                    <!-- Icone moderno: Páginas (documento) -->
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="4" y="3" width="16" height="18" rx="4" stroke="#F05A28" stroke-width="2" fill="#fff"/><path d="M8 7h8M8 11h8M8 15h5" stroke="#2C4A5E" stroke-width="2" stroke-linecap="round"/></svg>
                </span>Páginas
            </a>
            <a href="/admin/midia">
                <span style="vertical-align:middle;margin-right:8px;">
                    <!-- Icone moderno: Mídia (imagem) -->
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="3" stroke="#0E8F81" stroke-width="2" fill="#fff"/><circle cx="8" cy="10" r="2" fill="#F05A28"/><path d="M5 17l4-4a2 2 0 0 1 3 0l5 5" stroke="#39C28A" stroke-width="2" stroke-linecap="round"/></svg>
                </span>Mídia
            </a>
            <a href="/admin/carrossel">
                <span style="vertical-align:middle;margin-right:8px;">
                    <!-- Icone moderno: Carrossel (slides) -->
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="4" y="7" width="16" height="10" rx="2" stroke="#39C28A" stroke-width="2" fill="#fff"/><rect x="7" y="10" width="4" height="4" rx="1" fill="#F05A28"/><rect x="13" y="10" width="4" height="4" rx="1" fill="#FFD700"/></svg>
                </span>Carrossel
            </a>
            <a href="/admin/usuarios">
                <span style="vertical-align:middle;margin-right:8px;">
                    <!-- Ícone de usuários: três pessoas -->
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="3" stroke="#2C4A5E" stroke-width="2" fill="#fff"/>
                        <circle cx="5.5" cy="11.5" r="2.5" stroke="#2C4A5E" stroke-width="2" fill="#fff"/>
                        <circle cx="18.5" cy="11.5" r="2.5" stroke="#2C4A5E" stroke-width="2" fill="#fff"/>
                        <path d="M2 20c0-2.5 3-4 5-4s5 1.5 5 4" stroke="#2C4A5E" stroke-width="2" fill="none"/>
                        <path d="M12 20c0-2.5 3-4 5-4s5 1.5 5 4" stroke="#2C4A5E" stroke-width="2" fill="none"/>
                        <path d="M7 20c0-2 2.5-3 5-3s5 1 5 3" stroke="#0E8F81" stroke-width="2" fill="none"/>
                    </svg>
                </span>Usuários
            </a>
            <a href="/admin/configuracoes">
                <span style="vertical-align:middle;margin-right:8px;">
                    <!-- Ícone engrenagem preenchida, círculo azul -->
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path d="M19.4 13.5c.04-.32.1-.65.1-1s-.03-.68-.1-1l1.7-1.33a1 1 0 0 0 .24-1.28l-1.6-2.77a1 1 0 0 0-1.18-.48l-2 .8a7.1 7.1 0 0 0-1.7-.98l-.3-2.1A1 1 0 0 0 13 2h-2a1 1 0 0 0-1 .84l-.3 2.1a7.1 7.1 0 0 0-1.7.98l-2-.8a1 1 0 0 0-1.18.48l-1.6 2.77a1 1 0 0 0 .24 1.28l1.7 1.33c-.07.32-.1.65-.1 1s.03.68.1 1l-1.7 1.33a1 1 0 0 0-.24 1.28l1.6 2.77a1 1 0 0 0 1.18.48l2-.8c.52.38 1.09.71 1.7.98l.3 2.1A1 1 0 0 0 11 22h2a1 1 0 0 0 1-.84l.3-2.1c.61-.27 1.18-.6 1.7-.98l2 .8a1 1 0 0 0 1.18-.48l1.6-2.77a1 1 0 0 0-.24-1.28l-1.7-1.33z" fill="#7B8A99"/>
                            <circle cx="12" cy="12" r="4" fill="#fff"/>
                            <circle cx="12" cy="12" r="2.2" fill="#1565c0"/>
                        </g>
                    </svg>
                </span>Configurações
            </a>
        </div>
    <div class="header">
        <h2>Instituto Superior Politécnico do Bié</h2>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>
<!-- Arquivo removido: layout exclusivo do painel admin. -->
