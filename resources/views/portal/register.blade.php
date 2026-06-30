@extends('layouts.site')

@section('title', 'Registo Alumni — ISP-Bié')

@section('content')
<div style="min-height:80vh;display:flex;align-items:center;justify-content:center;padding:48px 16px;">
    <div style="width:100%;max-width:520px;">

        {{-- Card --}}
        <div style="background:#fff;border-radius:16px;box-shadow:0 4px 32px rgba(30,58,95,0.10);overflow:hidden;">

            {{-- Header --}}
            <div style="background:linear-gradient(135deg,#1e3a5f 0%,#2a5298 100%);padding:32px 36px 24px;">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
                    <img src="/images/logo.png" alt="ISP-Bié" style="width:36px;height:36px;object-fit:contain;" onerror="this.style.display='none'">
                    <div>
                        <div style="color:#fff;font-weight:700;font-size:1.1rem;">Portal Alumni</div>
                        <div style="color:rgba(255,255,255,0.6);font-size:0.75rem;">ISP-Bié</div>
                    </div>
                </div>
                <h1 style="color:#fff;font-size:1.55rem;font-weight:700;margin:0;">Criar Conta</h1>
                <p style="color:rgba(255,255,255,0.7);font-size:0.88rem;margin:6px 0 0;">Registe-se para aceder ao portal exclusivo de alumni.</p>
            </div>

            {{-- Body --}}
            <div style="padding:32px 36px;">

                @if(session('success'))
                    <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:0.88rem;">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="background:#fff3e0;border:1px solid #ffcc80;color:#e65100;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:0.85rem;">
                        <strong style="display:block;margin-bottom:6px;">Por favor corrija os seguintes erros:</strong>
                        <ul style="margin:0;padding-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('portal.register.post') }}">
                    @csrf

                    <div style="margin-bottom:18px;">
                        <label for="nome" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Nome Completo</label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required autocomplete="name"
                            style="width:100%;padding:10px 13px;border:1px solid {{ $errors->has('nome') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.9rem;outline:none;transition:border 0.15s;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='{{ $errors->has('nome') ? '#f87171' : '#d1d5db' }}'">
                    </div>

                    <div style="margin-bottom:18px;">
                        <label for="email" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Endereço de E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            style="width:100%;padding:10px 13px;border:1px solid {{ $errors->has('email') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.9rem;outline:none;transition:border 0.15s;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='{{ $errors->has('email') ? '#f87171' : '#d1d5db' }}'">
                    </div>

                    <div style="margin-bottom:18px;">
                        <label for="curso" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Curso</label>
                        <select id="curso" name="curso" required
                            style="width:100%;padding:10px 13px;border:1px solid {{ $errors->has('curso') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.9rem;outline:none;background:#fff;transition:border 0.15s;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='{{ $errors->has('curso') ? '#f87171' : '#d1d5db' }}'">
                            <option value="">Selecione o curso</option>
                            @php
                                $cursos = [
                                    'Informática de Gestão',
                                    'Gestão de Recursos Hídricos',
                                    'Psicologia',
                                    'Comunicação Social',
                                    'Contabilidade e Finanças',
                                    'Enfermagem',
                                    'Outro',
                                ];
                            @endphp
                            @foreach($cursos as $c)
                                <option value="{{ $c }}" {{ old('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom:18px;">
                        <label for="ano" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Ano de Conclusao</label>
                        <input type="number" id="ano" name="ano" value="{{ old('ano') }}" required min="1990" max="2030"
                            style="width:100%;padding:10px 13px;border:1px solid {{ $errors->has('ano') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.9rem;outline:none;transition:border 0.15s;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='{{ $errors->has('ano') ? '#f87171' : '#d1d5db' }}'">
                    </div>

                    <div style="margin-bottom:18px;">
                        <label for="password" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Palavra-passe</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                            style="width:100%;padding:10px 13px;border:1px solid {{ $errors->has('password') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.9rem;outline:none;transition:border 0.15s;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='{{ $errors->has('password') ? '#f87171' : '#d1d5db' }}'">
                        <p style="font-size:0.75rem;color:#9ca3af;margin:4px 0 0;">Minimo 8 caracteres.</p>
                    </div>

                    <div style="margin-bottom:24px;">
                        <label for="password_confirmation" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Confirmar Palavra-passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                            style="width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;outline:none;transition:border 0.15s;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
                    </div>

                    <button type="submit"
                        style="width:100%;background:#1e3a5f;color:#fff;padding:12px;border:none;border-radius:9px;font-size:0.95rem;font-weight:700;cursor:pointer;transition:background 0.15s;"
                        onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
                        Registar
                    </button>
                </form>

                <div style="margin-top:20px;text-align:center;font-size:0.84rem;color:#6b7280;">
                    Já tem conta?
                    <a href="{{ route('portal.login') }}" style="color:#1e3a5f;font-weight:600;text-decoration:none;">Entrar</a>
                </div>

                <div style="margin-top:10px;text-align:center;font-size:0.84rem;color:#6b7280;">
                    <a href="{{ route('alumni') }}" style="color:#1e3a5f;text-decoration:none;">Ver a pagina publica de alumni</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
