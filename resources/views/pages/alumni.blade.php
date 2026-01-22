@extends('layouts.site')

@section('content')
  <!-- Banner -->
  <section class="relative bg-gradient-to-r from-[#3B82F6] to-[#FFA500] text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-6">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
          <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
        </svg>
        <div>
          <h1 class="text-4xl md:text-5xl font-bold">Alumni ISP-Bié</h1>
          <p class="text-xl mt-2 opacity-90">Rede de Ex-Alunos e Histórias de Sucesso</p>
        </div>
      </div>
      <nav class="text-sm">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Alumni</span>
      </nav>
    </div>
  </section>

  <!-- Histórias de Sucesso -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Histórias de Sucesso</h2>
        <p class="text-lg text-gray-600 mb-6">
          Conheça os ex-alunos do ISP-Bié que estão a fazer a diferença em Angola e no mundo.
        </p>
        <div class="h-1 w-24 bg-[#3B82F6]"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <!-- Alumni 1 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
          <div class="h-64 bg-gradient-to-br from-[#3B82F6] to-[#FFA500] flex items-center justify-center">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-4xl font-bold text-[#3B82F6]">
              JM
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">João Mateus</h3>
            <p class="text-sm text-[#2563eb] font-semibold mb-3">Engenharia Civil â€¢ Turma 2022</p>
            <p class="text-gray-600 mb-4">
              Actualmente a liderar projectos de infraestrutura no Ministério das Obras Públicas. 
              João destaca-se pela sua contribuição no desenvolvimento de estradas e pontes na província do Bié.
            </p>
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
              </svg>
              <span>Eng. Civil, MINOPURAS</span>
            </div>
          </div>
        </div>

        <!-- Alumni 2 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
          <div class="h-64 bg-gradient-to-br from-[#2563eb] to-[#2563eb] flex items-center justify-center">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-4xl font-bold text-[#2563eb]">
              MF
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Maria Fernandes</h3>
            <p class="text-sm text-[#2563eb] font-semibold mb-3">Enfermagem â€¢ Turma 2021</p>
            <p class="text-gray-600 mb-4">
              Enfermeira-chefe no Hospital Provincial do Bié. Maria implementou programas de saúde materno-infantil 
              que reduziram a mortalidade em 30% na região.
            </p>
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
              </svg>
              <span>Enfermeira-Chefe, Hospital Provincial</span>
            </div>
          </div>
        </div>

        <!-- Alumni 3 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
          <div class="h-64 bg-gradient-to-br from-[#2563eb] to-[#2563eb] flex items-center justify-center">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-4xl font-bold text-[#2563eb]">
              CS
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Carlos Silva</h3>
            <p class="text-sm text-[#2563eb] font-semibold mb-3">Contabilidade e Administração â€¢ Turma 2023</p>
            <p class="text-gray-600 mb-4">
              Fundador da ContaBié, empresa de consultoria financeira que apoia PMEs na província. 
              Carlos já assessorou mais de 50 empresas locais.
            </p>
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd"/>
              </svg>
              <span>CEO, ContaBié</span>
            </div>
          </div>
        </div>

        <!-- Alumni 4 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
          <div class="h-64 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] flex items-center justify-center">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-4xl font-bold text-[#2563eb]">
              AP
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Ana Paula</h3>
            <p class="text-sm text-[#2563eb] font-semibold mb-3">Comunicação Social â€¢ Turma 2024</p>
            <p class="text-gray-600 mb-4">
              Jornalista na RNA - Rádio Nacional de Angola. Ana produz reportagens sobre desenvolvimento 
              social e cultural na região do Bié.
            </p>
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
              </svg>
              <span>Jornalista, RNA</span>
            </div>
          </div>
        </div>

        <!-- Alumni 5 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
          <div class="h-64 bg-gradient-to-br from-purple-600 to-pink-500 flex items-center justify-center">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-4xl font-bold text-purple-600">
              PM
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Pedro Manuel</h3>
            <p class="text-sm text-[#2563eb] font-semibold mb-3">Psicologia â€¢ Turma 2023</p>
            <p class="text-gray-600 mb-4">
              Psicólogo clínico a trabalhar com crianças e jovens em situação de vulnerabilidade. 
              Pedro fundou o projecto "Mente Sã, Vida Feliz".
            </p>
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
              </svg>
              <span>Psicólogo, Projecto Mente Sã</span>
            </div>
          </div>
        </div>

        <!-- Alumni 6 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
          <div class="h-64 bg-gradient-to-br from-green-600 to-teal-500 flex items-center justify-center">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-4xl font-bold text-green-600">
              LS
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Luísa Santos</h3>
            <p class="text-sm text-[#2563eb] font-semibold mb-3">Eng. Recursos Hídricos â€¢ Turma 2022</p>
            <p class="text-gray-600 mb-4">
              Especialista em gestão de água no MINEA. Luísa coordena projectos de abastecimento 
              de água potável em comunidades rurais do Bié.
            </p>
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
              </svg>
              <span>Especialista, MINEA</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Comunidade Alumni -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Benefícios da Comunidade Alumni</h2>
        <div class="h-1 w-24 bg-[#3B82F6]"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center">
          <div class="text-5xl mb-4">ðŸ¤</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Networking</h3>
          <p class="text-gray-600">Conecte-se com ex-alunos e amplie sua rede profissional em Angola e no mundo</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center">
          <div class="text-5xl mb-4">ðŸ’¼</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Oportunidades</h3>
          <p class="text-gray-600">Acesse vagas exclusivas de emprego e estágio divulgadas na rede alumni</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center">
          <div class="text-5xl mb-4">ðŸŽ“</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Eventos</h3>
          <p class="text-gray-600">Participe de eventos, reencontros e conferências exclusivas para alumni</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center">
          <div class="text-5xl mb-4">ðŸ“š</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Formação Contínua</h3>
          <p class="text-gray-600">Descontos em cursos de pós-graduação e formações especializadas</p>
        </div>
      </div>

      <!-- Estatísticas Alumni -->
      <div class="bg-gradient-to-r from-[#3B82F6] to-[#FFA500] rounded-lg p-8 text-white">
        <h3 class="text-2xl font-bold mb-6 text-center">Alumni em Números</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
          <div>
            <div class="text-4xl font-bold mb-2">500+</div>
            <div class="text-sm opacity-90">Alumni Formados</div>
          </div>
          <div>
            <div class="text-4xl font-bold mb-2">85%</div>
            <div class="text-sm opacity-90">Taxa de Empregabilidade</div>
          </div>
          <div>
            <div class="text-4xl font-bold mb-2">12</div>
            <div class="text-sm opacity-90">Países onde trabalham</div>
          </div>
          <div>
            <div class="text-4xl font-bold mb-2">30+</div>
            <div class="text-sm opacity-90">Empresas fundadas</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Cadastro -->
  <section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Faça Parte da Rede Alumni ISP-Bié</h2>
      <p class="text-xl text-gray-600 mb-8">
        Cadastre-se e mantenha-se conectado com a comunidade de ex-alunos. 
        Partilhe as suas conquistas e inspire futuros profissionais.
      </p>
      <form class="max-w-2xl mx-auto bg-gray-50 p-8 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <input type="text" placeholder="Nome Completo" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent" required>
          <input type="email" placeholder="Email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent" required>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent" required>
            <option value="">Curso</option>
            <option value="enfermagem">Enfermagem</option>
            <option value="eng-civil">Engenharia Civil</option>
            <option value="eng-hidricos">Eng. Recursos Hídricos</option>
            <option value="contabilidade">Contabilidade e Administração</option>
            <option value="comunicacao">Comunicação Social</option>
            <option value="psicologia">Psicologia</option>
          </select>
          <input type="text" placeholder="Ano de Conclusão" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent" required>
        </div>
        <div class="mb-4">
          <input type="text" placeholder="Empresa/Instituição Actual" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent">
        </div>
        <div class="mb-4">
          <input type="text" placeholder="Cargo Actual" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3B82F6] focus:border-transparent">
        </div>
        <button type="submit" class="w-full bg-gradient-to-r from-[#3B82F6] to-[#FFA500] text-white px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
          Cadastrar-me na Rede Alumni
        </button>
      </form>
    </div>
  </section>
@endsection

