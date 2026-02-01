@extends('layouts.site')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
      <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Pilares Estratégicos
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Pilares Estratégicos</h1>
        <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
      </div>

<!-- Conteúdo Principal -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
      <div class="lg:col-span-3">
        <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg prose max-w-2xl mx-auto">
      <h2 class="text-2xl font-bold text-[#2563eb] mb-6">Pilares Estratégicos</h2>

      <p class="mb-8">O Instituto Superior Politécnico do Bié (ISP-Bié) estrutura a sua actuação institucional com base em pilares estratégicos que orientam o cumprimento da sua missão académica, científica e social.<br><br>Estes pilares refletem o compromisso da instituição com a formação de qualidade, a produção de conhecimento, o desenvolvimento da comunidade e a promoção de soluções inovadoras para os desafios actuais.</p>

      <hr class="my-10" />

      <h3 id="ensino" class="text-xl font-semibold text-[#2563eb] mt-10 mb-4">Ensino</h3>
      <p class="mb-6">O ensino constitui o pilar central do ISP-Bié, orientado para a formação de profissionais qualificados, éticos e capazes de responder às exigências do mercado de trabalho e da sociedade.<br><br>A instituição aposta num ensino superior de qualidade, assente em currículos actualizados, rigor científico e integração entre teoria e prática.</p>
      <p class="mb-8">O ISP-Bié valoriza o desenvolvimento de competências técnicas, científicas e humanas, promovendo o pensamento crítico, a autonomia intelectual e a aprendizagem contínua.<br><br>A melhoria permanente dos métodos de ensino, a capacitação do corpo docente e o uso responsável das tecnologias educativas são prioridades neste pilar.</p>

      <hr class="my-10" />

      <h3 id="investigacao" class="text-xl font-semibold text-[#2563eb] mt-10 mb-4">Investigação</h3>
      <p class="mb-6">A investigação científica é um eixo fundamental para o avanço do conhecimento e para a consolidação do ensino superior.<br><br>O ISP-Bié incentiva a produção científica, a investigação aplicada e a participação activa de docentes e estudantes em projectos de investigação que contribuam para o desenvolvimento local, regional e nacional.</p>
      <p class="mb-8">Este pilar promove a cultura de investigação, a divulgação científica e a cooperação com outras instituições académicas e centros de investigação, nacionais e internacionais,<br><br>reforçando o papel da universidade como produtora de conhecimento relevante e socialmente útil.</p>

      <hr class="my-10" />

      <h3 id="extensao-universitaria" class="text-xl font-semibold text-[#2563eb] mt-10 mb-4">Extensão Universitária</h3>
      <p class="mb-6">A extensão universitária representa o compromisso do ISP-Bié com a sociedade.<br><br>Por meio deste pilar, a instituição promove a interacção entre a universidade e a comunidade, colocando o conhecimento académico ao serviço do desenvolvimento social, económico e cultural.</p>
      <p class="mb-8">As acções de extensão incluem programas comunitários, prestação de serviços, actividades de formação, palestras, projectos sociais e parcerias com instituições públicas e privadas.<br><br>Este pilar fortalece a responsabilidade social da universidade e aproxima o ensino superior das reais necessidades da população.</p>

      <hr class="my-10" />

      <h3 id="empreendedorismo-inovacao" class="text-xl font-semibold text-[#2563eb] mt-10 mb-4">Empreendedorismo e Inovação na Universidade</h3>
      <p class="mb-6">O pilar de Empreendedorismo e Inovação visa estimular a criatividade, a iniciativa e a capacidade de transformar conhecimento em soluções práticas.<br><br>O ISP-Bié promove uma cultura empreendedora que incentive estudantes e docentes a desenvolver ideias inovadoras, projectos sustentáveis e iniciativas com impacto económico e social.</p>
      <p class="mb-4">Este pilar apoia a criação de startups, o desenvolvimento de projectos tecnológicos, a inovação nos processos académicos e administrativos e a ligação entre a universidade, o sector produtivo e a sociedade.<br><br>O objectivo é formar profissionais capazes de criar oportunidades, gerar valor e contribuir activamente para o desenvolvimento do país.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
