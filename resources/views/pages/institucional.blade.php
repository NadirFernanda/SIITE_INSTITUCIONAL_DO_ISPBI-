@extends('layouts.site')


@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
    <nav class="text-sm opacity-75 mb-8">
    <a href="/" class="hover:underline">Início</a> \ Institucional
    </nav>

    <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
      <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Institucional</h1>
      <p class="text-lg text-gray-700">Conheça o Instituto Superior Politécnico do Bié e a sua trajectória institucional</p>
    </div>

    <h2 class="text-3xl font-bold text-[#2563eb] mb-10">História</h2>
    <div class="relative max-w-4xl mx-auto scroll-reveal">
      @php
        $eventos = [
          [
            'ano' => '2007',
            'titulo' => 'Comissões Instaladoras',
            'descricao' => 'O governo da província do Bié cria as comissões instaladoras para instalação do Ensino Superior, dispensando as instalações da Escola média de Agronomia coordenada pela República Checa na rua Padre Fidalgo; na sequência é beneficiada com equipamento de laboratório de ensino de enfermagem.',
            'cor' => 'from-[#2563eb] to-[#3B82F6]'
          ],
          [
            'ano' => '2008',
            'titulo' => 'Cessão do Edifício UNTA',
            'descricao' => 'É cedido ao Ensino Superior o edifício da UNTA Confederação sindical localizada da avenida Joaquim Kapango, o qual pertencia à coordenação da extensão do ISCED-Huambo ministrando os Cursos de Matemática e Psicologia, gerida pelo orçamento da Escola Superior de Ciência e Tecnologia.',
            'cor' => 'from-[#2563eb] to-[#3B82F6]'
          ],
          [
            'ano' => '2009',
            'titulo' => 'Criação da Escola Superior Politécnica',
            'descricao' => 'Sob decreto presidencial é criada a Escola Superior Politécnica do Bié adstrita à Universidade José Eduardo dos Santos (UJES), enquadrada na 5ª Região Académica, integrando as províncias do Huambo, Bié e Moxico, com sede na Província do Huambo. No mesmo ano toma posse a Direção da instituição e das demais Unidades orgânicas. Chega o primeiro contingente de 6 professores cubanos para o curso de enfermagem, iniciando as atividades letivas em 18 de maio com 80 estudantes.',
            'cor' => 'from-[#3B82F6] to-[#2563eb]'
          ],
          [
            'ano' => '2010',
            'titulo' => 'Novos Espaços e Concurso Público',
            'descricao' => 'O Governo da província dispensa o edifício onde funcionava a Escola Dr. António Agostinho Neto “Manguxi” e a Escola Média Comercial e Industrial. É aberto o primeiro concurso público de docentes, integrando profissionais de outras unidades orgânicas.',
            'cor' => 'from-[#2563eb] to-[#3B82F6]'
          ],
          [
            'ano' => '2011',
            'titulo' => 'Curso de Contabilidade e Administração',
            'descricao' => 'Criado o curso de Contabilidade e Administração em parceria com a Faculdade de Economia da UJES, contando com mais 3 docentes cubanos.',
            'cor' => 'from-[#2563eb] to-[#3B82F6]'
          ],
          [
            'ano' => '2012',
            'titulo' => 'Ensino Pós-Laboral',
            'descricao' => 'Abertura da modalidade de ensino pós-laboral com docentes nacionais e expatriados, inicialmente no curso de Contabilidade e Administração, expandindo para Comunicação Social e Psicologia.',
            'cor' => 'from-[#2563eb] to-[#3B82F6]'
          ],
          [
            'ano' => '2013+',
            'titulo' => 'Engenharia em Recursos Hídricos',
            'descricao' => 'Curso criado por iniciativa da Reitoria da UJES em convênio com a Universidade Nacional do Litoral (UNL), Argentina. Seis docentes enviados para pós-graduação profissionalizante de 2 anos.',
            'cor' => 'from-[#3B82F6] to-[#2563eb]'
          ],
          [
            'ano' => '29 OUTUBRO 2020',
            'titulo' => 'Instituto Superior Politécnico do Bié',
            'descricao' => '<span class="text-xl mb-6 opacity-95">Criado pelo <strong>Decreto Presidencial nº 285/20</strong></span><br><span class="text-lg max-w-3xl ml-auto opacity-90">O ISP-Bié surge como instituição autónoma de ensino superior, consolidando mais de uma década de história de formação académica na província do Bié, com o compromisso de formar profissionais altamente qualificados para o desenvolvimento sustentável da região e do país.</span>',
            'cor' => 'from-[#2563eb] via-[#3B82F6] to-[#2563eb]'
          ],
        ];
      @endphp
      <div class="relative space-y-16">
        <!-- Linha vertical central -->
        <div class="hidden md:block absolute left-1/2 top-0 h-full w-1 -translate-x-1/2 bg-gray-200 z-0"></div>
        @foreach($eventos as $index => $evento)
          @if($loop->last)
            <!-- Último card: destaque igual à imagem, largura aumentada -->
            <div class="flex justify-center items-center w-full relative z-10">
              <div class="w-full max-w-6xl bg-gradient-to-r from-[#2563eb] to-[#3B82F6] rounded-3xl shadow-2xl p-8 md:p-16 text-white text-center flex flex-col items-center">
                <div class="inline-block bg-white text-[#2563eb] px-10 py-4 rounded-full font-bold text-2xl md:text-3xl mb-8 shadow">{!! $evento['ano'] !!}</div>
                <h3 class="text-4xl md:text-5xl font-extrabold mb-6">{!! $evento['titulo'] !!}</h3>
                <div class="text-xl md:text-2xl font-medium mb-4">{!! $evento['descricao'] !!}</div>
              </div>
            </div>
          @else
            <div class="flex w-full relative z-10 {{ $index % 2 == 0 ? 'justify-start' : 'justify-end' }}">
              <div class="w-full md:w-1/2 p-4 {{ $index % 2 == 0 ? 'text-left' : 'text-right' }} relative">
                <!-- Linha vertical central dentro do card -->
                <div class="hidden md:block absolute left-1/2 top-0 h-full w-1 -translate-x-1/2 bg-gray-200 z-0"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg relative z-10">
                  <div class="inline-block bg-gradient-to-r {{ $evento['cor'] }} text-white px-4 py-2 rounded-full font-bold mb-4">{!! $evento['ano'] !!}</div>
                  <h3 class="text-xl font-bold text-[#2563eb] mb-3">{!! $evento['titulo'] !!}</h3>
                  <p class="text-gray-700 leading-relaxed text-sm">{!! $evento['descricao'] !!}</p>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Apresentação -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Sobre o ISP-Bié</h2>
          <p class="text-lg text-gray-700 leading-relaxed mb-4">
            O <strong>Instituto Superior Politécnico do Bié</strong> foi criado pelo 
            <strong>Decreto Presidencial n.º 285/20, de 29 de outubro de 2020</strong>, 
            com o objetivo de formar profissionais altamente qualificados para responder 
            às necessidades de desenvolvimento da região e do país.
          </p>
          <p class="text-lg text-gray-700 leading-relaxed mb-4">
            Como instituição de ensino superior de excelência, o ISP-Bié dedica-se à 
            formação integral de profissionais capacitados, à promoção da investigação científica 
            e à extensão universitária, que contribuem para o desenvolvimento sustentável da 
            província do Bié e de Angola.
          </p>
          <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] p-6 rounded-lg text-white mt-6">
            <p class="font-semibold mb-2">📋 NIF: 5000308765</p>
            <p class="text-sm opacity-90">Instituição de Ensino Superior regulamentada pelo MESCTI</p>
          </div>
        </div>
        <div>
          <div class="bg-gradient-to-br from-[#2563eb] to-[#2563eb] p-8 rounded-2xl text-white shadow-xl interactive-card">
            <h3 class="text-2xl font-bold mb-6">Em Números</h3>
            <div class="space-y-4">
              <div class="flex items-center justify-between border-b border-white/20 pb-3">
                <span class="text-lg">Cursos de Graduação</span>
                <span class="text-3xl font-bold">6</span>
              </div>
              <div class="flex items-center justify-between border-b border-white/20 pb-3">
                <span class="text-lg">Vagas por Curso</span>
                <span class="text-3xl font-bold">Variável</span>
              </div>
              <div class="flex items-center justify-between border-b border-white/20 pb-3">
                <span class="text-lg">Órgãos de gestão</span>
                <span class="text-3xl font-bold">2</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-lg">Ano de Fundação</span>
                <span class="text-3xl font-bold">2020</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pilares Institucionais -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-[#2563eb] mb-12">Pilares Institucionais</h2>
      
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Missão -->
        <a href="/missao" class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-all group interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#3B82F6] to-[#2563eb] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#2563eb] mb-3 group-hover:text-[#2563eb] transition-colors">Missão</h3>
          <p class="text-gray-600">
            Desenvolver actividades de formação académica e profissional de excelência, da investigação científica e da extensão universitária nas áreas de Engenharias, Tecnologias, Ciências Sociais, Administração e Negócios.
          </p>
        </a>

        <!-- Visão -->
        <a href="/visao" class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-all group interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#2563eb] mb-3 group-hover:text-[#2563eb] transition-colors">Visão</h3>
          <p class="text-gray-600">
            Em 10 anos, o Instituto Superior Politécnico do Bié deverá ser reconhecido como uma instituição de referência e excelência na formação académica, produção científica e resolução de problemas sociais na província do Bié.
          </p>
        </a>

        <!-- Valores -->
        <a href="/valores" class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-all group interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#2563eb] mb-3 group-hover:text-[#2563eb] transition-colors">Valores</h3>
          <ul class="text-gray-600 list-disc pl-6 space-y-1 text-sm">
            <li>Respeito ao Próximo e à Vida Humana</li>
            <li>Honestidade e Transparência</li>
            <li>Respeito pelas Diferenças</li>
            <li>Solidariedade</li>
            <li>Amor à Pátria, à Instituição e à Extensão Universitária</li>
            <li>Comprometimento com a Excelência</li>
          </ul>
        </a>
      </div>
    </div>
  </section>

  <!-- Áreas de Atuação -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-[#2563eb] mb-12">Áreas de Atuação</h2>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <a href="/cursos" class="group">
          <div class="bg-gradient-to-br from-[#3B82F6] to-[#2563eb] p-6 rounded-lg text-white hover:shadow-xl transition-all h-full min-h-[240px] flex flex-col justify-between interactive-card">
            <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
            </svg>
            <h3 class="text-xl font-bold mb-2">Ensino</h3>
            <p class="text-sm opacity-90">6 cursos de graduação com 40 vagas cada</p>
          </div>
        </a>

        <a href="/investigacao" class="group">
          <div class="bg-gradient-to-br from-[#2563eb] to-[#2979FF] p-6 rounded-lg text-white hover:shadow-xl transition-all h-full min-h-[240px] flex flex-col justify-between interactive-card">
            <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.758a1 1 0 01-.293.707l-4 4C.817 14.769 2.156 18 4.828 18h10.343c2.673 0 4.012-3.231 2.122-5.121l-4-4A1 1 0 0113 8.172V4.414l.707-.707A1 1 0 0013 2H7zm2 6.172V4h2v4.172a3 3 0 00.879 2.12l1.027 1.028a4 4 0 00-2.171.102l-.47.156a4 4 0 01-2.53 0l-.563-.187a1.993 1.993 0 00-.114-.035l1.063-1.063A3 3 0 009 8.172z" clip-rule="evenodd"/>
            </svg>
            <h3 class="text-xl font-bold mb-2">Pesquisa</h3>
            <p class="text-sm opacity-90">Investigação científica e inovação tecnológica</p>
          </div>
        </a>

        <a href="/cultura" class="group">
          <div class="bg-gradient-to-br from-[#3B82F6] to-[#2563eb] p-6 rounded-lg text-white hover:shadow-xl transition-all h-full min-h-[240px] flex flex-col justify-between interactive-card">
            <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
              <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
            </svg>
            <h3 class="text-xl font-bold mb-2">Cultura</h3>
            <p class="text-sm opacity-90">Extensão e integração com a comunidade</p>
          </div>
        </a>

        <a href="/inclusao" class="group">
          <div class="bg-gradient-to-br from-[#3B82F6] to-[#2563eb] p-6 rounded-lg text-white hover:shadow-xl transition-all h-full min-h-[240px] flex flex-col justify-between interactive-card">
            <svg class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
              <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
            </svg>
            <h3 class="text-xl font-bold mb-2">Inclusão</h3>
            <p class="text-sm opacity-90">Diversidade, equidade e acessibilidade</p>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- Governança -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-[#2563eb] mb-12">Estrutura Institucional</h2>
      
      <div class="grid md:grid-cols-2 gap-8 mb-8">
        
        <a href="/presidencia" class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-all group">
          <div class="flex items-start">
            <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg flex items-center justify-center mr-4 flex-shrink-0 group-hover:scale-110 transition-transform">
              <!-- Ícone de pessoa -->
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-[#2563eb] mb-2 group-hover:text-[#2563eb] transition-colors">Órgãos de gestão</h3>
              <p class="text-gray-600 mb-3">Órgão executivo máximo do Instituto</p>
              <ul class="text-sm text-gray-500 space-y-1">
                <li>• Presidente</li>
                <li>• Gabinete do Presidente</li>
                <li>• 2 Vice-Órgãos de gestão</li>
              </ul>
            </div>
          </div>
        </a>

        <a href="/gestao" class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-all group">
          <div class="flex items-start">
            <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg flex items-center justify-center mr-4 flex-shrink-0 group-hover:scale-110 transition-transform">
              <!-- Ícone de prédio -->
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 19V6a1 1 0 01.553-.894l7-3.5a1 1 0 01.894 0l7 3.5A1 1 0 0120 6v13a1 1 0 01-1 1h-5a1 1 0 01-1-1v-4H8v4a1 1 0 01-1 1H2a1 1 0 01-1-1zM5 18v-2a1 1 0 011-1h2a1 1 0 011 1v2h2v-4a1 1 0 011-1h2a1 1 0 011 1v4h2V7.382l-6-3-6 3V18h2z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-[#2563eb] mb-2 group-hover:text-[#2563eb] transition-colors">Gestão e Governança</h3>
              <p class="text-gray-600 mb-3">Órgãos colegiados e executivos</p>
              <ul class="text-sm text-gray-500 space-y-1">
                <li>• Conselho Superior</li>
                <li>• Conselhos Académicos</li>
                <li>• Órgãos de Apoio</li>
              </ul>
            </div>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- Localização -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-[#2563eb] mb-12">Nossa Localização</h2>
      
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-2xl p-8 md:p-12 text-white">
        <div class="grid md:grid-cols-2 gap-8 items-center">
          <div>
            <div class="flex items-start mb-6">
              <svg class="w-8 h-8 mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
              </svg>
              <div>
                <h3 class="text-xl font-bold mb-2">Endereço</h3>
                <p class="text-lg opacity-90">
                  Rua Padre Fidalgo entre Artur de Paiva e<br>
                  Francisco de Leite Cardoso S/N<br>
                  Cidade do Cuito, Bié<br>
                  Angola
                </p>
              </div>
            </div>
            
            <div class="flex items-start mb-6">
              <svg class="w-8 h-8 mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
              </svg>
              <div>
                <h3 class="text-xl font-bold mb-2">Telefone</h3>
                <p class="text-lg opacity-90">(244) 922 408 061</p>
              </div>
            </div>

            <div class="flex items-start">
              <svg class="w-8 h-8 mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
              </svg>
              <div>
                <h3 class="text-xl font-bold mb-2">Email</h3>
                <p class="text-lg opacity-90">geral@isp-bie.ao</p>
              </div>
            </div>
          </div>

          <div class="bg-white/10 backdrop-blur rounded-lg p-6">
            <h3 class="text-xl font-bold mb-4">Horário de Atendimento</h3>
            <div class="space-y-3">
              <div class="flex justify-between items-center border-b border-white/20 pb-2">
                <span>Segunda a Sexta</span>
                <span class="font-semibold">8h00 - 17h00</span>
              </div>
              <div class="flex justify-between items-center">
                <span>Sábado e Domingo</span>
                <span class="font-semibold">Fechado</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-16 bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl font-bold mb-4">Faça Parte do ISP-Bié</h2>
      <p class="text-xl mb-8 opacity-90">
        Junte-se a nós na construção do futuro de Angola através da educação de excelência
      </p>
      <div class="flex flex-wrap gap-4 justify-center">
        <a href="/candidaturas" class="bg-white text-[#2563eb] px-8 py-3 rounded-full font-semibold hover:bg-[#2563eb] hover:text-white transition-colors">
          Candidaturas
        </a>
        <a href="/contactos" class="bg-[#2563eb] text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-[#2563eb] transition-colors">
          Entre em Contacto
        </a>
      </div>
    </div>
  </section>

@endsection

