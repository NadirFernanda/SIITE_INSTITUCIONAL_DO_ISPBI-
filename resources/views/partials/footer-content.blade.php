{{-- ══════════════════════════════════════════════════════════════════
     FOOTER — Instituto Superior Politécnico do Bié
     World-class institutional design  ·  Mobile-first  ·  A11y
════════════════════════════════════════════════════════════════════ --}}
<footer class="relative text-gray-400 overflow-hidden" aria-label="Rodapé institucional">

  {{-- ── Background: campus photo bem visível + overlay escuro em camadas ── --}}
  <div class="absolute inset-0 z-0" aria-hidden="true">
    {{-- Imagem a 45% de opacidade — visível mas sem competir com o texto --}}
    <img src="/images/campus-hero.jpg" alt="" role="presentation"
         class="w-full h-full object-cover object-center" style="opacity:0.45;" loading="lazy">
    {{-- Camada 1: gradiente escuro top→bottom para garantir legibilidade --}}
    <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(9,16,32,0.72) 0%,rgba(9,16,32,0.60) 40%,rgba(9,16,32,0.88) 100%);"></div>
    {{-- Camada 2: vinheta lateral suave --}}
    <div class="absolute inset-0" style="background:radial-gradient(ellipse at center,transparent 40%,rgba(0,0,0,0.55) 100%);"></div>
    {{-- Camada 3: tint azul institucional muito subtil --}}
    <div class="absolute inset-0" style="background:rgba(14,24,50,0.25);mix-blend-mode:multiply;"></div>
  </div>

  {{-- ── Orange identity accent bar ── --}}
  <div class="relative z-10 h-1 w-full" style="background:linear-gradient(90deg,#1e3a8a 0%,#F05A28 40%,#ff8c00 60%,#F05A28 80%,#1e3a8a 100%);" aria-hidden="true"></div>

  <div class="relative z-10">

    {{-- ════════════════════════════════════════════════════════
         ROW 1 — Brand identity + Alert subscription
    ═══════════════════════════════════════════════════════════ --}}
    <div class="border-b" style="border-color:rgba(255,255,255,0.12);background:rgba(0,0,0,0.15);backdrop-filter:blur(2px);">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 lg:gap-12">

          {{-- Brand block --}}
          <div class="flex items-start sm:items-center gap-5">

            {{-- ISP-Bié monogram badge --}}
            <div class="flex-shrink-0 flex flex-col items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-2xl font-black text-white select-none shadow-2xl leading-none"
                 style="background:linear-gradient(135deg,#F05A28 0%,#c93e18 100%);box-shadow:0 10px 36px rgba(240,90,40,0.40);">
              <span style="font-size:1.1rem;letter-spacing:-0.5px;">ISP</span>
              <span style="font-size:0.6rem;letter-spacing:0.5px;opacity:0.9;margin-top:2px;">Bié</span>
            </div>

            <div>
              <h2 class="text-white text-base sm:text-lg font-bold tracking-tight leading-tight">
                Instituto Superior Politécnico do Bié
              </h2>
              <p class="text-gray-300 text-xs mt-1.5 leading-relaxed max-w-xs sm:max-w-sm">
                Formando líderes e profissionais de excelência desde 2020.<br class="hidden sm:block">
                O conhecimento ao serviço de Angola.
              </p>
              <div class="flex flex-wrap items-center gap-2 mt-3">
                <span class="inline-flex items-center gap-1.5 text-xs text-gray-300 rounded-full px-2.5 py-1"
                      style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.18);">
                  <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse flex-shrink-0" aria-hidden="true"></span>
                  Decreto Presidencial nº 285/20 de 29/10/2020
                </span>
                <span class="inline-flex items-center gap-1.5 text-xs text-gray-300 rounded-full px-2.5 py-1"
                      style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.18);">
                  NIF 5000308765
                </span>
              </div>
            </div>
          </div>

          {{-- Subscribe to alerts block --}}
          <div class="lg:max-w-xs xl:max-w-sm w-full">
            <div class="flex items-center gap-2 mb-1">
              <svg class="w-4 h-4 text-[#F05A28] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
              </svg>
              <p class="text-white text-sm font-semibold">Alertas &amp; Novidades</p>
            </div>
            <p class="text-gray-300 text-xs mb-3 leading-relaxed pl-6">
              Receba notificações sobre concursos, candidaturas e eventos do ISP-Bié.
            </p>
            <form action="/alertas/concursos" method="POST" class="flex gap-2">
              @csrf
              <label for="footer-email" class="sr-only">Email para alertas</label>
              <input type="email" id="footer-email" name="email"
                     placeholder="O seu endereço de email..."
                     required autocomplete="email"
                     class="flex-1 min-w-0 text-white text-xs rounded-lg px-3.5 py-2.5 focus:outline-none placeholder-gray-600 transition-all duration-200 bg-white/[0.07] border border-white/[0.13] focus:bg-white/[0.11] focus:border-[#F05A28]">
              <button type="submit"
                      class="flex-shrink-0 inline-flex items-center gap-1.5 px-4 py-2.5 text-white text-xs font-bold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-1 bg-[#F05A28] hover:bg-[#d44d20] hover:-translate-y-[1px]">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Subscrever
              </button>
            </form>
          </div>

        </div>
      </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         ROW 2 — Quick contact strip (hidden on xs)
    ═══════════════════════════════════════════════════════════ --}}
    <div class="hidden sm:block border-b" style="border-color:rgba(255,255,255,0.12);background:rgba(0,0,0,0.25);backdrop-filter:blur(2px);">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5">
        <div class="flex flex-wrap items-center justify-between gap-x-6 gap-y-2">

          <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs text-gray-300">
            <span class="flex items-center gap-2">
              <svg class="w-3.5 h-3.5 text-[#F05A28] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
              </svg>
              Rua Padre Fidalgo S/N, Cuito, Província do Bié — Angola
            </span>
            <a href="tel:+244945027508" class="flex items-center gap-2 hover:text-[#F05A28] transition-colors">
              <svg class="w-3.5 h-3.5 text-[#F05A28] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
              </svg>
              +244 945 027 508
            </a>
            <a href="mailto:geral@isp-bie.ao" class="flex items-center gap-2 hover:text-[#F05A28] transition-colors">
              <svg class="w-3.5 h-3.5 text-[#F05A28] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
              </svg>
              geral@isp-bie.ao
            </a>
          </div>

          <a href="https://wa.me/244945027508" target="_blank" rel="noopener noreferrer"
             class="inline-flex items-center gap-2 text-white text-xs font-bold px-4 py-1.5 rounded-full transition-all duration-200 shadow-lg focus:outline-none focus:ring-2 focus:ring-green-400 bg-[#25D366] hover:bg-[#1da851] hover:-translate-y-[1px]"
             style="box-shadow:0 4px 14px rgba(37,211,102,0.30);"
             aria-label="Contactar via WhatsApp">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.031-.967-.273-.099-.471-.149-.669.15-.198.297-.767.967-.941 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.173.198-.297.298-.495.099-.198.05-.372-.025-.521-.074-.149-.669-1.611-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.571-.01-.198 0-.521.074-.793.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.066 2.875 1.216 3.074.149.198 2.1 3.208 5.077 4.487.711.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            </svg>
            Fale connosco
          </a>

        </div>
      </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         ROW 3 — Navigation columns
    ═══════════════════════════════════════════════════════════ --}}
    <div class="border-b" style="border-color:rgba(255,255,255,0.12);background:rgba(0,0,0,0.20);backdrop-filter:blur(2px);">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
        <nav class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8 sm:gap-6" aria-label="Navegação do rodapé">

          {{-- Educação --}}
          <div>
            <h3 class="text-xs font-bold uppercase tracking-widest mb-4 pb-2.5"
                style="color:#F05A28;border-bottom:1px solid rgba(240,90,40,0.25);"
                id="footer-educacao">
              Educação
            </h3>
            <ul class="space-y-2.5" aria-labelledby="footer-educacao">
              <li><a href="/cursos"           class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Cursos de Graduação</a></li>
              <li><a href="/pos-graduacao"    class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Pós-Graduação</a></li>
              <li><a href="/candidaturas"     class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Como Ingressar</a></li>
              <li><a href="/cursos-online"    class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Cursos Online</a></li>
              <li><a href="/bolsas"           class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Bolsas de Estudo</a></li>
              <li><a href="/concursos"        class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Concursos Públicos</a></li>
            </ul>
          </div>

          {{-- Pesquisa --}}
          <div>
            <h3 class="text-xs font-bold uppercase tracking-widest mb-4 pb-2.5"
                style="color:#F05A28;border-bottom:1px solid rgba(240,90,40,0.25);"
                id="footer-pesquisa">
              Pesquisa
            </h3>
            <ul class="space-y-2.5" aria-labelledby="footer-pesquisa">
              <li><a href="/investigacao"     class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Investigação</a></li>
              <li><a href="/biblioteca"       class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Biblioteca Digital</a></li>
              <li><a href="/repositorio"      class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Repositório Académico</a></li>
              <li><a href="/revista"          class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Revista Científica</a></li>
              <li><a href="/projetos"         class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Projectos de I&amp;D</a></li>
              <li><a href="/busca-biblioteca" class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Catálogo da Biblioteca</a></li>
            </ul>
          </div>

          {{-- Institucional --}}
          <div>
            <h3 class="text-xs font-bold uppercase tracking-widest mb-4 pb-2.5"
                style="color:#F05A28;border-bottom:1px solid rgba(240,90,40,0.25);"
                id="footer-institucional">
              Institucional
            </h3>
            <ul class="space-y-2.5" aria-labelledby="footer-institucional">
              <li><a href="/sobre-ispbie"     class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Sobre o ISP-Bié</a></li>
              <li><a href="/missao"           class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Missão, Visão e Valores</a></li>
              <li><a href="/gestao"           class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Gestão e Governança</a></li>
              <li><a href="/transparencia"    class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Transparência</a></li>
              <li><a href="/noticias"         class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Notícias e Eventos</a></li>
              <li><a href="/#estatisticas"    class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">ISP-Bié em Números</a></li>
            </ul>
          </div>

          {{-- Serviços --}}
          <div>
            <h3 class="text-xs font-bold uppercase tracking-widest mb-4 pb-2.5"
                style="color:#F05A28;border-bottom:1px solid rgba(240,90,40,0.25);"
                id="footer-servicos">
              Serviços
            </h3>
            <ul class="space-y-2.5" aria-labelledby="footer-servicos">
              <li><a href="/resultados"       class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Portal do Estudante</a></li>
              <li><a href="https://ws11.angoweb.net/webmail" target="_blank" rel="noopener noreferrer"
                                              class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed flex items-center gap-1">
                Webmail Institucional
                <svg class="w-2.5 h-2.5 opacity-40 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              </a></li>
              <li><a href="/alumni"           class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Alumni</a></li>
              <li><a href="/servicos"         class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Carta de Serviços</a></li>
              <li><a href="/ouvidoria"        class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Ouvidoria</a></li>
              <li><a href="/contactos"        class="text-xs text-gray-300 hover:text-[#F05A28] transition-colors duration-150 leading-relaxed block">Contactos</a></li>
            </ul>
          </div>

          {{-- Parceiros --}}
          <div class="col-span-2 sm:col-span-1">
            <h3 class="text-xs font-bold uppercase tracking-widest mb-4 pb-2.5"
                style="color:#F05A28;border-bottom:1px solid rgba(240,90,40,0.25);"
                id="footer-parceiros">
              Parceiros
            </h3>
            <ul class="space-y-2" aria-labelledby="footer-parceiros">
              <li class="text-xs text-gray-400 leading-snug">Gabinete Prov. da Educação</li>
              <li class="text-xs text-gray-400 leading-snug">Fundo de Apoio Social (FAS)</li>
              <li class="text-xs text-gray-400 leading-snug">Standard Bank de Angola</li>
              <li class="text-xs text-gray-400 leading-snug">Unitel</li>
              <li class="text-xs text-gray-400 leading-snug">ISP Ndunduma · ISP da Caála</li>
              <li class="text-xs text-gray-400 leading-snug">Hospital Mártires do Cuito</li>
              <li class="text-xs text-gray-400 leading-snug">Centro Materno Infantil do Bié</li>
              <li class="text-xs text-gray-400 leading-snug">Cefejor</li>
              <li><a href="/parcerias" class="text-xs transition-colors duration-150 text-[#F05A28]/65 hover:text-[#F05A28]">+ Ver todas as parcerias →</a></li>
            </ul>
          </div>

        </nav>
      </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         ROW 4 — Bottom bar: copyright · legal · socials
    ═══════════════════════════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        {{-- Left: copyright + legal --}}
        <div class="space-y-1.5">
          <p class="text-xs text-gray-400">
            &copy; 2020&ndash;{{ date('Y') }} Instituto Superior Politécnico do Bié &mdash; Todos os direitos reservados.
          </p>
          <p class="text-xs">
            <a href="/politica-privacidade" class="text-gray-400 hover:text-[#F05A28] transition-colors">Política de Privacidade</a>
            <span class="mx-2 text-gray-500" aria-hidden="true">·</span>
            <a href="/termos"               class="text-gray-400 hover:text-[#F05A28] transition-colors">Termos de Uso</a>
            <span class="mx-2 text-gray-500" aria-hidden="true">·</span>
            <a href="/acessibilidade"       class="text-gray-400 hover:text-[#F05A28] transition-colors">Acessibilidade</a>
          </p>
          <p class="text-xs text-gray-400">
            Desenvolvido por <span class="text-gray-200">Fernanda Gonçalves</span>
            <span class="mx-1.5 text-gray-400" aria-hidden="true">·</span>
            <em class="not-italic text-gray-300">"De Angola com amor"</em>
          </p>
        </div>

        {{-- Right: social icons with brand colours --}}
        <div class="flex items-center gap-1.5" aria-label="Redes sociais do ISP-Bié">

          <a href="https://www.facebook.com/search/top?q=instituto%20superior%20polit%C3%A9cnico%20do%20bi%C3%A9"
             target="_blank" rel="noopener noreferrer"
             class="flex items-center justify-center w-9 h-9 rounded-xl text-gray-500 bg-white/5 border border-white/[0.08] hover:text-white hover:bg-[#1877F2] hover:border-[#1877F2] hover:-translate-y-[3px] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1877F2]"
             aria-label="Facebook do ISP-Bié">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
            </svg>
          </a>

          <a href="https://www.instagram.com/ispbie"
             target="_blank" rel="noopener noreferrer"
             class="flex items-center justify-center w-9 h-9 rounded-xl text-gray-500 bg-white/5 border border-white/[0.08] hover:text-white hover:bg-[#e1306c] hover:border-[#e1306c] hover:-translate-y-[3px] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-pink-500"
             aria-label="Instagram do ISP-Bié">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
            </svg>
          </a>

          <a href="https://www.linkedin.com/company/instituto-superior-polit%C3%A9cnico-do-bi%C3%A9"
             target="_blank" rel="noopener noreferrer"
             class="flex items-center justify-center w-9 h-9 rounded-xl text-gray-500 bg-white/5 border border-white/[0.08] hover:text-white hover:bg-[#0077b5] hover:border-[#0077b5] hover:-translate-y-[3px] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0077b5]"
             aria-label="LinkedIn do ISP-Bié">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
          </a>

          <a href="https://www.youtube.com/@ispbie"
             target="_blank" rel="noopener noreferrer"
             class="flex items-center justify-center w-9 h-9 rounded-xl text-gray-500 bg-white/5 border border-white/[0.08] hover:text-white hover:bg-[#FF0000] hover:border-[#FF0000] hover:-translate-y-[3px] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500"
             aria-label="YouTube do ISP-Bié">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M21.543 6.498C22 8.28 22 12 22 12s0 3.72-.457 5.502c-.254.985-.997 1.76-1.938 2.022C17.896 20 12 20 12 20s-5.893 0-7.605-.476c-.941-.262-1.684-1.037-1.938-2.022C2 15.72 2 12 2 12s0-3.72.457-5.502c.254-.985.997-1.76 1.938-2.022C6.107 4 12 4 12 4s5.896 0 7.605.476c.941.262 1.684 1.037 1.938 2.022zM10 15.5l6-3.5-6-3.5v7z"/>
            </svg>
          </a>

          {{-- WhatsApp (shown on mobile, contact strip is desktop-only) --}}
          <a href="https://wa.me/244945027508"
             target="_blank" rel="noopener noreferrer"
             class="flex sm:hidden items-center justify-center w-9 h-9 rounded-xl text-gray-500 bg-white/5 border border-white/[0.08] hover:text-white hover:bg-[#25D366] hover:border-[#25D366] hover:-translate-y-[3px] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-400"
             aria-label="WhatsApp do ISP-Bié">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.031-.967-.273-.099-.471-.149-.669.15-.198.297-.767.967-.941 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.173.198-.297.298-.495.099-.198.05-.372-.025-.521-.074-.149-.669-1.611-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.571-.01-.198 0-.521.074-.793.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.066 2.875 1.216 3.074.149.198 2.1 3.208 5.077 4.487.711.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            </svg>
          </a>

        </div>
      </div>
    </div>

    {{-- Subtle bottom shimmer line --}}
    <div class="h-px w-full" style="background:linear-gradient(90deg,transparent 0%,rgba(240,90,40,0.35) 50%,transparent 100%);" aria-hidden="true"></div>

  </div>{{-- /relative z-10 --}}

  {{-- ════════════════════════════════════════════════════════
       Back-to-top button — orange gradient, animated
  ═══════════════════════════════════════════════════════════ --}}
  <button x-data @click="window.scrollTo({top:0,behavior:'smooth'})"
          class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-11 h-11 rounded-full text-white shadow-xl transition-all duration-300 hover:scale-[1.12] hover:-translate-y-[3px] hover:shadow-[0_10px_32px_rgba(240,90,40,0.70)] focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2 focus:ring-offset-transparent"
          style="background:linear-gradient(135deg,#F05A28,#c93e18);box-shadow:0 4px 22px rgba(240,90,40,0.55);"
          aria-label="Voltar ao topo da página">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
    </svg>
  </button>

</footer>
