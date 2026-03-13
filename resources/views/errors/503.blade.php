<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Site em Manutenção — ISP-Bié</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #f8f9fa;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #1e3a5f;
    }
    .top-bar { position: fixed; top: 0; left: 0; right: 0; height: 4px; background: #F05A28; }
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 32px rgba(30,58,95,0.10);
      padding: 48px 40px 40px;
      max-width: 520px;
      width: 90%;
      text-align: center;
      border-top: 4px solid #F05A28;
    }
    .logo-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 32px;
    }
    .logo-wrap img { width: 52px; height: 52px; object-fit: contain; }
    .logo-wrap .name {
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: #1e3a5f;
      text-align: left;
      line-height: 1.3;
      max-width: 180px;
    }
    .icon {
      width: 64px; height: 64px;
      background: #fff5f0;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 24px;
    }
    .icon svg { width: 32px; height: 32px; color: #F05A28; }
    h1 {
      font-size: 22px;
      font-weight: 700;
      color: #1e3a5f;
      margin-bottom: 12px;
    }
    p {
      font-size: 15px;
      color: #4a6480;
      line-height: 1.65;
      margin-bottom: 8px;
    }
    .divider {
      width: 48px; height: 3px;
      background: #F05A28;
      border-radius: 2px;
      margin: 24px auto;
    }
    .contact {
      margin-top: 24px;
      font-size: 13px;
      color: #7a98b4;
    }
    .contact a { color: #F05A28; text-decoration: none; }
    .contact a:hover { text-decoration: underline; }
    footer {
      margin-top: 40px;
      font-size: 12px;
      color: #a0b4c8;
    }
  </style>
</head>
<body>
  <div class="top-bar"></div>

  <div class="card">
    <div class="logo-wrap">
      <img src="/images/logo.png" alt="ISP-Bié" onerror="this.style.display='none'">
      <span class="name">Instituto Superior Politécnico do Bié</span>
    </div>

    <div class="icon">
      <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
      </svg>
    </div>

    <h1>Site em Manutenção</h1>
    <p>Estamos a realizar melhorias para lhe oferecer uma melhor experiência.</p>
    <p>O site estará disponível em breve. Pedimos desculpa pelo inconveniente.</p>

    <div class="divider"></div>

    <p class="contact">
      Para assuntos urgentes, contacte-nos em<br>
      <a href="mailto:info@isp-bie.ao">info@isp-bie.ao</a>
    </p>
  </div>

  <footer>© {{ date('Y') }} Instituto Superior Politécnico do Bié</footer>
</body>
</html>
