@extends('layouts.admin')

@section('content')
<style>
    .cal-wrap{max-width:1040px;margin:auto;color:#334155}.cal-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:24px}.cal-head h1{font-size:2rem;line-height:1.2;color:#1e3a5f;margin:0}.cal-head p{margin:8px 0 0;color:#64748b}.cal-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:clamp(18px,4vw,28px);box-shadow:0 2px 8px rgba(21,101,192,.06);margin-bottom:22px}.cal-card h2{font-size:1.3rem;color:#1e3a5f;margin:0 0 8px}.cal-muted{color:#64748b;line-height:1.55}.cal-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.cal-form{display:grid;gap:12px}.cal-field{display:grid;gap:5px;font-weight:700;color:#334155}.cal-field input,.cal-field select,.cal-field textarea{box-sizing:border-box;width:100%;padding:10px 12px;border:1px solid #cbd5e1;border-radius:8px;font:inherit;color:#1e293b;background:#fff}.cal-field textarea{min-height:80px;resize:vertical}.cal-button{justify-self:start;border:0;border-radius:8px;background:#1e3a5f;color:#fff;font:inherit;font-weight:700;padding:11px 18px;cursor:pointer}.cal-button-danger{background:#fff;border:1px solid #b91c1c;color:#b91c1c}.cal-link{color:#1e3a5f;font-weight:700;text-decoration:underline}.cal-check{display:flex;align-items:flex-start;gap:9px;line-height:1.4}.cal-check input{margin-top:3px}.cal-status{display:inline-block;border-radius:999px;background:#f1f5f9;color:#475569;font-size:.88rem;font-weight:700;padding:6px 12px}.cal-activity{border:1px solid #e2e8f0;border-left:4px solid #F05A28;border-radius:10px;padding:16px;margin-top:12px}.cal-actions{display:flex;flex-wrap:wrap;gap:16px;align-items:center}.cal-preview{display:flex;flex-wrap:wrap;gap:14px;align-items:center;margin:16px 0}.cal-note{border-left:4px solid #F05A28;background:#fff7ed;padding:12px 15px;border-radius:8px;color:#7c2d12}@media(max-width:680px){.cal-grid{grid-template-columns:1fr}.cal-wrap{min-width:0}.cal-card{padding:18px}}
</style>
<div class="cal-wrap">
    <header class="cal-head">
        <div>
            <h1>Calendário Académico</h1>
            <p>Prepare o rascunho, pré-visualize e publique apenas após aprovação institucional.</p>
        </div>
        <a class="cal-link" href="{{ route('calendario-academico') }}" target="_blank" rel="noopener">Ver página pública</a>
    </header>

    @if(session('success'))
        <p role="status" style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 16px;border-radius:8px;">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <div role="alert" style="background:#fef2f2;border:1px solid #fca5a5;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="margin:3px 0;">{{ $error }}</p>@endforeach
        </div>
    @endif

    <section class="cal-card" aria-labelledby="cal-publicado">
        <h2 id="cal-publicado">Versão publicada</h2>
        @if($published)
            <p class="cal-status">Publicado: {{ $published['ano'] }}</p>
            <p class="cal-muted">{{ count($published['atividades']) }} actividade(s) registada(s). {{ \App\Support\AcademicCalendar::hasPdf($published) ? 'PDF oficial disponível.' : 'Sem PDF disponível.' }}</p>
            <form method="POST" action="{{ route('admin.calendario-academico.despublicar') }}" class="cal-form" style="border-top:1px solid #e2e8f0;padding-top:16px;">
                @csrf
                <label class="cal-check"><input type="checkbox" name="confirmar_retirada" value="1" required> Confirmo que quero retirar o calendário da página pública. O rascunho não será apagado.</label>
                <button class="cal-button cal-button-danger" type="submit">Retirar de publicação</button>
            </form>
        @else
            <p class="cal-muted">Ainda não há calendário académico publicado.</p>
        @endif
    </section>

    <section class="cal-card" aria-labelledby="cal-rascunho">
        <h2 id="cal-rascunho">Rascunho e ano académico</h2>
        @if($draft)
            <p class="cal-status">Rascunho: {{ $draft['ano'] }}</p>
            <p class="cal-muted">{{ count($draft['atividades']) }} actividade(s). {{ \App\Support\AcademicCalendar::hasPdf($draft) ? 'PDF carregado.' : 'Sem PDF carregado.' }} As alterações no rascunho não modificam a versão publicada.</p>
            <div class="cal-preview">
                <a class="cal-link" href="{{ route('admin.calendario-academico.preview') }}" target="_blank" rel="noopener">Pré-visualizar calendário</a>
                @if(\App\Support\AcademicCalendar::hasPdf($draft))
                    <a class="cal-link" href="{{ route('admin.calendario-academico.documento.preview') }}" target="_blank" rel="noopener">Pré-visualizar PDF privado</a>
                @endif
            </div>
        @else
            <p class="cal-muted">Crie um rascunho com o ano do calendário oficial aprovado.</p>
        @endif
        <form method="POST" action="{{ route('admin.calendario-academico.rascunho') }}" class="cal-form">
            @csrf
            <label class="cal-field" for="cal-ano">{{ $draft ? 'Iniciar outro rascunho' : 'Ano académico' }}
                <input id="cal-ano" name="ano" type="text" inputmode="numeric" pattern="20[0-9]{2}/20[0-9]{2}" placeholder="2026/2027" maxlength="9" required value="{{ old('ano') }}">
            </label>
            @if($draft)
                <label class="cal-check"><input type="checkbox" name="confirmar_substituicao" value="1" required> Confirmo que quero iniciar um rascunho vazio. O rascunho actual será substituído; a versão publicada mantém-se.</label>
            @endif
            <button class="cal-button" type="submit">{{ $draft ? 'Iniciar novo rascunho' : 'Criar rascunho' }}</button>
        </form>
    </section>

    @if($draft)
        <section class="cal-card" aria-labelledby="cal-pdf">
            <h2 id="cal-pdf">PDF oficial do rascunho</h2>
            <p class="cal-muted">O documento fica em armazenamento privado. Só se torna público quando este rascunho for publicado.</p>
            <form method="POST" action="{{ route('admin.calendario-academico.documento.upload') }}" enctype="multipart/form-data" class="cal-form">
                @csrf
                <label class="cal-field" for="cal-documento">Carregar ou substituir PDF
                    <input id="cal-documento" type="file" name="documento" accept=".pdf,application/pdf" required>
                </label>
                <p class="cal-muted" style="margin:0;font-size:.9rem;">PDF válido, até 25 MB. A versão publicada continua disponível até à aprovação do novo rascunho.</p>
                <button class="cal-button" type="submit">Guardar PDF no rascunho</button>
            </form>
            @if(\App\Support\AcademicCalendar::hasPdf($draft))
                <form method="POST" action="{{ route('admin.calendario-academico.documento.remove') }}" class="cal-form" style="border-top:1px solid #e2e8f0;margin-top:22px;padding-top:18px;">
                    @csrf
                    @method('DELETE')
                    <label class="cal-check"><input type="checkbox" name="confirmar_remocao" value="1" required> Confirmo que quero retirar o PDF deste rascunho. O PDF publicado mantém-se.</label>
                    <button class="cal-button cal-button-danger" type="submit">Retirar PDF do rascunho</button>
                </form>
            @endif
        </section>

        <section class="cal-card" aria-labelledby="cal-actividades">
            <h2 id="cal-actividades">Actividades por semestre</h2>
            <p class="cal-muted">Introduza apenas actividades e datas confirmadas para {{ $draft['ano'] }}.</p>
            <form method="POST" action="{{ route('admin.calendario-academico.actividades.store') }}" class="cal-form">
                @csrf
                <div class="cal-grid">
                    <label class="cal-field">Semestre
                        <select name="semestre" required><option value="1">Primeiro Semestre</option><option value="2">Segundo Semestre</option></select>
                    </label>
                    <label class="cal-field">Título
                        <input name="titulo" type="text" maxlength="160" required>
                    </label>
                    <label class="cal-field">Data de início
                        <input name="inicio" type="date" required>
                    </label>
                    <label class="cal-field">Data de fim
                        <input name="fim" type="date" required>
                    </label>
                </div>
                <label class="cal-field">Descrição (opcional)
                    <textarea name="descricao" maxlength="1000"></textarea>
                </label>
                <button class="cal-button" type="submit">Adicionar ao rascunho</button>
            </form>

            @foreach([1 => 'Primeiro Semestre', 2 => 'Segundo Semestre'] as $semester => $label)
                <h3 style="color:#1e3a5f;margin:30px 0 6px;">{{ $label }}</h3>
                @forelse(collect($draft['atividades'])->where('semestre', $semester)->sortBy('inicio') as $activity)
                    <article class="cal-activity">
                        <strong style="color:#1e3a5f;">{{ $activity['titulo'] }}</strong>
                        <p class="cal-muted" style="margin:5px 0 12px;">{{ $activity['inicio'] }}{{ $activity['fim'] !== $activity['inicio'] ? ' – '.$activity['fim'] : '' }}</p>
                        <details>
                            <summary class="cal-link" style="cursor:pointer;">Editar actividade</summary>
                            <form method="POST" action="{{ route('admin.calendario-academico.actividades.update', $activity['id']) }}" class="cal-form" style="margin-top:15px;">
                                @csrf
                                @method('PATCH')
                                <div class="cal-grid">
                                    <label class="cal-field">Semestre<select name="semestre" required><option value="1" @selected($activity['semestre'] === 1)>Primeiro Semestre</option><option value="2" @selected($activity['semestre'] === 2)>Segundo Semestre</option></select></label>
                                    <label class="cal-field">Título<input name="titulo" value="{{ $activity['titulo'] }}" type="text" maxlength="160" required></label>
                                    <label class="cal-field">Data de início<input name="inicio" value="{{ $activity['inicio'] }}" type="date" required></label>
                                    <label class="cal-field">Data de fim<input name="fim" value="{{ $activity['fim'] }}" type="date" required></label>
                                </div>
                                <label class="cal-field">Descrição<textarea name="descricao" maxlength="1000">{{ $activity['descricao'] }}</textarea></label>
                                <button class="cal-button" type="submit">Guardar alteração</button>
                            </form>
                        </details>
                        <form method="POST" action="{{ route('admin.calendario-academico.actividades.destroy', $activity['id']) }}" class="cal-form" style="border-top:1px solid #e2e8f0;margin-top:16px;padding-top:14px;">
                            @csrf
                            @method('DELETE')
                            <label class="cal-check"><input type="checkbox" name="confirmar_remocao" value="1" required> Confirmo a remoção desta actividade do rascunho.</label>
                            <button class="cal-button cal-button-danger" type="submit">Remover actividade</button>
                        </form>
                    </article>
                @empty
                    <p class="cal-muted">Sem actividades neste semestre.</p>
                @endforelse
            @endforeach
        </section>

        <section class="cal-card" aria-labelledby="cal-publicar">
            <h2 id="cal-publicar">Publicação</h2>
            <p class="cal-note">Confirme o ano, todas as datas, as actividades e o PDF na pré-visualização antes de publicar. A publicação substitui a versão actualmente visível num único passo.</p>
            <div class="cal-preview"><a class="cal-link" href="{{ route('admin.calendario-academico.preview') }}" target="_blank" rel="noopener">Abrir pré-visualização</a></div>
            <form method="POST" action="{{ route('admin.calendario-academico.publicar') }}" class="cal-form">
                @csrf
                <input type="hidden" name="revisao" value="{{ $draftRevision }}">
                <label class="cal-check"><input type="checkbox" name="confirmar_publicacao" value="1" required> Confirmo que o calendário académico {{ $draft['ano'] }} foi aprovado para publicação institucional.</label>
                <button class="cal-button" type="submit">Publicar calendário</button>
            </form>
        </section>
    @endif
</div>
@endsection
