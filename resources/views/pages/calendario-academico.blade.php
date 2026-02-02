@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
      <nav class="text-sm mb-8">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Calendário Académico</span>
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Calendário Académico 2025/2026</h1>
        <p class="text-lg text-gray-700">Planeie o seu ano lectivo</p>
      </div>

  <!-- Download -->
  <section class="py-8 bg-white border-b scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 mb-2">Calendário Académico 2025/2026</h2>
          <p class="text-gray-600">Ano lectivo de Fevereiro de 2025 a Novembro de 2026</p>
        </div>
        <a href="#" class="mt-4 md:mt-0 inline-flex items-center bg-[#2563eb] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#0c7a6e] transition-colors">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
          Download PDF
        </a>
      </div>
    </div>
  </section>

  <!-- Cronograma -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
      <!-- Primeiro Semestre -->
      <div class="bg-white rounded-lg shadow-md p-6 interactive-card">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-lg flex items-center justify-center text-white text-xl font-bold mr-4">
              1º
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Primeiro Semestre</h3>
          </div>

          <div class="space-y-4">
            <div class="border-l-4 border-[#2563eb] pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Matrícula</h4>
                <span class="text-sm text-gray-600">03 - 14 Fev 2025</span>
              </div>
              <p class="text-sm text-gray-600">Renovação de matrícula para veteranos e matrícula de caloiros</p>
            </div>

            <div class="border-l-4 border-blue-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Início das Aulas</h4>
                <span class="text-sm text-gray-600">17 Fev 2025</span>
              </div>
              <p class="text-sm text-gray-600">Primeiro dia de aulas do ano lectivo</p>
            </div>

            <div class="border-l-4 border-yellow-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Semana de Integração</h4>
                <span class="text-sm text-gray-600">17 - 21 Fev 2025</span>
              </div>
              <p class="text-sm text-gray-600">Recepção e integração de caloiros</p>
            </div>

            <div class="border-l-4 border-purple-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Férias da Páscoa</h4>
                <span class="text-sm text-gray-600">14 - 21 Abr 2025</span>
              </div>
              <p class="text-sm text-gray-600">Suspensão de aulas</p>
            </div>

            <div class="border-l-4 border-orange-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Exames 1ª Época</h4>
                <span class="text-sm text-gray-600">23 Jun - 11 Jul 2025</span>
              </div>
              <p class="text-sm text-gray-600">Período de avaliação final</p>
            </div>

            <div class="border-l-4 border-red-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Exames 2ª Época</h4>
                <span class="text-sm text-gray-600">14 - 25 Jul 2025</span>
              </div>
              <p class="text-sm text-gray-600">Recurso e melhoria</p>
            </div>

            <div class="border-l-4 border-green-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Férias Académicas</h4>
                <span class="text-sm text-gray-600">28 Jul - 31 Ago 2025</span>
              </div>
              <p class="text-sm text-gray-600">Recesso entre semestres</p>
            </div>
          </div>
        </div>

        <!-- Segundo Semestre -->
        <div class="bg-white rounded-lg shadow-md p-6 interactive-card">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg flex items-center justify-center text-white text-xl font-bold mr-4">
              2º
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Segundo Semestre</h3>
          </div>

          <div class="space-y-4">
            <div class="border-l-4 border-[#2563eb] pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Início das Aulas</h4>
                <span class="text-sm text-gray-600">01 Set 2025</span>
              </div>
              <p class="text-sm text-gray-600">Primeiro dia de aulas do 2º semestre</p>
            </div>

            <div class="border-l-4 border-blue-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Jornadas Científicas</h4>
                <span class="text-sm text-gray-600">10 - 12 Abr 2026</span>
              </div>
              <p class="text-sm text-gray-600">V Jornadas Científicas do ISP-Bié</p>
            </div>

            <div class="border-l-4 border-green-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Jogos Universitários</h4>
                <span class="text-sm text-gray-600">15 Mar 2026</span>
              </div>
              <p class="text-sm text-gray-600">Competições desportivas inter-cursos</p>
            </div>

            <div class="border-l-4 border-purple-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Fim das Aulas</h4>
                <span class="text-sm text-gray-600">12 Jun 2026</span>
              </div>
              <p class="text-sm text-gray-600">Último dia de aulas regulares</p>
            </div>

            <div class="border-l-4 border-orange-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Exames 1ª Época</h4>
                <span class="text-sm text-gray-600">15 Jun - 03 Jul 2026</span>
              </div>
              <p class="text-sm text-gray-600">Período de avaliação final</p>
            </div>

            <div class="border-l-4 border-red-500 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Exames 2ª Época</h4>
                <span class="text-sm text-gray-600">06 - 17 Jul 2026</span>
              </div>
              <p class="text-sm text-gray-600">Recurso e melhoria</p>
            </div>

            <div class="border-l-4 border-indigo-600 pl-4">
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-900">Defesas de TCC</h4>
                <span class="text-sm text-gray-600">20 Jul - 31 Ago 2026</span>
              </div>
              <p class="text-sm text-gray-600">Apresentação de trabalhos de conclusão</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Feriados Nacionais -->
      <div class="bg-white rounded-lg shadow-md p-6 mt-8 interactive-card">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Feriados Nacionais e Suspensão de Aulas</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div class="flex items-center p-3 bg-red-50 rounded-lg">
            <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center text-white font-bold mr-3">
              04<br><span class="text-xs">FEV</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Início da Luta Armada</h4>
              <p class="text-xs text-gray-600">Feriado Nacional</p>
            </div>
          </div>

          <div class="flex items-center p-3 bg-pink-50 rounded-lg">
            <div class="w-12 h-12 bg-pink-500 rounded-lg flex items-center justify-center text-white font-bold mr-3">
              08<br><span class="text-xs">MAR</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Dia Internacional da Mulher</h4>
              <p class="text-xs text-gray-600">Feriado Nacional</p>
            </div>
          </div>

          <div class="flex items-center p-3 bg-purple-50 rounded-lg">
            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center text-white font-bold mr-3">
              04<br><span class="text-xs">ABR</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Dia da Paz</h4>
              <p class="text-xs text-gray-600">Feriado Nacional</p>
            </div>
          </div>

          <div class="flex items-center p-3 bg-blue-50 rounded-lg">
            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold mr-3">
              01<br><span class="text-xs">MAI</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Dia do Trabalhador</h4>
              <p class="text-xs text-gray-600">Feriado Nacional</p>
            </div>
          </div>

          <div class="flex items-center p-3 bg-green-50 rounded-lg">
            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white font-bold mr-3">
              17<br><span class="text-xs">SET</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Dia do Herói Nacional</h4>
              <p class="text-xs text-gray-600">Feriado Nacional</p>
            </div>
          </div>

          <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
            <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center text-white font-bold mr-3">
              11<br><span class="text-xs">NOV</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Dia da Independência</h4>
              <p class="text-xs text-gray-600">Feriado Nacional</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Observações -->
  <section class="py-12 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h3 class="text-2xl font-bold text-gray-900 mb-6">Observações Importantes</h3>
      <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded">
        <ul class="space-y-2 text-gray-700">
          <li class="flex items-start">
            <svg class="w-5 h-5 text-yellow-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <span>A presença às aulas é obrigatória. Estudantes com mais de 25% de faltas não poderão realizar exames.</span>
          </li>
          <li class="flex items-start">
            <svg class="w-5 h-5 text-yellow-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <span>As datas podem sofrer alterações. Consulte regularmente o Portal do Estudante.</span>
          </li>
          <li class="flex items-start">
            <svg class="w-5 h-5 text-yellow-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <span>A inscrição nos exames é obrigatória e deve ser feita dentro do prazo estabelecido.</span>
          </li>
          <li class="flex items-start">
            <svg class="w-5 h-5 text-yellow-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <span>Para mais informações, contacte os Serviços Académicos: academicos@ispbie.ao</span>
          </li>
        </ul>
      </div>
    </div>
  </section>
@endsection

