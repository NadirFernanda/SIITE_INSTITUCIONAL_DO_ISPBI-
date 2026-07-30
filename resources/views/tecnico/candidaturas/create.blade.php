@extends('layouts.tecnico')

@section('content')
<div style="max-width:900px;margin:0 auto;">

    <a href="{{ route('tecnico.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#0e5c2f;font-weight:600;font-size:0.9rem;text-decoration:none;margin-bottom:22px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;">
        <h1 style="font-size:1.3rem;font-weight:700;color:#0e5c2f;margin:0 0 4px;">Registar Candidatura</h1>
        <p style="color:#64748b;font-size:0.88rem;margin:0 0 24px;">Todos os campos são obrigatórios excepto Telefone 2 e Instituição Laboral (se não trabalhar).</p>

        @if($errors->any())
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:20px;">
            <strong>Corrija os seguintes erros:</strong>
            <ul style="margin:6px 0 0 16px;font-size:0.88rem;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
        @endif

        @php $inp = 'width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;box-sizing:border-box;'; @endphp

        <form method="POST" action="{{ route('tecnico.candidaturas.store') }}" novalidate>
            @csrf

            {{-- Secção helper --}}
            @php
            function tc_label($text, $req = true) {
                $star = $req ? ' <span style="color:#ef4444">*</span>' : '';
                echo '<label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">'.$text.$star.'</label>';
            }
            @endphp

            {{-- Nome --}}
            <div style="margin-bottom:14px;">
                @php tc_label('Nome Completo') @endphp
                <input type="text" name="nome" value="{{ old('nome') }}" required maxlength="255" style="{{ $inp }}@error('nome')border-color:#f87171;@enderror">
                @error('nome')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
            </div>

            {{-- Filiação --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    @php tc_label('Filho(a) de (pai)') @endphp
                    <input type="text" name="filiacao_pai" value="{{ old('filiacao_pai') }}" required maxlength="255" style="{{ $inp }}">
                </div>
                <div>
                    @php tc_label('e de (mãe)') @endphp
                    <input type="text" name="filiacao_mae" value="{{ old('filiacao_mae') }}" required maxlength="255" style="{{ $inp }}">
                </div>
            </div>

            {{-- Data Nascimento --}}
            <div style="margin-bottom:14px;">
                @php tc_label('Data de Nascimento') @endphp
                <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}" required
                       max="{{ now()->subYears(17)->format('Y-m-d') }}"
                       style="{{ $inp }}max-width:200px;">
                <span style="font-size:0.76rem;color:#94a3b8;margin-left:8px;">Idade mínima: 17 anos</span>
                @error('data_nascimento')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
            </div>

            {{-- Naturalidade --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    @php tc_label('Província de Naturalidade') @endphp
                    <select id="t-provincia" name="naturalidade_provincia" required data-old="{{ old('naturalidade_provincia') }}" style="{{ $inp }}">
                        <option value="">Seleccione a província</option>
                    </select>
                </div>
                <div>
                    @php tc_label('Município de Naturalidade') @endphp
                    <select id="t-municipio" name="naturalidade_municipio" required data-old="{{ old('naturalidade_municipio') }}" style="{{ $inp }}">
                        <option value="">Seleccione primeiro a província</option>
                    </select>
                </div>
            </div>

            {{-- BI --}}
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    @php tc_label('BI / Passaporte N.º') @endphp
                    <input type="text" name="bi" value="{{ old('bi') }}" required maxlength="20" style="{{ $inp }}">
                    @error('bi')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div>
                    @php tc_label('Emitido em (local)') @endphp
                    <input type="text" name="bi_emitido_em" value="{{ old('bi_emitido_em') }}" required maxlength="255" style="{{ $inp }}">
                </div>
                <div>
                    @php tc_label('Data de Emissão') @endphp
                    <input type="date" name="bi_data_emissao" value="{{ old('bi_data_emissao') }}" required style="{{ $inp }}">
                </div>
            </div>

            {{-- Sexo + Estado Civil --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    @php tc_label('Sexo') @endphp
                    <div style="display:flex;gap:18px;margin-top:2px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="sexo" value="masculino" {{ old('sexo')==='masculino'?'checked':'' }} required> Masculino
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="sexo" value="feminino" {{ old('sexo')==='feminino'?'checked':'' }}> Feminino
                        </label>
                    </div>
                    @error('sexo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div>
                    @php tc_label('Estado Civil') @endphp
                    <input type="text" name="estado_civil" value="{{ old('estado_civil') }}" required maxlength="100" placeholder="Ex: Solteiro(a)" style="{{ $inp }}">
                </div>
            </div>

            {{-- Necessidade Especial --}}
            <div style="margin-bottom:14px;">
                @php tc_label('Necessidade de Educação Especial') @endphp
                <select name="necessidade_especial" required style="{{ $inp }}">
                    <option value="">— Seleccione —</option>
                    <option value="Nenhuma" {{ old('necessidade_especial') === 'Nenhuma' ? 'selected' : '' }}>Nenhuma</option>
                    <option value="Filhos de antigos combatentes" {{ old('necessidade_especial') === 'Filhos de antigos combatentes' ? 'selected' : '' }}>Filhos de antigos combatentes</option>
                    <option value="Áreas Steam" {{ old('necessidade_especial') === 'Áreas Steam' ? 'selected' : '' }}>Áreas Steam</option>
                    <option value="Portadores de deficiência" {{ old('necessidade_especial') === 'Portadores de deficiência' ? 'selected' : '' }}>Portadores de deficiência</option>
                </select>
            </div>

            {{-- Residência --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    @php tc_label('Residência — Município') @endphp
                    <input type="text" name="residencia_municipio" value="{{ old('residencia_municipio') }}" required maxlength="255" style="{{ $inp }}">
                </div>
                <div>
                    @php tc_label('Residência — Rua/Bairro') @endphp
                    <input type="text" name="residencia_bairro" value="{{ old('residencia_bairro') }}" required maxlength="255" style="{{ $inp }}">
                </div>
            </div>

            {{-- Contactos --}}
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
                <div>
                    @php tc_label('Telefone 1') @endphp
                    <input type="tel" name="telefone" value="{{ old('telefone') }}" required maxlength="50" style="{{ $inp }}">
                </div>
                <div>
                    @php tc_label('Telefone 2', false) @endphp
                    <input type="tel" name="telefone2" value="{{ old('telefone2') }}" maxlength="50" style="{{ $inp }}">
                </div>
                <div>
                    @php tc_label('Email') @endphp
                    <input type="email" name="email" value="{{ old('email') }}" required maxlength="255" style="{{ $inp }}">
                </div>
            </div>

            {{-- Habilitações --}}
            <div style="display:grid;grid-template-columns:1fr 2fr;gap:12px;margin-bottom:14px;">
                <div>
                    @php tc_label('Habilitações Literárias') @endphp
                    <input type="text" name="habilitacoes" value="{{ old('habilitacoes') }}" required maxlength="100" placeholder="Ex: 12ª Classe" style="{{ $inp }}">
                </div>
                <div>
                    @php tc_label('Escola de Proveniência') @endphp
                    <input type="text" name="escola_origem" value="{{ old('escola_origem') }}" required maxlength="255" style="{{ $inp }}">
                </div>
            </div>

            {{-- Perfil de Acesso --}}
            @php $tcOldPerf = old('perfil', ''); @endphp
            <div style="margin-bottom:14px;">
                @php tc_label('Perfil do Curso de Proveniência') @endphp
                <select name="perfil" id="tc-perfil"
                        data-perfis-curso="{{ json_encode(\App\Models\Candidatura::$perfisCurso, JSON_UNESCAPED_UNICODE) }}"
                        data-todos-cursos="{{ json_encode(\App\Models\Candidatura::$cursos, JSON_UNESCAPED_UNICODE) }}"
                        style="{{ $inp }}@error('perfil')border-color:#f87171;@enderror">
                    <option value="">— Seleccione o perfil do curso de origem —</option>
                    @foreach(\App\Models\Candidatura::todosOsPerfis() as $p)
                        <option value="{{ $p }}" {{ $tcOldPerf === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:4px;">Os cursos disponíveis são filtrados automaticamente pelo perfil.</p>
                <div id="tc-perfil-info" style="display:none;margin-top:8px;padding:9px 13px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:7px;font-size:0.8rem;color:#1e40af;line-height:1.5;"></div>
                @error('perfil')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
            </div>

            {{-- Ano Conclusão --}}
            <div style="margin-bottom:14px;">
                @php tc_label('Ano de Conclusão') @endphp
                <input type="number" name="ano_conclusao" value="{{ old('ano_conclusao') }}" required min="1990" max="{{ date('Y') }}" style="width:140px;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;">
                @error('ano_conclusao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
            </div>

            {{-- Estado Financeiro --}}
            <div style="margin-bottom:14px;">
                @php tc_label('Estado Financeiro da Família') @endphp
                <div style="display:flex;gap:18px;margin-top:2px;">
                    @foreach(['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'] as $v=>$l)
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="estado_financeiro" value="{{ $v }}" {{ old('estado_financeiro')===$v?'checked':'' }} required> {{ $l }}
                    </label>
                    @endforeach
                </div>
                @error('estado_financeiro')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
            </div>

            {{-- Trabalhador --}}
            <div style="margin-bottom:14px;">
                @php tc_label('Trabalhador') @endphp
                <div style="display:flex;gap:18px;align-items:center;flex-wrap:wrap;margin-top:2px;">
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="trabalhador" value="sim" {{ old('trabalhador')==='sim'?'checked':'' }} required
                               onchange="document.getElementById('tc-inst').style.display='block'"> Sim
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="trabalhador" value="nao" {{ old('trabalhador')==='nao'?'checked':'' }}
                               onchange="document.getElementById('tc-inst').style.display='none'"> Não
                    </label>
                    <div id="tc-inst" style="display:{{ old('trabalhador')==='sim'?'block':'none' }};flex:1;min-width:220px;">
                        <input type="text" name="instituicao_laboral" value="{{ old('instituicao_laboral') }}" maxlength="255"
                               placeholder="Nome da Instituição Laboral" style="{{ $inp }}">
                        @error('instituicao_laboral')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                    </div>
                </div>
                @error('trabalhador')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
            </div>

            {{-- Curso + Período --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:24px;">
                <div>
                    @php tc_label('Curso') @endphp
                    @php
                    $tcOldCurso = old('curso', '');
                    $tcOldPerfilV = old('perfil', '');
                    @endphp
                    <select name="curso" id="tc-curso" required
                            data-old-value="{{ old('curso', '') }}"
                            style="{{ $inp }}">
                        <option value="">{{ $tcOldPerfilV ? '— Seleccione o curso —' : '— Seleccione primeiro o perfil acima —' }}</option>
                        @if($tcOldPerfilV)
                            @foreach(\App\Models\Candidatura::$cursos as $c)
                                @php
                                $tcPerfisC = \App\Models\Candidatura::$perfisCurso[$c] ?? [];
                                $tcElegivel = empty($tcPerfisC) || in_array($tcOldPerfilV, $tcPerfisC);
                                @endphp
                                @if($tcElegivel)
                                    <option value="{{ $c }}" {{ $tcOldCurso === $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    @error('curso')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div>
                    @php tc_label('Período') @endphp
                    <div style="display:flex;gap:18px;margin-top:4px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="periodo" value="regular" {{ old('periodo')==='regular'?'checked':'' }} required> Regular
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                            <input type="radio" name="periodo" value="pos-laboral" {{ old('periodo')==='pos-laboral'?'checked':'' }}> Pós-laboral
                        </label>
                    </div>
                    @error('periodo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Local de Inscrição --}}
            <div style="margin-bottom:24px;">
                @php tc_label('Local de Inscrição') @endphp
                <div style="display:flex;gap:20px;margin-top:4px;flex-wrap:wrap;">
                    @foreach(\App\Models\Candidatura::$locaisInscricao as $val => $label)
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.88rem;cursor:pointer;">
                        <input type="radio" name="local_inscricao" value="{{ $val }}"
                               {{ old('local_inscricao') === $val ? 'checked' : '' }} required> {{ $label }}
                    </label>
                    @endforeach
                </div>
                @error('local_inscricao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                    style="background:#0e5c2f;color:#fff;border:none;border-radius:10px;padding:11px 28px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                    onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#0e5c2f'">
                Registar Candidatura
            </button>
        </form>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/provincias-angola.js') }}"></script>
<script src="{{ asset('js/perfil-curso.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var prov = document.getElementById('t-provincia');
    var mun  = document.getElementById('t-municipio');
    if (prov) { prov.id = 'select-provincia'; prov.setAttribute('data-old', prov.dataset.old || ''); }
    if (mun)  { mun.id  = 'select-municipio'; mun.setAttribute('data-old', mun.dataset.old || ''); }
});
</script>
@endpush
@endsection
