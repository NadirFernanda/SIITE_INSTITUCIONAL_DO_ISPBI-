@extends('layouts.site')

@section('title', 'Alumni — ISP-Bié')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-16">

@include('partials.page-hero', [
    'title'      => 'Alumni ISP-Bié',
    'subtitle'   => 'Rede de ex-estudantes, histórias de sucesso e oportunidades.',
    'breadcrumb' => 'Alumni',
    'gradient'   => 'from-[#1e3a5f] to-[#2563eb]',
    'ctaUrl'     => '#formulario',
    'ctaLabel'   => 'Juntar-me à Rede',
])

{{-- Intro strip --}}
<div class="mb-8 flex items-center gap-3">
    <span class="inline-block w-8 h-0.5 bg-[#F05A28]"></span>
    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Comunidade Alumni</p>
</div>

{{-- Histórico Alumni --}}
<section class="mb-12">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Histórico Alumni
    </h2>
    <p class="text-sm text-gray-500 mb-6">Conheça as histórias de sucesso, conquistas e trajetórias inspiradoras dos ex-estudantes do ISP-Bié.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @php
          $alumni = \App\Models\Alumnus::where('publicado', 1)->orderByDesc('id')->get();
        @endphp
        @forelse($alumni as $alumnus)
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow flex items-center gap-5">
            <div class="flex-shrink-0 w-14 h-14 rounded-full bg-[#1e3a5f] flex items-center justify-center text-white text-lg font-bold">
              {{ strtoupper(mb_substr($alumnus->nome, 0, 1)) }}{{ mb_strtoupper(mb_substr(explode(' ', $alumnus->nome)[count(explode(' ', $alumnus->nome))-1], 0, 1)) }}
            </div>
            <div class="min-w-0">
              <p class="font-bold text-[#1e3a5f]">{{ $alumnus->nome }}</p>
              <p class="text-sm text-gray-400 mb-2">
                {{ $alumnus->curso }}@if($alumnus->cargo) &bull; {{ $alumnus->cargo }}@endif
              </p>
              @php
                $satisfacao = trim((string) $alumnus->satisfacao);
                $hasDepoimento = $satisfacao && !preg_match('/^\d+$/', $satisfacao);
              @endphp
              @if($hasDepoimento)
                <p class="text-sm text-gray-600 italic">"{{ Str::limit($satisfacao, 200) }}"
                  @if(Str::length($satisfacao) > 200)
                    <a href="{{ route('alumni.show', $alumnus->id) }}" class="ml-1 text-[#2563eb] font-semibold hover:text-[#1d4ed8] text-xs">Ler mais</a>
                  @endif
                </p>
              @endif
            </div>
          </div>
        @empty
          <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center text-gray-400 col-span-2 text-sm">
            Nenhum histórico de alumni publicado ainda.
          </div>
        @endforelse
    </div>
</section>
{{-- Benefícios --}}
<section class="mb-12">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Benefícios da Comunidade Alumni
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        @foreach([
            ['icon'=>'🤝', 'title'=>'Networking',        'desc'=>'Conecte-se com ex-estudantes e amplie a sua rede profissional em Angola e no mundo.'],
            ['icon'=>'💼', 'title'=>'Oportunidades',     'desc'=>'Acesse vagas exclusivas de emprego e estágio divulgadas na rede alumni.'],
            ['icon'=>'🎓', 'title'=>'Eventos',           'desc'=>'Participe de eventos, reencontros e conferências exclusivas para alumni.'],
            ['icon'=>'📚', 'title'=>'Formação Contínua', 'desc'=>'Descontos em cursos de pós-graduação e formações especializadas.'],
        ] as $benefit)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="text-4xl mb-3">{{ $benefit['icon'] }}</div>
            <h3 class="font-bold text-[#1e3a5f] text-sm mb-2">{{ $benefit['title'] }}</h3>
            <p class="text-xs text-gray-500 leading-relaxed">{{ $benefit['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Estatísticas Alumni --}}
    @php
        $stats = \App\Models\AlumniStat::first();
        $alumni_count = $stats->alumni_count ?? 0;
        $employability = $stats->employability_percentage ?? 0;
        $countries = $stats->countries_count ?? 0;
        $companies = $stats->companies_founded ?? 0;
    @endphp
    <div class="rounded-2xl p-8 text-white" style="background:linear-gradient(135deg,#1e3a5f,#2563eb);">
        <h3 class="text-base font-bold mb-6 uppercase tracking-widest text-center opacity-90">Alumni em Números</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div><div class="text-4xl font-bold mb-1">{{ $alumni_count }}</div><div class="text-xs text-white/70 uppercase tracking-wide">Alumni Formados</div></div>
            <div><div class="text-4xl font-bold mb-1">{{ $employability }}%</div><div class="text-xs text-white/70 uppercase tracking-wide">Empregabilidade</div></div>
            <div><div class="text-4xl font-bold mb-1">{{ $countries }}</div><div class="text-xs text-white/70 uppercase tracking-wide">Países onde trabalham</div></div>
            <div><div class="text-4xl font-bold mb-1">{{ $companies }}</div><div class="text-xs text-white/70 uppercase tracking-wide">Empresas fundadas</div></div>
        </div>
    </div>
</section>

{{-- Formulário de registo --}}
<section id="formulario" class="mt-4">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Faça Parte da Rede Alumni
    </h2>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 max-w-2xl">
    @if(session('success'))
      <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-800 border border-green-200 text-sm">
        {{ session('success') }}
      </div>
    @endif
    @if($errors->any())
      <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-800 border border-red-200 text-sm">
        <ul class="list-disc list-inside space-y-1">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <h3 class="text-base font-bold text-[#1e3a5f] mb-6">Formulário de Alumni</h3>
    <form method="POST" action="{{ route('alumni.store') }}" class="space-y-5">
      @csrf
      <div x-data="{ trabalha: '' }">
        <div class="space-y-5">
          <div>
            <label for="nome" class="block text-sm font-semibold text-gray-700 mb-1">Nome completo <span class="text-red-500">*</span></label>
            <input type="text" id="nome" name="nome" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Digite o seu nome completo">
          </div>
          <div>
            <label for="curso" class="block text-sm font-semibold text-gray-700 mb-1">Curso que frequentou <span class="text-red-500">*</span></label>
            <select id="curso" name="curso" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition">
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
              <input type="number" id="ano" name="ano" min="1950" max="2100" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Ano">
            </div>
            <div class="flex-1">
              <label for="contacto" class="block text-sm font-semibold text-gray-700 mb-1">Contacto telefónico <span class="text-red-500">*</span></label>
              <input type="text" id="contacto" name="contacto" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="(+244) 9XX XXX XXX">
            </div>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Trabalha atualmente? <span class="text-red-500">*</span></label>
            <div class="flex gap-6">
              <label class="inline-flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="trabalha" value="sim" x-model="trabalha" required class="form-radio text-[#2563eb]">
                <span>Sim</span>
              </label>
              <label class="inline-flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="trabalha" value="nao" x-model="trabalha" required class="form-radio text-[#2563eb]">
                <span>Não</span>
              </label>
            </div>
          </div>
          <template x-if="trabalha === 'sim'">
            <div class="space-y-4">
              <div>
                <label for="empresa" class="block text-sm font-semibold text-gray-700 mb-1">Onde trabalha <span class="text-red-500">*</span></label>
                <input type="text" id="empresa" name="empresa" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Nome da empresa ou instituição">
              </div>
              <div>
                <label for="cargo" class="block text-sm font-semibold text-gray-700 mb-1">Cargo atual <span class="text-red-500">*</span></label>
                <input type="text" id="cargo" name="cargo" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="O seu cargo atual">
              </div>
              <div>
                <label for="satisfacao" class="block text-sm font-semibold text-gray-700 mb-1">Partilhe a sua experiência profissional <span class="text-red-500">*</span></label>
                <textarea id="satisfacao" name="satisfacao" rows="4" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Conte como tem sido a sua experiência profissional e o nível de satisfação"></textarea>
              </div>
            </div>
          </template>
          <div class="pt-2">
            <button type="submit" class="w-full bg-[#1e3a5f] hover:bg-[#2563eb] text-white font-bold py-3 px-6 rounded-xl transition-colors duration-200 text-sm">
              Cadastrar-me na Rede Alumni
            </button>
          </div>
        </div>
      </div>
    </form>
    </div>
</section>

</div>
@endsection
