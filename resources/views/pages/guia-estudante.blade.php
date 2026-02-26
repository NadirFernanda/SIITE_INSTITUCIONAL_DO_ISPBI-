@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
      <nav class="text-sm mb-8">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Guia do Estudante</span>
      </nav>

      

  <!-- Download -->
  <section class="py-6 bg-white border-b scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 mb-2">Guia do Estudante 2025/2026</h2>
          <p class="text-gray-600">Tudo o que precisa saber para ter sucesso no ISP-Bié</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Conteúdo -->
  <section class="py-12 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Índice Rápido -->
      <div class="bg-white rounded-lg shadow-md p-5 mb-10 interactive-card">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Índice</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
          <a href="#matricula" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-[#2563eb] hover:text-white transition-colors">
            <span class="font-semibold">1. Matrícula e Inscrição</span>
          </a>
          <a href="#servicos" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-[#2563eb] hover:text-white transition-colors">
            <span class="font-semibold">2. Serviços Académicos</span>
          </a>
          <a href="#avaliacao" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-[#2563eb] hover:text-white transition-colors">
            <span class="font-semibold">3. Avaliação e Exames</span>
          </a>
          <a href="#biblioteca" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-[#2563eb] hover:text-white transition-colors">
            <span class="font-semibold">4. Biblioteca</span>
          </a>
          <a href="#estagio" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-[#2563eb] hover:text-white transition-colors">
            <span class="font-semibold">5. Estágios</span>
          </a>
          <a href="#direitos" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-[#2563eb] hover:text-white transition-colors">
            <span class="font-semibold">6. Direitos e Deveres</span>
          </a>
        </div>
      </div>

      <!-- 1. Matrícula -->
      <div id="matricula" class="bg-white rounded-lg shadow-md p-6 mb-6 interactive-card">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-[#2563eb] rounded-lg flex items-center justify-center text-white text-xl font-bold mr-4">
            1
          </div>
          <h3 class="text-2xl font-bold text-gray-900">Matrícula e Inscrição</h3>
        </div>
        <div class="prose max-w-none">
          <h4 class="font-bold text-lg text-gray-900 mb-3">Documentos Necessários</h4>
          <ul class="space-y-2 mb-6">
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Bilhete de Identidade (original e fotocópia)</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Certificado de Habilitações (12ª Classe)</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>2 Fotografias tipo-passe</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-[#3B82F6] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>Comprovativo de pagamento de comparticipação (se aplicável)</span>
            </li>
          </ul>

          <h4 class="font-bold text-lg text-gray-900 mb-3">Comparticipações 2025/2026</h4>
          <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mb-4">
            <p class="text-sm text-blue-800">
              <strong>Nota:</strong> A frequência no ISP-Bié implica a comparticipação financeira dos estudantes por via do pagamento de propinas e emolumentos.
            </p>
          </div>
          <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-600">Período Regular</p>
                <p class="text-2xl font-bold text-[#2563eb]">1.900 Kz/mês</p>
              </div>
              <div>
                <p class="text-sm text-gray-600">Período Pós-laboral</p>
                <p class="text-2xl font-bold text-[#2563eb]">15.000 Kz/mês</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Serviços Académicos -->
      <div id="servicos" class="bg-white rounded-lg shadow-md p-6 mb-6 interactive-card">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-[#2563eb] rounded-lg flex items-center justify-center text-white text-xl font-bold mr-4">
            2
          </div>
          <h3 class="text-2xl font-bold text-gray-900">Serviços Académicos</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="border-l-4 border-[#2563eb] pl-4">
            <h4 class="font-bold text-gray-900 mb-2">Portal do Estudante</h4>
            <p class="text-gray-600 mb-2">Acesse notas, horários, documentos e serviços online.</p>
            <a href="https://portal.ispbie.ao" class="text-[#2563eb] hover:underline font-semibold" target="_blank" rel="noopener">portal.ispbie.ao &rarr;</a>
          </div>
          <div class="border-l-4 border-[#3B82F6] pl-4">
            <h4 class="font-bold text-gray-900 mb-2">Emissão de Documentos</h4>
            <p class="text-gray-600 mb-2">Declarações, certificados e históricos escolares.</p>
            <ul class="space-y-3 text-sm text-gray-700 mb-2">
              <li>
                <div class="font-semibold">Emissão de Declaração</div>
                <div class="text-gray-600">Declaração — frequência com notas, sem notas ou conclusão de curso</div>
                <div class="mt-2 flex items-center gap-3">
                  <span class="inline-flex items-center bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full">Com urgência: <span class="font-semibold ml-2">48h</span></span>
                  <span class="inline-flex items-center bg-[#2563eb] text-white text-xs px-3 py-1 rounded-full">Sem urgência: <span class="font-semibold ml-2">7 dias</span></span>
                </div>
              </li>
              <li>
                <div class="font-semibold">Emissão de Certificado</div>
                <div class="text-gray-600">Certificado de conclusão de curso</div>
                <div class="mt-2 flex items-center gap-3">
                  <span class="inline-flex items-center bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full">Com urgência: <span class="font-semibold ml-2">30 dias</span></span>
                  <span class="inline-flex items-center bg-[#2563eb] text-white text-xs px-3 py-1 rounded-full">Sem urgência: <span class="font-semibold ml-2">60 dias</span></span>
                </div>
              </li>
              <li>
                <div class="font-semibold">Solicitação de Histórico Escolar</div>
                <div class="text-gray-600">Histórico completo ou parcial</div>
                <div class="mt-2 flex items-center gap-3">
                  <span class="inline-flex items-center bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full">Com urgência: <span class="font-semibold ml-2">7 dias</span></span>
                  <span class="inline-flex items-center bg-[#2563eb] text-white text-xs px-3 py-1 rounded-full">Sem urgência: <span class="font-semibold ml-2">15 dias</span></span>
                </div>
              </li>
            </ul>
            <p class="text-gray-900 font-bold mt-3">Serviços Administrativos</p>
            <ul class="space-y-3 text-sm text-gray-700 mt-2">
              <li>
                <div class="font-semibold">Matrícula</div>
                <div class="text-gray-600">Processo de matrícula para novos alunos</div>
                <div class="text-sm text-gray-500 mt-1">Prazo: Conforme calendário</div>
              </li>
              <li>
                <div class="font-semibold">Renovação de Matrícula</div>
                <div class="text-gray-600">Renovação para estudantes veteranos</div>
                <div class="text-sm text-gray-500 mt-1">Prazo: Conforme calendário</div>
              </li>
            </ul>
          </div>
          <div class="border-l-4 border-[#3B82F6] pl-4">
            <h4 class="font-bold text-gray-900 mb-2">Cartão de Estudante</h4>
            <p class="text-gray-600 mb-2">Identifica e garante acesso a benefícios e descontos.</p>
            <p class="text-sm text-gray-500">Custo: 5.000 Kz</p>
          </div>
          <div class="border-l-4 border-[#2563eb] pl-4">
            <h4 class="font-bold text-gray-900 mb-2">Atendimento</h4>
            <p class="text-gray-600 mb-2">Segunda a Sexta: 08h00 - 17h00</p>
            <p class="text-sm text-gray-500">academicos@ispbie.ao</p>
          </div>
        </div>
      </div>

      

      <!-- 4. Biblioteca -->
      <div id="biblioteca" class="bg-white rounded-lg shadow-md p-6 mb-6 interactive-card">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-[#3B82F6] rounded-lg flex items-center justify-center text-white text-xl font-bold mr-4">
            4
          </div>
          <h3 class="text-2xl font-bold text-gray-900">Biblioteca</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h4 class="font-bold text-gray-900 mb-3">Horário de Funcionamento</h4>
            <div class="space-y-2 text-gray-700">
              <p>Segunda a Sexta: 08h00 - 20h00</p>
              <p>Sábado: 08h00 - 13h00</p>
              <p>Domingo e Feriados: Encerrado</p>
            </div>
          </div>
          <div>
            <h4 class="font-bold text-gray-900 mb-3">Serviços Disponíveis</h4>
            <ul class="space-y-2">
              <li class="flex items-center text-gray-700">
                <svg class="w-4 h-4 text-[#3B82F6] mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Empréstimo de livros (até 3 por vez)
              </li>
              <li class="flex items-center text-gray-700">
                <svg class="w-4 h-4 text-[#3B82F6] mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Biblioteca digital
              </li>
              <li class="flex items-center text-gray-700">
                <svg class="w-4 h-4 text-[#3B82F6] mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Salas de estudo individuais e em grupo
              </li>
              <li class="flex items-center text-gray-700">
                <svg class="w-4 h-4 text-[#3B82F6] mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Computadores com internet
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- 5. Estágios -->
      <div id="estagio" class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-[#3B82F6] rounded-lg flex items-center justify-center text-gray-900 text-xl font-bold mr-4">
            5
          </div>
          <h3 class="text-2xl font-bold text-gray-900">Estágios</h3>
        </div>
        <p class="text-gray-700 mb-4">
          Os estágios são obrigatórios e fazem parte do currículo académico; são essenciais para a formação prática
          e para a integração no mercado de trabalho.
        </p>
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
          <p class="font-semibold text-gray-900 mb-2">Centro de Gestão de Estágios</p>
          <p class="text-gray-700 mb-2">Contate o CGE para orientação sobre vagas e procedimentos.</p>
          <a href="/estagios" class="text-[#3B82F6] hover:underline font-semibold">Mais informações →</a>
        </div>
      </div>

      <!-- 6. Direitos e Deveres -->
      <div id="direitos" class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-[#2563eb] rounded-lg flex items-center justify-center text-white text-xl font-bold mr-4">
            6
          </div>
          <h3 class="text-2xl font-bold text-gray-900">Direitos e Deveres</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div>
            <h4 class="font-bold text-lg text-gray-900 mb-4">Direitos do Estudante</h4>
            <ul class="space-y-3">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Receber ensino de qualidade</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Acesso a instalações e equipamentos</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Participação em atividades culturais e desportivas</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Apresentar reclamações e sugestões</span>
              </li>
            </ul>
          </div>
          <div>
            <h4 class="font-bold text-lg text-gray-900 mb-4">Deveres do Estudante</h4>
            <ul class="space-y-3">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Cumprir o regulamento académico</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Frequentar as aulas (mínimo 75%)</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Pagar comparticipações nos prazos estabelecidos</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">Respeitar docentes, funcionários e colegas</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h3 class="text-2xl font-bold text-gray-900 mb-4">Dúvidas sobre o Guia do Estudante?</h3>
      <p class="text-lg text-gray-600 mb-6">
        Entre em contacto com os Serviços Académicos para mais informações.
      </p>
      <a href="/contactos" class="inline-block bg-[#2563eb] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#1f3342] transition-colors">
        Contactar Serviços Académicos
      </a>
    </div>
  </section>
@endsection

