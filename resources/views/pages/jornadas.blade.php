@extends('layouts.site')

@section('content')
  <!-- Banner -->
  <section class="relative bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white py-20 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-6">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
        </svg>
        <div>
          <h1 class="text-4xl md:text-5xl font-bold">Jornadas Científicas</h1>
          <p class="text-xl mt-2 opacity-90">Investigação e Produção Científica no ISP-Bié</p>
        </div>
      </div>
      <nav class="text-sm">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Jornadas Científicas</span>
      </nav>
    </div>
  </section>

  <!-- Jornadas em Destaque -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Jornadas Científicas 2026</h2>
        <p class="text-lg text-gray-600 mb-6">
          As Jornadas Científicas do ISP-Bié são eventos anuais que promovem a partilha de conhecimento, 
          investigação e inovação entre estudantes, docentes e investigadores.
        </p>
        <div class="h-1 w-24 bg-purple-600"></div>
      </div>

      <!-- Jornada Principal -->
      <div class="bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg overflow-hidden shadow-2xl mb-12 interactive-card">
        <div class="grid grid-cols-1 lg:grid-cols-2">
          <div class="p-8 lg:p-12 text-white">
            <span class="inline-block bg-white/20 px-4 py-2 rounded-full text-sm font-semibold mb-4">PRINCIPAL</span>
            <h3 class="text-4xl font-bold mb-6">V Jornadas Científicas do ISP-Bié</h3>
            <p class="text-lg mb-6 opacity-90 leading-relaxed">
              Evento anual que reúne a comunidade académica para apresentação de trabalhos de investigação, 
              palestras magistrais, mesas redondas e workshops. Uma oportunidade única de networking e 
              troca de experiências científicas.
            </p>
            <div class="space-y-3 mb-8">
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span class="text-lg">10 a 12 de Abril de 2026</span>
              </div>
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-lg">Campus ISP-Bié, Cuito</span>
              </div>
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
                <span class="text-lg">Aberto a toda comunidade académica</span>
              </div>
            </div>
            <div class="flex space-x-4">
              <a href="/contactos" class="inline-block bg-white text-purple-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Submeter Trabalho
              </a>
              <a href="/candidaturas" class="inline-block bg-white/10 border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white/20 transition-colors">
                Inscrever-se
              </a>
            </div>
          </div>
          <div class="bg-white p-8 lg:p-12">
            <h4 class="text-2xl font-bold text-gray-900 mb-6">Íreas Temáticas</h4>
            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <span class="text-purple-700 font-bold">1</span>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-900">Engenharias</h5>
                  <p class="text-sm text-gray-600">Inovações em engenharia civil, recursos hídricos e tecnologias</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <span class="text-indigo-700 font-bold">2</span>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-900">Ciências da Saúde</h5>
                  <p class="text-sm text-gray-600">Pesquisas em enfermagem, saúde pública e psicologia</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <span class="text-pink-700 font-bold">3</span>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-900">Ciências Sociais e Económicas</h5>
                  <p class="text-sm text-gray-600">Estudos em contabilidade, administração e comunicação</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <span class="text-green-700 font-bold">4</span>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-900">Desenvolvimento Regional</h5>
                  <p class="text-sm text-gray-600">Sustentabilidade, ambiente e desenvolvimento do Bié</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <span class="text-orange-700 font-bold">5</span>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-900">Educação e Pedagogia</h5>
                  <p class="text-sm text-gray-600">Metodologias de ensino e inovação educacional</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Edições Anteriores -->
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Edições Anteriores</h2>
        <div class="h-1 w-24 bg-purple-600 mb-8"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Edição 2025 -->
          <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-purple-600 hover:shadow-xl transition-shadow interactive-card">
            <h4 class="text-xl font-bold text-gray-900 mb-2">IV Jornadas - 2025</h4>
            <p class="text-gray-600 mb-4">Tema: "Inovação e Desenvolvimento Sustentável"</p>
            <div class="space-y-2 text-sm text-gray-500 mb-4">
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“Š</span>
                <span>45 trabalhos apresentados</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>200+ participantes</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸŽ“</span>
                <span>8 palestras magistrais</span>
              </div>
            </div>
            <a href="#" class="text-purple-600 hover:underline font-semibold text-sm">Ver anais â†’</a>
          </div>

          <!-- Edição 2024 -->
          <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-indigo-600 hover:shadow-xl transition-shadow interactive-card">
            <h4 class="text-xl font-bold text-gray-900 mb-2">III Jornadas - 2024</h4>
            <p class="text-gray-600 mb-4">Tema: "Saúde e Bem-Estar no Bié"</p>
            <div class="space-y-2 text-sm text-gray-500 mb-4">
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“Š</span>
                <span>38 trabalhos apresentados</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>180+ participantes</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸŽ“</span>
                <span>6 palestras magistrais</span>
              </div>
            </div>
            <a href="#" class="text-indigo-600 hover:underline font-semibold text-sm">Ver anais â†’</a>
          </div>

          <!-- Edição 2023 -->
          <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-pink-600 hover:shadow-xl transition-shadow interactive-card">
            <h4 class="text-xl font-bold text-gray-900 mb-2">II Jornadas - 2023</h4>
            <p class="text-gray-600 mb-4">Tema: "Engenharia para o Desenvolvimento"</p>
            <div class="space-y-2 text-sm text-gray-500 mb-4">
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“Š</span>
                <span>32 trabalhos apresentados</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>150+ participantes</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸŽ“</span>
                <span>5 palestras magistrais</span>
              </div>
            </div>
            <a href="#" class="text-pink-600 hover:underline font-semibold text-sm">Ver anais â†’</a>
          </div>

          <!-- Edição 2022 -->
          <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-600 hover:shadow-xl transition-shadow interactive-card">
            <h4 class="text-xl font-bold text-gray-900 mb-2">I Jornadas - 2022</h4>
            <p class="text-gray-600 mb-4">Tema: "Pesquisa e Inovação no ISP-Bié"</p>
            <div class="space-y-2 text-sm text-gray-500 mb-4">
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“Š</span>
                <span>28 trabalhos apresentados</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>120+ participantes</span>
              </div>
              <div class="flex items-center">
                <span class="font-semibold mr-2">ðŸŽ“</span>
                <span>4 palestras magistrais</span>
              </div>
            </div>
            <a href="#" class="text-green-600 hover:underline font-semibold text-sm">Ver anais â†’</a>
          </div>
        </div>
      </div>

      <!-- Outras Jornadas Temáticas -->
      <div class="mb-12 scroll-reveal">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Jornadas Temáticas</h2>
        <div class="h-1 w-24 bg-purple-600 mb-8"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Jornada 1 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="h-48 bg-gradient-to-br from-teal-500 to-cyan-600"></div>
            <div class="p-6">
              <span class="inline-block bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-xs font-semibold mb-3">ENGENHARIA</span>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Jornadas de Engenharia e Infraestrutura</h4>
              <p class="text-gray-600 mb-4">
                Foco em soluções de engenharia civil, recursos hídricos e desenvolvimento de infraestruturas na província.
              </p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center justify-between">
                  <span>ðŸ“… Maio 2026</span>
                  <span>ðŸŽ¯ 2 dias</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Jornada 2 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
            <div class="h-48 bg-gradient-to-br from-red-500 to-pink-600"></div>
            <div class="p-6">
              <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold mb-3">SAÊDE</span>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Jornadas de Saúde Pública</h4>
              <p class="text-gray-600 mb-4">
                Partilha de investigações em enfermagem, psicologia e desafios de saúde na comunidade do Bié.
              </p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center justify-between">
                  <span>ðŸ“… Junho 2026</span>
                  <span>ðŸŽ¯ 1 dia</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Jornada 3 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-blue-500 to-indigo-600"></div>
            <div class="p-6">
              <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold mb-3">GESTÍO</span>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Jornadas de Contabilidade e Gestão</h4>
              <p class="text-gray-600 mb-4">
                Discussão sobre práticas contabilísticas, gestão empresarial e desenvolvimento económico regional.
              </p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center justify-between">
                  <span>ðŸ“… Setembro 2026</span>
                  <span>ðŸŽ¯ 2 dias</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Jornada 4 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-amber-500 to-orange-600"></div>
            <div class="p-6">
              <span class="inline-block bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-semibold mb-3">COMUNICAÇÍO</span>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Jornadas de Comunicação e Media</h4>
              <p class="text-gray-600 mb-4">
                Exploração de tendências em jornalismo, relações públicas e comunicação digital em Angola.
              </p>
              <div class="border-t pt-4 space-y-2 text-sm text-gray-500">
                <div class="flex items-center justify-between">
                  <span>ðŸ“… Outubro 2026</span>
                  <span>ðŸŽ¯ 1 dia</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Benefícios -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] rounded-lg p-8 text-white mb-12">
        <h3 class="text-2xl font-bold mb-6">Porquê Participar nas Jornadas Científicas?</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="text-center">
            <div class="text-4xl mb-3">ðŸŽ“</div>
            <h4 class="font-bold mb-2">Desenvolvimento Académico</h4>
            <p class="text-sm opacity-90">Aprofunde conhecimentos e partilhe investigação</p>
          </div>
          <div class="text-center">
            <div class="text-4xl mb-3">ðŸ¤</div>
            <h4 class="font-bold mb-2">Networking</h4>
            <p class="text-sm opacity-90">Conecte-se com investigadores e profissionais</p>
          </div>
          <div class="text-center">
            <div class="text-4xl mb-3">ðŸ“œ</div>
            <h4 class="font-bold mb-2">Certificados</h4>
            <p class="text-sm opacity-90">Obtenha certificado de participação e publicação</p>
          </div>
          <div class="text-center">
            <div class="text-4xl mb-3">ðŸ†</div>
            <h4 class="font-bold mb-2">Reconhecimento</h4>
            <p class="text-sm opacity-90">Prémios para os melhores trabalhos apresentados</p>
          </div>
        </div>
      </div>

      <!-- CTA -->
      <div class="bg-gray-50 rounded-lg p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tem alguma dúvida sobre as Jornadas?</h3>
        <p class="mb-6 text-lg text-gray-600">
          Entre em contacto com a Coordenação de Pesquisa e Inovação do ISP-Bié.
        </p>
        <div class="flex justify-center space-x-4">
          <a href="/contactos" class="inline-block bg-purple-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-800 transition-colors">
            Contactar-nos
          </a>
          <a href="/investigacao" class="inline-block bg-white border-2 border-purple-700 text-purple-700 px-8 py-3 rounded-lg font-semibold hover:bg-purple-50 transition-colors">
            Pesquisa no ISP-Bié
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection

