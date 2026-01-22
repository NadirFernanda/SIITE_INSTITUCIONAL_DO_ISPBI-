@extends('layouts.site')

@section('content')
  <!-- Banner -->
  <section class="relative bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-6">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
          <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
        </svg>
        <div>
          <h1 class="text-4xl md:text-5xl font-bold">Centro de Gestão de Estágios</h1>
          <p class="text-xl mt-2 opacity-90">Conectando Estudantes ao Mercado de Trabalho</p>
        </div>
      </div>
      <nav class="text-sm">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Centro de Estágios</span>
      </nav>
    </div>
  </section>

  <!-- Sobre o Centro -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-12">
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Sobre o Centro de Gestão de Estágios</h2>
          <div class="h-1 w-24 bg-[#2563eb] mb-6"></div>
          <p class="text-lg text-gray-700 leading-relaxed mb-4">
            O Centro de Gestão de Estágios (CGE) do ISP-Bié é responsável por estabelecer parcerias 
            com empresas e instituições, facilitar a colocação de estudantes em estágios curriculares 
            e extracurriculares, e acompanhar o desenvolvimento profissional dos nossos alunos.
          </p>
          <p class="text-lg text-gray-700 leading-relaxed">
            Trabalhamos para garantir que cada estudante tenha oportunidades de aplicar conhecimentos 
            teóricos em ambientes profissionais reais, desenvolvendo competências práticas essenciais 
            para o mercado de trabalho.
          </p>
        </div>
        <div class="bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg p-8 text-white">
          <h3 class="text-2xl font-bold mb-6">Números do CGE</h3>
          <div class="space-y-4">
            <div class="flex items-center justify-between border-b border-white/20 pb-3">
              <span class="text-lg">Empresas Parceiras</span>
              <span class="text-3xl font-bold">45+</span>
            </div>
            <div class="flex items-center justify-between border-b border-white/20 pb-3">
              <span class="text-lg">Estudantes em Estágio</span>
              <span class="text-3xl font-bold">180</span>
            </div>
            <div class="flex items-center justify-between border-b border-white/20 pb-3">
              <span class="text-lg">Taxa de Colocação</span>
              <span class="text-3xl font-bold">92%</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-lg">Horas de Estágio/Ano</span>
              <span class="text-3xl font-bold">50k+</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tipos de Estágio -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Modalidades de Estágio</h2>
      <div class="h-1 w-24 bg-[#2563eb] mb-8"></div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Estágio Curricular -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-[#2563eb]">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-[#2563eb] rounded-lg flex items-center justify-center text-white text-2xl mr-4">
              ðŸ“š
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Estágio Curricular Obrigatório</h3>
          </div>
          <p class="text-gray-700 mb-4">
            Parte integrante do currículo académico, necessário para a conclusão do curso. 
            Duração mínima de 400 horas, realizado no último ano de formação.
          </p>
          <ul class="space-y-2 text-gray-600">
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Requisito obrigatório para graduação</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Supervisão de docente orientador</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Relatório final e apresentação</span>
            </li>
          </ul>
        </div>

        <!-- Estágio Extracurricular -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-[#3B82F6]">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-[#3B82F6] rounded-lg flex items-center justify-center text-gray-900 text-2xl mr-4">
              â­
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Estágio Extracurricular</h3>
          </div>
          <p class="text-gray-700 mb-4">
            Opcional, permite ao estudante adquirir experiência profissional complementar durante 
            o curso, sem carácter obrigatório.
          </p>
          <ul class="space-y-2 text-gray-600">
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Flexibilidade de horários</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Possibilidade de bolsa-auxílio</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Certificado de participação</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Empresas Parceiras -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Empresas e Instituições Parceiras</h2>
      <div class="h-1 w-24 bg-[#2563eb] mb-8"></div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ›ï¸</div>
          <h4 class="font-bold text-gray-900 text-sm">Governo Provincial do Bié</h4>
        </div>
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ¥</div>
          <h4 class="font-bold text-gray-900 text-sm">Hospital Provincial do Bié</h4>
        </div>
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ—ï¸</div>
          <h4 class="font-bold text-gray-900 text-sm">Empresas de Construção Civil</h4>
        </div>
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ’¼</div>
          <h4 class="font-bold text-gray-900 text-sm">Bancos e Seguradoras</h4>
        </div>
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ“¡</div>
          <h4 class="font-bold text-gray-900 text-sm">Empresas de Telecomunicações</h4>
        </div>
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ’§</div>
          <h4 class="font-bold text-gray-900 text-sm">MINEA - Recursos Hídricos</h4>
        </div>
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ“°</div>
          <h4 class="font-bold text-gray-900 text-sm">Í“rgãos de Comunicação Social</h4>
        </div>
        <div class="bg-gray-50 rounded-lg p-6 text-center hover:shadow-md transition-shadow">
          <div class="text-3xl mb-2">ðŸ¤</div>
          <h4 class="font-bold text-gray-900 text-sm">ONGs e Organizações Sociais</h4>
        </div>
      </div>
    </div>
  </section>

  <!-- Processo de Candidatura -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Como Candidatar-se a Estágio</h2>
      <div class="h-1 w-24 bg-[#2563eb] mb-8"></div>

      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="text-center">
          <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
            1
          </div>
          <h4 class="font-bold text-gray-900 mb-2">Consulta de Vagas</h4>
          <p class="text-sm text-gray-600">Verifique as vagas disponíveis no portal do CGE ou no mural</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-[#3B82F6] rounded-full flex items-center justify-center text-gray-900 text-2xl font-bold mx-auto mb-4">
            2
          </div>
          <h4 class="font-bold text-gray-900 mb-2">Submissão de CV</h4>
          <p class="text-sm text-gray-600">Envie CV e carta de motivação ao CGE</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-[#3B82F6] rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
            3
          </div>
          <h4 class="font-bold text-gray-900 mb-2">Entrevista</h4>
          <p class="text-sm text-gray-600">Participe da entrevista com a empresa parceira</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-[#2563eb] rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
            4
          </div>
          <h4 class="font-bold text-gray-900 mb-2">Início do Estágio</h4>
          <p class="text-sm text-gray-600">Assine termo de compromisso e inicie atividades</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Procura Oportunidade de Estágio?</h2>
      <p class="text-xl text-gray-600 mb-8">
        Entre em contacto com o Centro de Gestão de Estágios do ISP-Bié.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="mailto:estagios@ispbie.ao" class="inline-block bg-[#2563eb] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#d94d20] transition-colors">
          ðŸ“§ estagios@ispbie.ao
        </a>
        <a href="tel:+244922408061" class="inline-block bg-[#3B82F6] text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-[#e6c200] transition-colors">
          ðŸ“ž (244) 922 408 061
        </a>
      </div>
      <p class="text-sm text-gray-500 mt-4">Horário de Atendimento: Segunda a Sexta, 08h00 - 17h00</p>
    </div>
  </section>
@endsection

