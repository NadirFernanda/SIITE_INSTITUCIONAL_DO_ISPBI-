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
          <h1 class="text-4xl md:text-5xl font-bold">Centro de Ensino de Línguas</h1>
          <p class="text-xl mt-2 opacity-90">Aprenda Novos Idiomas, Amplie Horizontes</p>
        </div>
      </div>
      <nav class="text-sm">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Centro de Línguas</span>
      </nav>
    </div>
  </section>

  <!-- Sobre o Centro -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-12">
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Sobre o Centro de Ensino de Línguas (CEL)</h2>
          <div class="h-1 w-24 bg-indigo-600 mb-6"></div>
          <p class="text-lg text-gray-700 leading-relaxed mb-4">
            O Centro de Ensino de Línguas (CEL) do ISP-Bié oferece cursos de idiomas para estudantes, 
            docentes, funcionários e comunidade externa, promovendo o multilinguismo e a competência 
            intercultural essencial no mundo globalizado.
          </p>
          <p class="text-lg text-gray-700 leading-relaxed">
            Com metodologias modernas e professores qualificados, preparamos os alunos para certificações 
            internacionais e para a comunicação eficaz em contextos académicos e profissionais.
          </p>
        </div>
        <div class="bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-lg p-8 text-white interactive-card">
          <h3 class="text-2xl font-bold mb-6">Porquê Aprender no CEL?</h3>
          <ul class="space-y-4">
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span>Professores nativos e certificados internacionalmente</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span>Turmas reduzidas para melhor aprendizagem</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span>Preparação para certificações internacionais</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span>Horários flexíveis (manhã, tarde e laboral)</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Idiomas Oferecidos -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Idiomas Oferecidos</h2>
      <div class="h-1 w-24 bg-indigo-600 mb-8"></div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Inglês -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
          <div class="h-48 bg-gradient-to-br from-[#2563eb] to-[#2563eb] flex items-center justify-center">
            <div class="text-center text-white">
              <div class="text-6xl mb-2">ðŸ‡¬ðŸ‡§</div>
              <h3 class="text-3xl font-bold">Inglês</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Curso completo de inglês do nível básico ao avançado, com preparação para TOEFL e IELTS.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“…</span>
                <span>6 níveis (A1 a C1)</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">â°</span>
                <span>3 meses por nível</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>Máx. 15 alunos/turma</span>
              </li>
            </ul>
            <div class="border-t pt-4">
              <span class="text-lg font-bold text-indigo-600">Desde 15.000 Kz/mês</span>
            </div>
          </div>
        </div>

        <!-- Francês -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
          <div class="h-48 bg-gradient-to-br from-blue-500 to-red-600 flex items-center justify-center">
            <div class="text-center text-white">
              <div class="text-6xl mb-2">ðŸ‡«ðŸ‡·</div>
              <h3 class="text-3xl font-bold">Francês</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Aprenda francês para comunicação internacional e preparação para DELF/DALF.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“…</span>
                <span>5 níveis (A1 a C1)</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">â°</span>
                <span>3 meses por nível</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>Máx. 12 alunos/turma</span>
              </li>
            </ul>
            <div class="border-t pt-4">
              <span class="text-lg font-bold text-blue-600">Desde 15.000 Kz/mês</span>
            </div>
          </div>
        </div>

        <!-- Português (Estrangeiros) -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
          <div class="h-48 bg-gradient-to-br from-green-600 to-red-600 flex items-center justify-center">
            <div class="text-center text-white">
              <div class="text-6xl mb-2">ðŸ‡µðŸ‡¹</div>
              <h3 class="text-3xl font-bold">Português</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Português para estrangeiros (PLE) com foco em comunicação académica e profissional.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“…</span>
                <span>4 níveis (A1 a B2)</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">â°</span>
                <span>3 meses por nível</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>Máx. 12 alunos/turma</span>
              </li>
            </ul>
            <div class="border-t pt-4">
              <span class="text-lg font-bold text-green-600">Desde 12.000 Kz/mês</span>
            </div>
          </div>
        </div>

        <!-- Espanhol -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
          <div class="h-48 bg-gradient-to-br from-yellow-500 to-red-600 flex items-center justify-center">
            <div class="text-center text-white">
              <div class="text-6xl mb-2">ðŸ‡ªðŸ‡¸</div>
              <h3 class="text-3xl font-bold">Espanhol</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Curso de espanhol do básico ao avançado, com preparação para DELE.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“…</span>
                <span>5 níveis (A1 a C1)</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">â°</span>
                <span>3 meses por nível</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>Máx. 15 alunos/turma</span>
              </li>
            </ul>
            <div class="border-t pt-4">
              <span class="text-lg font-bold text-yellow-600">Desde 14.000 Kz/mês</span>
            </div>
          </div>
        </div>

        <!-- Mandarim -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
          <div class="h-48 bg-gradient-to-br from-red-600 to-yellow-500 flex items-center justify-center">
            <div class="text-center text-white">
              <div class="text-6xl mb-2">ðŸ‡¨ðŸ‡³</div>
              <h3 class="text-3xl font-bold">Mandarim</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Introdução ao mandarim para negócios e cooperação internacional com a China.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“…</span>
                <span>4 níveis (HSK 1-4)</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">â°</span>
                <span>4 meses por nível</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>Máx. 10 alunos/turma</span>
              </li>
            </ul>
            <div class="border-t pt-4">
              <span class="text-lg font-bold text-red-600">Desde 18.000 Kz/mês</span>
            </div>
          </div>
        </div>

        <!-- Alemão -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow interactive-card">
          <div class="h-48 bg-gradient-to-br from-black to-red-600 flex items-center justify-center">
            <div class="text-center text-white">
              <div class="text-6xl mb-2">ðŸ‡©ðŸ‡ª</div>
              <h3 class="text-3xl font-bold">Alemão</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 mb-4">
              Curso de alemão com foco em oportunidades de estudo e trabalho na Alemanha.
            </p>
            <ul class="space-y-2 text-sm text-gray-600 mb-4">
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ“…</span>
                <span>5 níveis (A1 a B2)</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">â°</span>
                <span>3 meses por nível</span>
              </li>
              <li class="flex items-center">
                <span class="font-semibold mr-2">ðŸ‘¥</span>
                <span>Máx. 12 alunos/turma</span>
              </li>
            </ul>
            <div class="border-t pt-4">
              <span class="text-lg font-bold text-gray-900">Desde 16.000 Kz/mês</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modalidades -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Modalidades de Ensino</h2>
      <div class="h-1 w-24 bg-indigo-600 mb-8"></div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg p-6 border-l-4 border-indigo-600">
          <div class="text-3xl mb-3">ðŸ«</div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Presencial</h3>
          <p class="text-gray-700">
            Aulas no campus do ISP-Bié com interação direta e prática conversacional intensiva.
          </p>
        </div>

        <div class="bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg p-6 border-l-4 border-purple-600">
          <div class="text-3xl mb-3">ðŸ’»</div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Online</h3>
          <p class="text-gray-700">
            Aulas virtuais ao vivo com plataforma interativa e materiais digitais.
          </p>
        </div>

        <div class="bg-gradient-to-br from-pink-100 to-red-100 rounded-lg p-6 border-l-4 border-pink-600">
          <div class="text-3xl mb-3">ðŸ”„</div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Híbrido</h3>
          <p class="text-gray-700">
            Combinação de aulas presenciais e online para máxima flexibilidade.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Benefícios para Estudantes ISP-Bié -->
  <section class="py-16 bg-indigo-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold mb-6 text-center">Benefícios para Estudantes do ISP-Bié</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="text-center">
          <div class="text-4xl mb-3">ðŸ’°</div>
          <h4 class="font-bold mb-2">Desconto 20%</h4>
          <p class="text-sm opacity-90">Todos os estudantes têm desconto especial</p>
        </div>
        <div class="text-center">
          <div class="text-4xl mb-3">ðŸ“š</div>
          <h4 class="font-bold mb-2">Material Grátis</h4>
          <p class="text-sm opacity-90">Material didático incluído no curso</p>
        </div>
        <div class="text-center">
          <div class="text-4xl mb-3">ðŸŽ“</div>
          <h4 class="font-bold mb-2">Certificado</h4>
          <p class="text-sm opacity-90">Certificado reconhecido internacionalmente</p>
        </div>
        <div class="text-center">
          <div class="text-4xl mb-3">â°</div>
          <h4 class="font-bold mb-2">Horário Flexível</h4>
          <p class="text-sm opacity-90">Turnos adaptados ao horário académico</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Inscrição -->
  <section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Pronto para Aprender um Novo Idioma?</h2>
      <p class="text-xl text-gray-600 mb-8">
        Inscrições abertas para o primeiro semestre de 2026. Garanta já a sua vaga!
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="mailto:linguas@ispbie.ao" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
          ðŸ“§ linguas@ispbie.ao
        </a>
        <a href="tel:+244922408061" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
          ðŸ“ž (244) 922 408 061
        </a>
      </div>
      <p class="text-sm text-gray-500 mt-6">
        Centro de Ensino de Línguas - Campus ISP-Bié<br>
        Segunda a Sexta: 08h00 - 17h00 | Sábado: 08h00 - 12h00
      </p>
    </div>
  </section>
@endsection

