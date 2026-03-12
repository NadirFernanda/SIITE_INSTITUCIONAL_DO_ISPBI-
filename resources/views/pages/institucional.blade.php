@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Institucional',
    'subtitle'   => 'Conheça o Instituto Superior Politécnico do Bié e a sua trajectória institucional.',
    'breadcrumb' => 'Institucional',
])

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

  <!-- As secções Pilares Institucionais, Áreas de Atuação, Estrutura Institucional, Nossa Localização e CTA foram removidas conforme solicitado -->

</div>
@endsection

