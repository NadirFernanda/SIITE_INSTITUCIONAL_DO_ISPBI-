<div style="font-family: Arial, Helvetica, sans-serif; color: #333;">
    <h2>Submissão recebida e pendente para  avaliação.</h2>

    <p>Submissão recebida e pendente para  avaliação.</p>

    <p><strong>Autor:</strong> {{ $submission->author }}</p>
    <p><strong>Título:</strong> {{ $submission->title }}</p>
    <p><strong>Categoria:</strong> {{ $submission->category ?? '—' }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Filiação:</strong> {{ $submission->affiliation ?? '—' }}</p>

    <p><strong>Descrição:</strong><br>{{ $submission->description }}</p>

    @if($submission->link && preg_match('/^https?:\/\//i', $submission->link))
        <p><strong>Link:</strong> <a href="{{ $submission->link }}">{{ $submission->link }}</a></p>
    @endif

    <p>Para avaliar a submissão, aceda ao painel administrativo: <a href="{{ url('/admin/revistas/submissions') }}">Painel de Submissões</a>.</p>

    <p>Atenciosamente,<br>ISP-Bié</p>
</div>
