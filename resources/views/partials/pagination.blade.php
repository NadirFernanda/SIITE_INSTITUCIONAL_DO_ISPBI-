@if ($paginator->hasPages())
<nav role="navigation" aria-label="Navegação de paginação" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <p style="margin:0;font-size:0.85rem;color:#64748b;">
        Mostrando
        @if ($paginator->firstItem())
            <strong style="color:#1a2332;font-weight:700;">{{ $paginator->firstItem() }}</strong>
            a
            <strong style="color:#1a2332;font-weight:700;">{{ $paginator->lastItem() }}</strong>
        @else
            {{ $paginator->count() }}
        @endif
        de
        <strong style="color:#1a2332;font-weight:700;">{{ $paginator->total() }}</strong>
        resultados
    </p>

    <div style="display:flex;align-items:center;gap:4px;flex-wrap:wrap;">
        @php
            $btn = 'display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 10px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;color:#475569;font-size:0.85rem;font-weight:600;text-decoration:none;box-sizing:border-box;';
            $btnAtivo = 'display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 10px;border-radius:8px;border:1px solid #1e3a5f;background:#1e3a5f;color:#fff;font-size:0.85rem;font-weight:700;box-sizing:border-box;';
            $btnDesativado = 'display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 10px;border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;color:#cbd5e1;font-size:0.85rem;font-weight:600;box-sizing:border-box;cursor:not-allowed;';
        @endphp

        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <span style="{{ $btnDesativado }}" aria-hidden="true">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="{{ $btn }}" aria-label="Anterior"
               onmouseover="this.style.borderColor='#1e3a5f';this.style.color='#1e3a5f';" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';">&laquo;</a>
        @endif

        {{-- Páginas --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;color:#94a3b8;font-size:0.85rem;">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="{{ $btnAtivo }}" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="{{ $btn }}" aria-label="Ir para a página {{ $page }}"
                           onmouseover="this.style.borderColor='#1e3a5f';this.style.color='#1e3a5f';" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Próximo --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="{{ $btn }}" aria-label="Próximo"
               onmouseover="this.style.borderColor='#1e3a5f';this.style.color='#1e3a5f';" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';">&raquo;</a>
        @else
            <span style="{{ $btnDesativado }}" aria-hidden="true">&raquo;</span>
        @endif
    </div>
</nav>
@endif
