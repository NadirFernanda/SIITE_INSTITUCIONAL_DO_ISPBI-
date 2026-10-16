                                <div id="formulario-candidatura" class="bg-white border border-[#2563eb]/20 rounded-2xl shadow-lg p-4 sm:p-8">

                                    <h2 class="text-xl sm:text-2xl font-bold text-[#2563eb] mb-1 leading-tight">Ficha de Inscrição — Exame de Acesso 2026/2027</h2>
                                    <p class="text-gray-500 text-sm mb-6">Todos os campos são obrigatórios, excepto o Telefone 2 e a Instituição Laboral (apenas se não trabalhar).</p>

                                    {{-- Banner de erros de validação --}}
                                    @if($errors->any())
                                    <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-6 flex items-start gap-3">
                                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <div>
                                            <p class="font-semibold text-red-700 mb-2">Por favor corrija os seguintes erros antes de submeter:</p>
                                            <ul class="space-y-1">
                                                @foreach($errors->all() as $erro)
                                                    <li class="text-sm text-red-600 flex items-start gap-1.5">
                                                        <span class="mt-0.5 text-red-400">›</span> {{ $erro }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif

                                    @php $inp = 'w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition'; @endphp

                                    <form method="POST" action="{{ route('candidaturas.store') }}" class="space-y-6" novalidate>
                                        @csrf

                                        {{-- 1. Nome --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo <span class="text-red-500">*</span></label>
                                            <input type="text" name="nome" value="{{ old('nome') }}" required maxlength="255" class="{{ $inp }} @error('nome') border-red-400 @enderror">
                                            @error('nome')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 2. Filiação --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Filiação <span class="text-gray-400 font-normal text-xs">(opcional)</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Nome do Pai</label>
                                                    <input type="text" name="filiacao_pai" value="{{ old('filiacao_pai') }}" maxlength="255" class="{{ $inp }} @error('filiacao_pai') border-red-400 @enderror">
                                                    @error('filiacao_pai')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Nome da Mãe</label>
                                                    <input type="text" name="filiacao_mae" value="{{ old('filiacao_mae') }}" maxlength="255" class="{{ $inp }} @error('filiacao_mae') border-red-400 @enderror">
                                                    @error('filiacao_mae')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 3. Data de Nascimento --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Data de Nascimento <span class="text-red-500">*</span></label>
                                            <input type="date" name="data_nascimento"
                                                   value="{{ old('data_nascimento') }}"
                                                   required
                                                   max="{{ now()->subYears(17)->endOfYear()->format('Y-m-d') }}" min="{{ now()->subYears(100)->format('Y-m-d') }}"
                                                   class="{{ $inp }} @error('data_nascimento') border-red-400 @enderror" style="max-width:220px;">
                                            <p class="text-xs text-gray-400 mt-1">Idade mínima: 17 anos</p>
                                            @error('data_nascimento')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 4. Naturalidade --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Naturalidade <span class="text-red-500">*</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Província</label>
                                                    <select id="select-provincia" name="naturalidade_provincia"
                                                            data-old="{{ old('naturalidade_provincia') }}"
                                                            required class="{{ $inp }} @error('naturalidade_provincia') border-red-400 @enderror">
                                                        @include('partials.provincias_options', ['selectedProvince' => old('naturalidade_provincia')])
                                                    </select>
                                                    @error('naturalidade_provincia')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Município</label>
                                                    <select id="select-municipio" name="naturalidade_municipio"
                                                            data-old="{{ old('naturalidade_municipio') }}"
                                                            required class="{{ $inp }} @error('naturalidade_municipio') border-red-400 @enderror">
                                                        @include('partials.municipios_options', ['province' => old('naturalidade_provincia'), 'selectedMunicipio' => old('naturalidade_municipio')])
                                                    </select>
                                                    @error('naturalidade_municipio')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 5. Bilhete de Identidade / Passaporte --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Bilhete de Identidade / Passaporte <span class="text-red-500">*</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Número</label>
                                                    <input type="text" name="bi" value="{{ old('bi') }}" required maxlength="20" class="{{ $inp }} @error('bi') border-red-400 @enderror">
                                                    @error('bi')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Emitido em (local)</label>
                                                    <input type="text" name="bi_emitido_em" value="{{ old('bi_emitido_em') }}" required maxlength="255" class="{{ $inp }} @error('bi_emitido_em') border-red-400 @enderror">
                                                    @error('bi_emitido_em')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Data de emissão</label>
                                                    <input type="date" name="bi_data_emissao" value="{{ old('bi_data_emissao') }}" required class="{{ $inp }} @error('bi_data_emissao') border-red-400 @enderror">
                                                    @error('bi_data_emissao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 6. Sexo + Estado Civil --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Sexo <span class="text-red-500">*</span></label>
                                                <div class="flex flex-col sm:flex-row gap-4">
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="sexo" value="masculino" {{ old('sexo') === 'masculino' ? 'checked' : '' }} required class="accent-[#2563eb]"> Masculino
                                                    </label>
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="sexo" value="feminino" {{ old('sexo') === 'feminino' ? 'checked' : '' }} class="accent-[#2563eb]"> Feminino
                                                    </label>
                                                </div>
                                                @error('sexo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Estado Civil <span class="text-red-500">*</span></label>
                                                <select name="estado_civil" required class="{{ $inp }} @error('estado_civil') border-red-400 @enderror">
                                                    <option value="">— Seleccione —</option>
                                                    <option value="Solteiro(a)" {{ old('estado_civil') === 'Solteiro(a)' ? 'selected' : '' }}>Solteiro(a)</option>
                                                    <option value="Casado(a)" {{ old('estado_civil') === 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                                                    <option value="Divorciado(a)" {{ old('estado_civil') === 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                                                    <option value="Separado(a)" {{ old('estado_civil') === 'Separado(a)' ? 'selected' : '' }}>Separado(a)</option>
                                                    <option value="Viúvo(a)" {{ old('estado_civil') === 'Viúvo(a)' ? 'selected' : '' }}>Viúvo(a)</option>
                                                    <option value="União de Facto" {{ old('estado_civil') === 'União de Facto' ? 'selected' : '' }}>União de Facto</option>
                                                    <option value="Outro" {{ old('estado_civil') === 'Outro' ? 'selected' : '' }}>Outro</option>
                                                </select>
                                                @error('estado_civil')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- 7. Necessidade de Educação Especial --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Necessidade de Educação Especial <span class="text-red-500">*</span></label>
                                            <select name="necessidade_especial" required class="{{ $inp }} @error('necessidade_especial') border-red-400 @enderror">
                                                <option value="">— Seleccione —</option>
                                                <option value="Nenhuma" {{ old('necessidade_especial') === 'Nenhuma' ? 'selected' : '' }}>Nenhuma</option>
                                                <option value="Filhos de antigos combatentes" {{ old('necessidade_especial') === 'Filhos de antigos combatentes' ? 'selected' : '' }}>Filhos de antigos combatentes</option>
                                                <option value="Áreas Steam" {{ old('necessidade_especial') === 'Áreas Steam' ? 'selected' : '' }}>Áreas Steam</option>
                                                <option value="Portadores de deficiência" {{ old('necessidade_especial') === 'Portadores de deficiência' ? 'selected' : '' }}>Portadores de deficiência</option>
                                            </select>
                                            @error('necessidade_especial')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 8. Residência --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Residência <span class="text-red-500">*</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Município</label>
                                                    <input type="text" name="residencia_municipio" value="{{ old('residencia_municipio') }}" required maxlength="255" class="{{ $inp }} @error('residencia_municipio') border-red-400 @enderror">
                                                    @error('residencia_municipio')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Rua / Bairro</label>
                                                    <input type="text" name="residencia_bairro" value="{{ old('residencia_bairro') }}" required maxlength="255" class="{{ $inp }} @error('residencia_bairro') border-red-400 @enderror">
                                                    @error('residencia_bairro')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 9. Telefones + Email --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Telefone 1 <span class="text-red-500">*</span></label>
                                                <input type="tel" name="telefone" value="{{ old('telefone') }}" required maxlength="50" class="{{ $inp }} @error('telefone') border-red-400 @enderror">
                                                @error('telefone')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Telefone 2 <span class="text-gray-400 font-normal">(opcional)</span></label>
                                                <input type="tel" name="telefone2" value="{{ old('telefone2') }}" maxlength="50" class="{{ $inp }}">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-gray-400 font-normal">(opcional)</span></label>
                                                <input type="email" name="email" value="{{ old('email') }}" maxlength="255" class="{{ $inp }} @error('email') border-red-400 @enderror">
                                                @error('email')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- 10. Habilitações + Escola --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Habilitações Literárias <span class="text-red-500">*</span></label>
                                                <select name="habilitacoes" required class="{{ $inp }} @error('habilitacoes') border-red-400 @enderror">
                                                    <option value="">— Seleccione —</option>
                                                    <option value="12ª" {{ old('habilitacoes') === '12ª' ? 'selected' : '' }}>12ª (Décima Segunda)</option>
                                                                                                        <option value="13ª" {{ old('habilitacoes') === '13ª' ? 'selected' : '' }}>13ª (Décima Terceira)</option>
                                                </select>
                                                @error('habilitacoes')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div class="sm:col-span-2">
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Escola de Proveniência <span class="text-red-500">*</span></label>
                                                <input type="text" name="escola_origem" value="{{ old('escola_origem') }}" required maxlength="255" class="{{ $inp }} @error('escola_origem') border-red-400 @enderror">
                                                @error('escola_origem')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- 10b. Perfil de Acesso --}}
                                        @php $oldPerfil = old('perfil', ''); @endphp
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Perfil do Curso de Proveniência <span class="text-red-500">*</span></label>
                                            <select name="perfil" id="perfil-select"
                                                    data-perfis-curso="{{ json_encode(\App\Models\Candidatura::$perfisCurso, JSON_UNESCAPED_UNICODE) }}"
                                                    data-todos-cursos="{{ json_encode(\App\Models\Candidatura::$cursos, JSON_UNESCAPED_UNICODE) }}"
                                                    class="{{ $inp }} @error('perfil') border-red-400 @enderror">
                                                <option value="">— Seleccione o perfil do seu curso de origem —</option>
                                                @foreach(\App\Models\Candidatura::todosOsPerfis() as $p)
                                                    <option value="{{ $p }}" {{ $oldPerfil === $p ? 'selected' : '' }}>{{ $p }}</option>
                                                @endforeach
                                                <option value="Outro" {{ $oldPerfil === 'Outro' ? 'selected' : '' }}>Outro — Perfil não listado</option>
                                            </select>
                                            <p class="text-xs text-gray-400 mt-1">Os cursos disponíveis serão filtrados automaticamente com base no seu perfil. Se o seu curso não aparecer, dirija-se à instituição.</p>
                                            <div id="perfil-select-info" style="display:none;margin-top:8px;padding:10px 14px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;font-size:0.82rem;color:#1e40af;line-height:1.5;"></div>
                                            @error('perfil')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 11. Ano de Conclusão --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Ano de Conclusão do Ensino Médio <span class="text-red-500">*</span></label>
                                            <input type="number" name="ano_conclusao" value="{{ old('ano_conclusao') }}" required min="1990" max="{{ date('Y') }}"
                                                   class="{{ $inp }} @error('ano_conclusao') border-red-400 @enderror" style="max-width:160px;">
                                            @error('ano_conclusao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 12. Estado Financeiro --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Estado Financeiro da Família <span class="text-red-500">*</span></label>
                                            <div class="flex flex-wrap gap-4 gap-y-2">
                                                @foreach(['maximo' => 'Máximo', 'medio' => 'Médio', 'minimo' => 'Mínimo'] as $val => $label)
                                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                    <input type="radio" name="estado_financeiro" value="{{ $val }}" {{ old('estado_financeiro') === $val ? 'checked' : '' }} required class="accent-[#2563eb]"> {{ $label }}
                                                </label>
                                                @endforeach
                                            </div>
                                            @error('estado_financeiro')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 13. Trabalhador --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Trabalhador <span class="text-red-500">*</span></label>
                                            <div class="flex flex-col sm:flex-row gap-4 items-start">
                                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                    <input type="radio" name="trabalhador" value="sim" {{ old('trabalhador') === 'sim' ? 'checked' : '' }} required class="accent-[#2563eb]"
                                                           onchange="document.getElementById('inst-laboral').classList.remove('hidden')"> Sim
                                                </label>
                                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                    <input type="radio" name="trabalhador" value="nao" {{ old('trabalhador') === 'nao' ? 'checked' : '' }} class="accent-[#2563eb]"
                                                           onchange="document.getElementById('inst-laboral').classList.add('hidden')"> Não
                                                </label>
                                                <div id="inst-laboral" class="{{ old('trabalhador') === 'sim' ? '' : 'hidden' }} flex-1 min-w-[220px]">
                                                    <input type="text" name="instituicao_laboral" value="{{ old('instituicao_laboral') }}" maxlength="255"
                                                           placeholder="Nome da Instituição Laboral" class="{{ $inp }} @error('instituicao_laboral') border-red-400 @enderror">
                                                    @error('instituicao_laboral')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                            @error('trabalhador')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 14. Curso + Período --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Curso a Inscrever <span class="text-red-500">*</span></label>
                                                @php
                                                $oldCurso = old('curso', '');
                                                $oldPerfilV = old('perfil', '');
                                                @endphp
                                                <select name="curso" id="curso-select" required
                                                        data-old-value="{{ old('curso', '') }}"
                                                        class="{{ $inp }} @error('curso') border-red-400 @enderror">
                                                    <option value="">{{ $oldPerfilV ? '— Seleccione o curso —' : '— Seleccione primeiro o seu perfil acima —' }}</option>
                                                    @if($oldPerfilV)
                                                        @foreach(\App\Models\Candidatura::$cursos as $c)
                                                            @php
                                                            $perfisC = \App\Models\Candidatura::$perfisCurso[$c] ?? [];
                                                            $elegivel = empty($perfisC) || in_array($oldPerfilV, $perfisC);
                                                            @endphp
                                                            @if($elegivel)
                                                                <option value="{{ $c }}" {{ $oldCurso === $c ? 'selected' : '' }}>{{ $c }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" name="observacoes" id="observacoes-input" value="{{ old('observacoes', '') }}">
                                                @error('curso')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Período <span class="text-red-500">*</span></label>
                                                <div class="flex gap-6 mt-1">
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="periodo" value="regular" {{ old('periodo') === 'regular' ? 'checked' : '' }} required class="accent-[#2563eb]"> Regular
                                                    </label>
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="periodo" value="pos-laboral" {{ old('periodo') === 'pos-laboral' ? 'checked' : '' }} class="accent-[#2563eb]"> Pós-laboral
                                                    </label>
                                                </div>
                                                @error('periodo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- 15. Local de Inscrição --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Local de Inscrição <span class="text-red-500">*</span></label>
                                            <div class="flex gap-6 flex-wrap">
                                                @foreach(\App\Models\Candidatura::$locaisInscricao as $val => $label)
                                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                    <input type="radio" name="local_inscricao" value="{{ $val }}"
                                                           {{ old('local_inscricao') === $val ? 'checked' : '' }}
                                                           required class="accent-[#2563eb]"> {{ $label }}
                                                </label>
                                                @endforeach
                                            </div>
                                            @error('local_inscricao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 16. Autorização para gerar assinatura digital --}}
                                        <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                                            <label class="flex items-start gap-3 text-sm text-gray-700 cursor-pointer">
                                                <input type="checkbox" name="autorizacao_assinatura" value="1"
                                                       {{ old('autorizacao_assinatura') ? 'checked' : '' }}
                                                       required class="mt-1 accent-[#2563eb]">
                                                <span>
                                                    Autorizo o Instituto Superior Politécnico do Bié a gerar uma assinatura digital
                                                    com o meu nome, a usar no comprovativo desta candidatura. <span class="text-red-500">*</span>
                                                </span>
                                            </label>
                                            @error('autorizacao_assinatura')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        <div class="pt-2">
                                            <button type="submit"
                                                    class="w-full sm:w-auto bg-[#2563eb] hover:bg-[#174ea6] text-white font-bold px-10 py-3 rounded-xl transition-colors text-sm">
                                                Submeter Candidatura
                                            </button>
                                        </div>
                                    </form>
                                </div>
