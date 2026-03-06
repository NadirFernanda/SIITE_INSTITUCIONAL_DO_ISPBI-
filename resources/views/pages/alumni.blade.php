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
          <p class="text-xl mt-2 opacity-90">Rede de Ex-Estudantes e Histórias de Sucesso</p>
        </div>
      </div>
      <nav class="text-sm">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Alumni</span>
      </nav>
    </div>
  </section>



  <!-- Histórico Alumni -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Histórico Alumni</h2>
        <div class="h-1 w-24 bg-[#FFA500]"></div>
        <p class="mt-4 text-lg text-gray-700">Conheça as histórias de sucesso, conquistas e trajetórias inspiradoras dos ex-estudantes do ISP-Bié. Aqui celebramos o impacto dos nossos alumni em Angola e no mundo.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @php
          $alumni = \App\Models\Alumnus::where('publicado', 1)->orderByDesc('id')->get();
        @endphp
        @forelse($alumni as $alumnus)
          <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 hover:shadow-2xl transition-shadow flex items-center gap-6">
            <!-- Avatar com iniciais -->
            <div class="flex-shrink-0">
              <div class="w-16 h-16 rounded-full bg-[#2563eb] flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(mb_substr($alumnus->nome, 0, 1)) }}{{ mb_strtoupper(mb_substr(explode(' ', $alumnus->nome)[count(explode(' ', $alumnus->nome))-1], 0, 1)) }}
              </div>
            </div>
            <!-- Conteúdo do card -->
            <div>
              <div class="flex flex-col sm:flex-row sm:items-center gap-1 mb-1">
                <span class="font-bold text-lg text-gray-900">{{ $alumnus->nome }}</span>
              </div>
              <div class="text-gray-600 text-base mb-3">
                {{ $alumnus->curso }}
                @if($alumnus->cargo)
                  &bull; {{ $alumnus->cargo }}
                @endif
              </div>
              @php
                $satisfacao = trim((string) $alumnus->satisfacao);
                $hasDepoimento = $satisfacao && !preg_match('/^\d+$/', $satisfacao);
              @endphp
              @if($hasDepoimento)
                <div class="text-gray-700 italic text-lg">
                  "{{ Str::limit($satisfacao, 260) }}"
                  @if(Str::length($satisfacao) > 260)
                    <a
                      href="{{ route('alumni.show', $alumnus->id) }}"
                      class="ml-2 text-sm text-[#2563eb] font-semibold hover:text-[#1d4ed8] underline"
                    >
                      Ler mais
                    </a>
                  @endif
                </div>
              @else
                <div class="text-gray-700 italic text-lg">"Procurando emprego..."</div>
              @endif
            </div>
          </div>
        @empty
          <div class="bg-gray-100 p-6 rounded-lg text-center text-gray-500 col-span-2">Nenhum histórico de alumni publicado ainda.</div>
        @endforelse
      </div>
    </div>
  </section>
  <!-- Comunidade Alumni -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Benefícios da Comunidade Alumni</h2>
        <div class="h-1 w-24 bg-[#3B82F6]"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center interactive-card">
          <div class="text-5xl mb-4">🤝</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Networking</h3>
          <p class="text-gray-600">Conecte-se com ex-estudantes e amplie sua rede profissional em Angola e no mundo</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center interactive-card">
          <div class="text-5xl mb-4">💼</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Oportunidades</h3>
          <p class="text-gray-600">Acesse vagas exclusivas de emprego e estágio divulgadas na rede alumni</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center interactive-card">
          <div class="text-5xl mb-4">🎓</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Eventos</h3>
          <p class="text-gray-600">Participe de eventos, reencontros e conferências exclusivas para alumni</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow text-center interactive-card">
          <div class="text-5xl mb-4">📚</div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Formação Contínua</h3>
          <p class="text-gray-600">Descontos em cursos de pós-graduação e formações especializadas</p>
        </div>
      </div>
      

      <!-- Estatísticas Alumni -->
      <div class="bg-gradient-to-r from-[#3B82F6] to-[#FFA500] rounded-lg p-8 text-white scroll-reveal">
        <h3 class="text-2xl font-bold mb-6 text-center">Alumni em Números</h3>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
          <div class="stat-card">
            <div class="text-4xl font-bold mb-2">0</div>
            <div class="text-sm opacity-90">Alumni Formados</div>
          </div>
          <div class="stat-card">
            <div class="text-4xl font-bold mb-2">0%</div>
            <div class="text-sm opacity-90">Taxa de Empregabilidade</div>
          </div>
          <div class="stat-card">
            <div class="text-4xl font-bold mb-2">0</div>
            <div class="text-sm opacity-90">Países onde trabalham</div>
          </div>
          <div class="stat-card">
            <div class="text-4xl font-bold mb-2">0</div>
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
        Cadastre-se e mantenha-se conectado com a comunidade de ex-estudantes.
        Compartilhe as suas conquistas e inspire futuros profissionais.
      </p>
      <!-- Formulário removido conforme solicitado -->
    </div>
  </section>
  <div class="max-w-2xl mx-auto mt-10 bg-white rounded-lg shadow-lg p-8">
    @if(session('success'))
      <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300 text-center">
        {{ session('success') }}
      </div>
    @endif
    @if($errors->any())
      <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  <h2 class="text-2xl font-bold text-[#2563eb] mb-6 text-center">Formulário de Alumni</h2>
  <form method="POST" action="{{ route('alumni.store') }}" class="space-y-6">
    @csrf
    <div x-data="{ trabalha: '' }">
      <div>
        <label for="nome" class="block text-sm font-semibold text-gray-700 mb-1">Nome completo <span class="text-red-500">*</span></label>
        <input type="text" id="nome" name="nome" required class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-[#2563eb] focus:outline-none" placeholder="Digite seu nome completo">
      </div>
      <div>
        <label for="curso" class="block text-sm font-semibold text-gray-700 mb-1">Curso que frequentou <span class="text-red-500">*</span></label>
        <select id="curso" name="curso" required class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-[#2563eb] focus:outline-none">
          <option value="">Selecione o curso</option>
          <option value="contabilidade">Contabilidade e Administração</option>
          <option value="comunicacao">Comunicação Social</option>
          <option value="engenharia-informatica">Engenharia Informática</option>
          <option value="enfermagem">Enfermagem Geral</option>
          <option value="engenharia-hidricos">Engenharia em Recursos Hídricos</option>
          <option value="psicologia">Psicologia</option>
        </select>
      </div>
      <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
          <label for="ano" class="block text-sm font-semibold text-gray-700 mb-1">Ano de conclusão <span class="text-red-500">*</span></label>
          <input type="number" id="ano" name="ano" min="1950" max="2100" required class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-[#2563eb] focus:outline-none" placeholder="Ano">
        </div>
        <div class="flex-1">
          <label for="contacto" class="block text-sm font-semibold text-gray-700 mb-1">Contacto telefônico/WhatsApp <span class="text-red-500">*</span></label>
          <input type="text" id="contacto" name="contacto" required class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-[#2563eb] focus:outline-none" placeholder="(+244) 9XX XXX XXX">
        </div>
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Trabalha atualmente? <span class="text-red-500">*</span></label>
        <div class="flex gap-4 mt-1">
          <label class="inline-flex items-center">
            <input type="radio" name="trabalha" value="sim" x-model="trabalha" required class="form-radio text-[#2563eb]">
            <span class="ml-2">Sim</span>
          </label>
          <label class="inline-flex items-center">
            <input type="radio" name="trabalha" value="nao" x-model="trabalha" required class="form-radio text-[#2563eb]">
            <span class="ml-2">Não</span>
          </label>
        </div>
      </div>
      <template x-if="trabalha === 'sim'">
        <div>
          <div>
            <label for="empresa" class="block text-sm font-semibold text-gray-700 mb-1">Onde trabalha <span class="text-red-500">*</span></label>
            <input type="text" id="empresa" name="empresa" required class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-[#2563eb] focus:outline-none" placeholder="Nome da empresa ou instituição">
          </div>
          <div>
            <label for="cargo" class="block text-sm font-semibold text-gray-700 mb-1">Cargo atual <span class="text-red-500">*</span></label>
            <input type="text" id="cargo" name="cargo" required class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-[#2563eb] focus:outline-none" placeholder="Seu cargo atual">
          </div>
          <div>
            <label for="satisfacao" class="block text-sm font-semibold text-gray-700 mb-1">Mensagem sobre o nível de satisfação e experiência (para quem já está empregado) <span class="text-red-500">*</span></label>
            <textarea id="satisfacao" name="satisfacao" rows="4" required class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-[#2563eb] focus:outline-none" placeholder="Conte como tem sido sua experiência profissional e o nível de satisfação"></textarea>
          </div>
        </div>
      </template>
      <div class="pt-2">
        <button type="submit" class="w-full bg-[#2563eb] text-white font-bold py-2 px-6 rounded hover:bg-[#183153] transition-colors">Cadastrar-me na Rede Alumni</button>
      </div>
    </div>
  </form>
</div>
@endsection

