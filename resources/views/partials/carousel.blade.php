<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="carousel relative overflow-hidden rounded-lg shadow-sm bg-white">
    <div class="carousel-track flex transition-transform duration-700">
      @php($carrosseis = \App\Models\Carrossel::where('publicado', 1)->orderBy('ordem')->get())
      @if($carrosseis->count())
        @foreach($carrosseis as $item)
        <div class="carousel-slide min-w-full p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
              <h3 class="text-2xl font-bold">{{ $item->titulo }}</h3>
              @if($item->link)
                <a href="{{ $item->link }}" class="mt-4 inline-block link-brand">Ler mais →</a>
              @endif
            </div>
            <div class="max-h-40 h-40 md:h-40 bg-gray-100 rounded-lg flex items-center justify-center">
              <img src="{{ asset('storage/' . $item->imagem) }}" alt="{{ $item->titulo }}" class="object-cover max-h-40 w-full rounded-lg" style="height:160px;" onerror="this.style.display='none'">
            </div>
          </div>
        </div>
        @endforeach
      @else
        <!-- Slides mockados -->
        <div class="carousel-slide min-w-full p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
              <h3 class="text-2xl font-bold">Inauguração do novo laboratório</h3>
              <p class="mt-3 text-gray-600">Espaço equipado para práticas e pesquisa em informática.</p>
              <a href="/noticias" class="mt-4 inline-block link-brand">Ler mais →</a>
            </div>
            <div class="h-48 md:h-40 bg-gray-100 rounded-lg flex items-center justify-center">
              <img src="/images/investigacao.jpg" alt="Laboratório" class="object-cover h-full w-full rounded-lg" onerror="this.style.display='none'">
            </div>
          </div>
        </div>
        <div class="carousel-slide min-w-full p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
              <h3 class="text-2xl font-bold">Parcerias com a indústria local</h3>
              <p class="mt-3 text-gray-600">Acordos para estágios e desenvolvimento conjunto de projetos.</p>
              <a href="/noticias" class="mt-4 inline-block link-brand">Ler mais →</a>
            </div>
            <div class="h-48 md:h-40 bg-gray-100 rounded-lg flex items-center justify-center">
              <img src="/images/extensao.jpg" alt="Parcerias" class="object-cover h-full w-full rounded-lg" onerror="this.style.display='none'">
            </div>
          </div>
        </div>
        <div class="carousel-slide min-w-full p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
              <h3 class="text-2xl font-bold">Semana Acadêmica 2026</h3>
              <p class="mt-3 text-gray-600">Palestras, workshops e feira de emprego para estudantes.</p>
              <a href="/noticias" class="mt-4 inline-block link-brand">Ler mais →</a>
            </div>
            <div class="h-48 md:h-40 bg-gray-100 rounded-lg flex items-center justify-center">
              <img src="/images/campus-hero.jpg" alt="Semana Acadêmica" class="object-cover h-full w-full rounded-lg" onerror="this.style.display='none'">
            </div>
          </div>
        </div>
      @endif
    </div>

    <!-- Controls -->
    <button class="carousel-prev absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 rounded-full p-2 shadow hover:bg-white">&#x25C0;</button>
    <button class="carousel-next absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 rounded-full p-2 shadow hover:bg-white">&#x25B6;</button>

    <!-- Indicators -->
    <div class="carousel-indicators absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2"></div>
  </div>
</div>

