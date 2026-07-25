{{-- ISP-Bié Layout Base Oficial --}}
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ISP-Bié' }}</title>
    @php
        $manifest = file_exists(public_path('build/manifest.json')) ? json_decode(file_get_contents(public_path('build/manifest.json')), true) : null;
        $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
    @endphp
    @if($cssFile)
        <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
    @endif

    <style>
    /* Global responsive table cards: convert tables into stacked cards on narrow screens */
    @media (max-width:768px){
      .main-content table, .main-content table tbody, .main-content table tr, .main-content table td, .main-content table th { display:block; width:100%; }
      .main-content table thead { display:none; }
      .main-content table tr { margin-bottom:12px; border-bottom:1px solid #f1f5f9; padding-bottom:8px; }
      .main-content table td { display:flex; justify-content:space-between; align-items:center; padding:8px 12px; }
      .main-content table td:before { content: attr(data-label); font-weight:700; color:#475569; margin-right:8px; flex-shrink:0; }
    }
    </style>
</head>
<body class="bg-white text-gray-900 min-h-screen flex flex-col">
    {{-- Header institucional --}}
    <header class="w-full bg-ispbie-blue text-white py-4 shadow-md">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4">
            <a href="/" class="font-bold text-xl tracking-tight">ISP-Bié</a>
            <nav class="space-x-6">
                <a href="/cursos" class="hover:underline">Cursos</a>
                <a href="/noticias" class="hover:underline">Notícias</a>
                <a href="/contato" class="hover:underline">Contato</a>
            </nav>
        </div>
    </header>

    {{-- Conteúdo principal --}}
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 py-10">
        @yield('content')
    </main>

    {{-- Footer institucional --}}
    <footer class="w-full bg-ispbie-dark text-white py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <span>&copy; {{ date('Y') }} ISP-Bié. Todos os direitos reservados.</span>
            <span class="text-sm">Desenvolvido com <span class="text-ispbie-orange">&#10084;</span> por Equipa Web</span>
        </div>
    </footer>
<script>
// Auto-assign data-label attributes to table cells from their headers for responsive stacks
(function(){
  function applyDataLabels(root){
    document.querySelectorAll(root + ' table').forEach(function(table){
      var headers = Array.from(table.querySelectorAll('thead th')).map(function(th){ return th.innerText.trim(); });
      if(headers.length===0) return;
      table.querySelectorAll('tbody tr').forEach(function(tr){
        Array.from(tr.querySelectorAll('td')).forEach(function(td, i){
          if(!td.hasAttribute('data-label')) td.setAttribute('data-label', headers[i] || '');
        });
      });
    });
  }
  document.addEventListener('DOMContentLoaded', function(){ applyDataLabels('.main-content'); });
  var t; window.addEventListener('resize', function(){ clearTimeout(t); t=setTimeout(function(){ applyDataLabels('.main-content'); },250); });
})();
</script>
</body>
</html>
