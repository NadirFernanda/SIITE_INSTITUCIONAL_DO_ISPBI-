<div style="font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color: #111827;">
    <h2>Novo Concurso Publicado</h2>
    <p><strong>{{ $concurso->title }}</strong></p>
    @if($concurso->summary)
        <p>{{ $concurso->summary }}</p>
    @endif
    <p>Publicado em: {{ optional($concurso->publish_at)->format('d/m/Y H:i') }}</p>

    @if($concurso->attachments->isNotEmpty())
        <p>Anexos disponíveis:</p>
        <ul>
            @foreach($concurso->attachments as $att)
                <li><a href="{{ config('app.url') . Storage::url($att->path) }}">{{ $att->original_name }}</a></li>
            @endforeach
        </ul>
    @endif

    <p>Consulte o painel administrativo para mais detalhes.</p>
</div>
