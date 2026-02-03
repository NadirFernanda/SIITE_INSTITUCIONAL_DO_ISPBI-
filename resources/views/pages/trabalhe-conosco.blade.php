@extends('layouts.site')

@section('content')
  <!-- Banner -->
  <section class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white py-16 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-4 mb-4">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
          <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
        </svg>
        <div>
          <h1 class="text-4xl font-bold">Trabalhe Connosco</h1>
          <p class="text-lg opacity-90">Faça parte da equipa do ISP-Bié</p>
        </div>
      </div>
      
      <nav class="text-sm opacity-75">
        <a href="/" class="hover:underline">Início</a> \ Trabalhe Connosco
      </nav>
    </div>
  </section>

  <!-- Introdução -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center mb-12">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-4">Concursos Públicos</h2>
        <p class="text-lg text-gray-700 leading-relaxed">
          O Instituto Superior Politécnico do Bié recruta seus colaboradores através de 
          <strong>concursos públicos</strong>, garantindo transparência e igualdade de oportunidades. 
          Acompanhe esta página para ficar a par dos concursos abertos e dos requisitos necessários.
        </p>
      </div>
    </div>
  </section>

  <!-- Íreas de Recrutamento -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12 text-center">Concursos Abertos</h2>
      
      <div class="bg-white rounded-lg shadow-md p-8 mb-8 interactive-card">
        <div class="text-center py-12">
          <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
          </svg>
          <h3 class="text-2xl font-bold text-gray-600 mb-2">Nenhum Concurso Aberto no Momento</h3>
          <p class="text-gray-500 mb-6">
            Não há concursos públicos em andamento. Volte regularmente para verificar novas oportunidades.
          </p>
          <a href="#alertas" class="inline-block bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
            Receber Alertas de Concursos
          </a>
        </div>
      </div>

      <h3 class="text-2xl font-bold text-[#2563eb] mb-8 text-center">Íreas de Recrutamento Habituais</h3>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Docentes -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all interactive-card">
          <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563eb] p-6 text-white">
            <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
            </svg>
            <h3 class="text-2xl font-bold">Docentes</h3>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Professores para áreas de Engenharia, Ciências Sociais, Saúde, Gestão e outras especialidades.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li>âœ“ Mestrado ou Doutoramento</li>
              <li>âœ“ Experiência académica</li>
              <li>âœ“ Produção científica</li>
            </ul>
          </div>
        </div>

        <!-- Técnicos Administrativos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all interactive-card">
          <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] p-6 text-white">
            <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
            </svg>
            <h3 class="text-2xl font-bold">Técnicos Administrativos</h3>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Profissionais para gestão administrativa, recursos humanos, finanças e secretariado.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li>âœ“ Formação superior</li>
              <li>âœ“ Experiência administrativa</li>
              <li>âœ“ Domínio de ferramentas digitais</li>
            </ul>
          </div>
        </div>

        <!-- Técnicos Especializados -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all interactive-card">
          <div class="bg-gradient-to-r from-[#9C27B0] to-[#673AB7] p-6 text-white">
            <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
            </svg>
            <h3 class="text-2xl font-bold">Técnicos Especializados</h3>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Profissionais de TI, bibliotecários, técnicos de laboratório e manutenção.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li>âœ“ Formação técnica ou superior</li>
              <li>âœ“ Experiência na área</li>
              <li>âœ“ Certificações relevantes</li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Como Candidatar-se -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-12 text-center">Processo de Concurso Público</h2>
      
      <div class="grid md:grid-cols-4 gap-8 mb-12">
        
        <div class="text-center interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">1</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3">Publicação do Edital</h3>
          <p class="text-gray-600">
            O concurso é divulgado publicamente em Diário da República, imprensa e no site do ISP-Bié.
          </p>
        </div>

        <div class="text-center interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">2</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3">Candidatura</h3>
          <p class="text-gray-600">
            Submeta a documentação exigida dentro do prazo estipulado no edital.
          </p>
        </div>

        <div class="text-center interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#9C27B0] to-[#673AB7] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">3</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3">Provas e Avaliação</h3>
          <p class="text-gray-600">
            Realize as provas escritas, práticas e/ou entrevistas conforme o edital.
          </p>
        </div>

        <div class="text-center interactive-card">
          <div class="w-16 h-16 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-2xl font-bold">4</span>
          </div>
          <h3 class="text-xl font-bold text-[#2563eb] mb-3">Resultado Final</h3>
          <p class="text-gray-600">
            A lista de aprovados é publicada e os selecionados são convocados para posse.
          </p>
        </div>

      </div>

      <!-- Documentação Necessária -->
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-lg p-8 text-white interactive-card">
        <h3 class="text-2xl font-bold mb-6 text-center">Documentação Geralmente Exigida</h3>
        <div class="grid md:grid-cols-2 gap-6">
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Bilhete de Identidade (cópia autenticada)
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Certificado de Habilitações Literárias
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Curriculum Vitae detalhado
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Certificado de Registo Criminal
            </li>
          </ul>
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Atestado Médico de Aptidão Física
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Comprovativo de Experiência Profissional
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Outros documentos específicos (conforme edital)
            </li>
          </ul>
        </div>
        <p class="text-center mt-6 text-sm opacity-90">
          âš ï¸ Consulte sempre o edital específico do concurso para a lista completa de documentos exigidos.
        </p>
      </div>
    </div>
  </section>

  <!-- Formulário de Alertas -->
  <section id="alertas" class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-lg shadow-lg p-8 interactive-card">
        <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Receber Alertas de Concursos</h2>
        <p class="text-gray-600 mb-8">
          Cadastre-se para receber notificações por email quando novos concursos públicos forem abertos no ISP-Bié.
        </p>

        <form class="space-y-6">
          @csrf
          
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nome Completo *</label>
              <input type="text" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2563eb] focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
              <input type="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2563eb] focus:border-transparent">
            </div>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Telefone</label>
            <input type="tel" placeholder="(244) 900 000 000" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2563eb] focus:border-transparent">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Íreas de Interesse (selecione todas que se aplicam) *</label>
            <div class="space-y-2">
              <label class="flex items-center">
                <input type="checkbox" class="mr-2 rounded border-gray-300 text-[#2563eb] focus:ring-[#2563eb]">
                <span class="text-gray-700">Docente</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="mr-2 rounded border-gray-300 text-[#2563eb] focus:ring-[#2563eb]">
                <span class="text-gray-700">Técnico Administrativo</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="mr-2 rounded border-gray-300 text-[#2563eb] focus:ring-[#2563eb]">
                <span class="text-gray-700">Técnico Especializado (TI, Laboratórios, etc.)</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="mr-2 rounded border-gray-300 text-[#2563eb] focus:ring-[#2563eb]">
                <span class="text-gray-700">Investigação Científica</span>
              </label>
            </div>
          </div>

          <div class="flex items-start">
            <input type="checkbox" required class="mt-1 mr-3">
            <label class="text-sm text-gray-600">
              Autorizo o ISP-Bié a utilizar os meus dados pessoais para envio de alertas sobre concursos públicos, 
              de acordo com a legislação de proteção de dados em vigor. *
            </label>
          </div>

          <button type="submit" class="w-full bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white py-4 rounded-lg font-bold text-lg hover:shadow-lg transition-all">
            Cadastrar para Receber Alertas
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- Informações Adicionais -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-2xl p-12 text-white">
        <div class="grid md:grid-cols-2 gap-8">
          
          <div>
            <h3 class="text-2xl font-bold mb-4">Departamento de Recursos Humanos</h3>
            <div class="space-y-3">
              <p class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                <span>Email: rh@ispbie.ao</span>
              </p>
              <p class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                </svg>
                <span>(244) 922 408 061</span>
              </p>
              <p class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <span>Rua Padre Fidalgo entre Artur de Paiva e Francisco de Leite Cardoso S/N, Cuito, Bié</span>
              </p>
              <p class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span>Atendimento: Segunda a Sexta, 8h00-17h00</span>
              </p>
            </div>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4">O Que Oferecemos</h3>
            <ul class="space-y-3">
              <li class="flex items-start">
                <svg class="w-6 h-6 text-[#3B82F6] mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Ambiente de trabalho estimulante e colaborativo
              </li>
              <li class="flex items-start">
                <svg class="w-6 h-6 text-[#3B82F6] mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Oportunidades de formação contínua
              </li>
              <li class="flex items-start">
                <svg class="w-6 h-6 text-[#3B82F6] mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Participação em projetos de investigação
              </li>
              <li class="flex items-start">
                <svg class="w-6 h-6 text-[#3B82F6] mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Desenvolvimento de carreira profissional
              </li>
              <li class="flex items-start">
                <svg class="w-6 h-6 text-[#3B82F6] mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Contribuição para o desenvolvimento da província
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>

@endsection

