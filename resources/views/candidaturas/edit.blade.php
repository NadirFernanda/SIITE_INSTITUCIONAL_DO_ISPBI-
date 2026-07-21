@extends($layout)

@section('content')
@php
$accent     = $routePrefix === 'admin' ? '#1565c0' : '#0e5c2f';
$accentDark = $routePrefix === 'admin' ? '#0d47a1' : '#14532d';
$inp        = 'width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;box-sizing:border-box;';
$backRoute  = route($routePrefix.'.candidaturas.show', $candidatura);
$formAction = route($routePrefix.'.candidaturas.update', $candidatura);
$trabAtual  = old('trabalhador', $candidatura->trabalhador ? 'sim' : 'nao');
@endphp
<div style="max-width:900px;margin:0 auto;">

    <a href="{{ $backRoute }}"
       style="display:inline-flex;align-items:center;gap:6px;color:{{ $accent }};font-weight:600;font-size:0.9rem;text-decoration:none;margin-bottom:22px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar ao candidato
    </a>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;">
        <h1 style="font-size:1.3rem;font-weight:700;color:{{ $accent }};margin:0 0 4px;">
            Editar Candidatura #{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}
        </h1>
        <p style="color:#64748b;font-size:0.88rem;margin:0 0 24px;">
            {{ $candidatura->nome }} — {{ $candidatura->curso }} ({{ $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }})
        </p>

        @if($errors->any())
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:20px;">
            <strong>Corrija os seguintes erros:</strong>
            <ul style="margin:6px 0 0 16px;font-size:0.88rem;">
                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ $formAction }}" novalidate>
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Nome Completo <span style="color:#ef4444">*</span></label>
                <input type="text" name="nome" value="{{ old('nome', $candidatura->nome) }}" required maxlength="255"
                       style="{{ $inp }}@error('nome')border-color:#f87171;@enderror">
                @error('nome')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            {{-- Filiação --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Filho(a) de (pai)</label>
                    <input type="text" name="filiacao_pai" value="{{ old('filiacao_pai', $candidatura->filiacao_pai) }}" maxlength="255" style="{{ $inp }}">
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">e de (mãe)</label>
                    <input type="text" name="filiacao_mae" value="{{ old('filiacao_mae', $candidatura->filiacao_mae) }}" maxlength="255" style="{{ $inp }}">
                </div>
            </div>

            {{-- Data Nascimento --}}
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Data de Nascimento <span style="color:#ef4444">*</span></label>
                <input type="date" name="data_nascimento"
                       value="{{ old('data_nascimento', $candidatura->data_nascimento?->format('Y-m-d')) }}"
                       required max="{{ now()->subYears(17)->format('Y-m-d') }}"
                       style="{{ $inp }}max-width:200px;">
                <span style="font-size:0.76rem;color:#94a3b8;margin-left:8px;">Idade mínima: 17 anos</span>
                @error('data_nascimento')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            {{-- Naturalidade --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Província de Naturalidade <span style="color:#ef4444">*</span></label>
                    <select id="edit-provincia" name="naturalidade_provincia" required
                            data-old="{{ old('naturalidade_provincia', $candidatura->naturalidade_provincia) }}"
                            style="{{ $inp }}">
                        <option value="">Seleccione a província</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Município de Naturalidade <span style="color:#ef4444">*</span></label>
                    <select id="edit-municipio" name="naturalidade_municipio" required
                            data-old="{{ old('naturalidade_municipio', $candidatura->naturalidade_municipio) }}"
                            style="{{ $inp }}">
                        <option value="">Seleccione primeiro a província</option>
                    </select>
                </div>
            </div>

            {{-- BI --}}
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">BI / Passaporte N.º <span style="color:#ef4444">*</span></label>
                    <input type="text" name="bi" value="{{ old('bi', $candidatura->bi) }}" required maxlength="20" style="{{ $inp }}">
                    @error('bi')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Emitido em (local) <span style="color:#ef4444">*</span></label>
                    <input type="text" name="bi_emitido_em" value="{{ old('bi_emitido_em', $candidatura->bi_emitido_em) }}" required maxlength="255" style="{{ $inp }}">
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Data de Emissão <span style="color:#ef4444">*</span></label>
                    <input type="date" name="bi_data_emissao"
                           value="{{ old('bi_data_emissao', $candidatura->bi_data_emissao?->format('Y-m-d')) }}"
                           required style="{{ $inp }}">
                </div>
            </div>

            {{-- Sexo + Estado Civil --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Sexo <span style="color:#ef4444">*</span></label>
                    <div style="display:flex;gap:18px;margin-top:2px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="sexo" value="masculino"
                                   {{ old('sexo', $candidatura->sexo) === 'masculino' ? 'checked' : '' }} required> Masculino
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="sexo" value="feminino"
                                   {{ old('sexo', $candidatura->sexo) === 'feminino' ? 'checked' : '' }}> Feminino
                        </label>
                    </div>
                    @error('sexo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Estado Civil <span style="color:#ef4444">*</span></label>
                    <input type="text" name="estado_civil" value="{{ old('estado_civil', $candidatura->estado_civil) }}"
                           required maxlength="100" placeholder="Ex: Solteiro(a)" style="{{ $inp }}">
                </div>
            </div>

            {{-- Necessidade Especial --}}
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Necessidade de Educação Especial <span style="color:#ef4444">*</span></label>
                <input type="text" name="necessidade_especial"
                       value="{{ old('necessidade_especial', $candidatura->necessidade_especial) }}"
                       required maxlength="255" placeholder="Escreva 'Nenhuma' se não aplicável" style="{{ $inp }}">
            </div>

            {{-- Residência --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Residência — Município <span style="color:#ef4444">*</span></label>
                    <input type="text" name="residencia_municipio"
                           value="{{ old('residencia_municipio', $candidatura->residencia_municipio) }}"
                           required maxlength="255" style="{{ $inp }}">
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Residência — Rua/Bairro <span style="color:#ef4444">*</span></label>
                    <input type="text" name="residencia_bairro"
                           value="{{ old('residencia_bairro', $candidatura->residencia_bairro) }}"
                           required maxlength="255" style="{{ $inp }}">
                </div>
            </div>

            {{-- Contactos --}}
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Telefone 1 <span style="color:#ef4444">*</span></label>
                    <input type="tel" name="telefone" value="{{ old('telefone', $candidatura->telefone) }}" required maxlength="50" style="{{ $inp }}">
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Telefone 2</label>
                    <input type="tel" name="telefone2" value="{{ old('telefone2', $candidatura->telefone2) }}" maxlength="50" style="{{ $inp }}">
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Email <span style="color:#ef4444">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $candidatura->email) }}" required maxlength="255" style="{{ $inp }}">
                    @error('email')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Habilitações --}}
            <div style="display:grid;grid-template-columns:1fr 2fr;gap:12px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Habilitações Literárias <span style="color:#ef4444">*</span></label>
                    <input type="text" name="habilitacoes" value="{{ old('habilitacoes', $candidatura->habilitacoes) }}"
                           required maxlength="100" placeholder="Ex: 12ª Classe" style="{{ $inp }}">
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Escola de Proveniência <span style="color:#ef4444">*</span></label>
                    <input type="text" name="escola_origem" value="{{ old('escola_origem', $candidatura->escola_origem) }}"
                           required maxlength="255" style="{{ $inp }}">
                </div>
            </div>

            {{-- Perfil de Acesso --}}
            @php $editOldPerf = old('perfil', $candidatura->perfil ?? ''); @endphp
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Perfil do Curso de Proveniência <span style="color:#ef4444">*</span></label>
                <select name="perfil" id="edit-perfil"
                        data-perfis-curso="{{ json_encode(\App\Models\Candidatura::$perfisCurso, JSON_UNESCAPED_UNICODE) }}"
                        data-todos-cursos="{{ json_encode(\App\Models\Candidatura::$cursos, JSON_UNESCAPED_UNICODE) }}"
                        style="{{ $inp }}@error('perfil')border-color:#f87171;@enderror">
                    <option value="">— Seleccione o perfil do curso de origem —</option>
                    @foreach(\App\Models\Candidatura::todosOsPerfis() as $p)
                        <option value="{{ $p }}" {{ $editOldPerf === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                    <option value="Outro" {{ $editOldPerf === 'Outro' ? 'selected' : '' }}>Outro — Perfil não listado</option>
                </select>
                <p style="font-size:0.74rem;color:#94a3b8;margin-top:4px;">Os cursos disponíveis são filtrados automaticamente pelo perfil.</p>
                <div id="edit-perfil-info" style="display:none;margin-top:8px;padding:9px 13px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:7px;font-size:0.8rem;color:#1e40af;line-height:1.5;"></div>
                @error('perfil')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            {{-- Ano Conclusão --}}
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Ano de Conclusão <span style="color:#ef4444">*</span></label>
                <input type="number" name="ano_conclusao"
                       value="{{ old('ano_conclusao', $candidatura->ano_conclusao) }}"
                       required min="1990" max="{{ date('Y') }}"
                       style="width:140px;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;">
                @error('ano_conclusao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            {{-- Estado Financeiro --}}
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Estado Financeiro da Família <span style="color:#ef4444">*</span></label>
                <div style="display:flex;gap:18px;margin-top:2px;">
                    @foreach(['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'] as $v=>$l)
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="estado_financeiro" value="{{ $v }}"
                               {{ old('estado_financeiro', $candidatura->estado_financeiro) === $v ? 'checked' : '' }} required> {{ $l }}
                    </label>
                    @endforeach
                </div>
                @error('estado_financeiro')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            {{-- Trabalhador --}}
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Trabalhador <span style="color:#ef4444">*</span></label>
                <div style="display:flex;gap:18px;align-items:center;flex-wrap:wrap;margin-top:2px;">
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="trabalhador" value="sim"
                               {{ $trabAtual === 'sim' ? 'checked' : '' }} required
                               onchange="document.getElementById('edit-inst').style.display='block'"> Sim
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="trabalhador" value="nao"
                               {{ $trabAtual === 'nao' ? 'checked' : '' }}
                               onchange="document.getElementById('edit-inst').style.display='none'"> Não
                    </label>
                    <div id="edit-inst" style="display:{{ $trabAtual === 'sim' ? 'block' : 'none' }};flex:1;min-width:220px;">
                        <input type="text" name="instituicao_laboral"
                               value="{{ old('instituicao_laboral', $candidatura->instituicao_laboral) }}"
                               maxlength="255" placeholder="Nome da Instituição Laboral" style="{{ $inp }}">
                        @error('instituicao_laboral')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
                    </div>
                </div>
                @error('trabalhador')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            {{-- Curso + Período --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:28px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Curso <span style="color:#ef4444">*</span></label>
                    @php
                    $editOldCurso  = old('curso', $candidatura->curso ?? '');
                    $editOldPerfilV = old('perfil', $candidatura->perfil ?? '');
                    @endphp
                    <select name="curso" id="edit-curso" required
                            data-old-value="{{ old('curso', $candidatura->curso ?? '') }}"
                            style="{{ $inp }}">
                        <option value="">— Seleccione o curso —</option>
                        @foreach(\App\Models\Candidatura::$cursos as $c)
                            @php
                            $editPerfisC = \App\Models\Candidatura::$perfisCurso[$c] ?? [];
                            $editElegivel = empty($editPerfisC) || !$editOldPerfilV || in_array($editOldPerfilV, $editPerfisC);
                            @endphp
                            @if($editElegivel)
                                <option value="{{ $c }}" {{ $editOldCurso === $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('curso')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Período <span style="color:#ef4444">*</span></label>
                    <div style="display:flex;gap:18px;margin-top:4px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="periodo" value="regular"
                                   {{ old('periodo', $candidatura->periodo) === 'regular' ? 'checked' : '' }} required> Regular
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="periodo" value="pos-laboral"
                                   {{ old('periodo', $candidatura->periodo) === 'pos-laboral' ? 'checked' : '' }}> Pós-laboral
                        </label>
                    </div>
                    @error('periodo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Local de Inscrição --}}
            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Local de Inscrição <span style="color:#ef4444">*</span></label>
                <div style="display:flex;gap:20px;margin-top:4px;flex-wrap:wrap;">
                    @foreach(\App\Models\Candidatura::$locaisInscricao as $val => $label)
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="local_inscricao" value="{{ $val }}"
                               {{ old('local_inscricao', $candidatura->local_inscricao) === $val ? 'checked' : '' }} required> {{ $label }}
                    </label>
                    @endforeach
                </div>
                @error('local_inscricao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit"
                        style="background:{{ $accent }};color:#fff;border:none;border-radius:10px;padding:11px 28px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                        onmouseover="this.style.background='{{ $accentDark }}'" onmouseout="this.style.background='{{ $accent }}'">
                    Guardar Alterações
                </button>
                <a href="{{ $backRoute }}"
                   style="display:inline-flex;align-items:center;padding:11px 20px;border:1px solid #e2e8f0;border-radius:10px;color:#64748b;font-weight:600;font-size:0.9rem;text-decoration:none;background:#fff;"
                   onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/provincias-angola.js') }}"></script>
<script src="{{ asset('js/perfil-curso.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var prov = document.getElementById('edit-provincia');
    var mun  = document.getElementById('edit-municipio');
    if (prov) { prov.id = 'select-provincia'; }
    if (mun)  { mun.id  = 'select-municipio'; }
});
</script>
@endpush
@endsection
