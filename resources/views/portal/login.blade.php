@extends('layouts.site')

@section('title', 'Entrar — Portal Alumni ISP-Bié')

@section('content')
<div style="min-height:80vh;display:flex;align-items:center;justify-content:center;padding:48px 16px;">
    <div style="width:100%;max-width:460px;">

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
                <h1 style="color:#fff;font-size:1.55rem;font-weight:700;margin:0;">Entrar</h1>
                <p style="color:rgba(255,255,255,0.7);font-size:0.88rem;margin:6px 0 0;">Acesso exclusivo para ex-estudantes do ISP-Bié.</p>
            </div>

            {{-- Body --}}
            <div style="padding:32px 36px;">

                @if($errors->any())
                    <div style="background:#fff3e0;border:1px solid #ffcc80;color:#b45309;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:0.85rem;">
                        @foreach($errors->all() as $error)
                            <p style="margin:0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('portal.login.post') }}">
                    @csrf

                    <div style="margin-bottom:18px;">
                        <label for="email" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                            style="width:100%;padding:10px 13px;border:1px solid {{ $errors->has('email') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.9rem;outline:none;box-sizing:border-box;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='{{ $errors->has('email') ? '#f87171' : '#d1d5db' }}'">
                    </div>

                    <div style="margin-bottom:24px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:5px;">
                            <label for="password" style="font-size:0.84rem;font-weight:600;color:#374151;">Palavra-passe</label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="font-size:0.78rem;color:#2563eb;text-decoration:none;">Esqueceu a palavra-passe?</a>
                            @endif
                        </div>
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            style="width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;outline:none;box-sizing:border-box;"
                            onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
                    </div>

                    <div style="margin-bottom:20px;display:flex;align-items:center;gap:8px;">
                        <input type="checkbox" id="remember" name="remember" style="width:15px;height:15px;accent-color:#1e3a5f;cursor:pointer;">
                        <label for="remember" style="font-size:0.84rem;color:#6b7280;cursor:pointer;">Manter sessão activa</label>
                    </div>

                    <button type="submit"
                        style="width:100%;background:#1e3a5f;color:#fff;padding:12px;border:none;border-radius:9px;font-size:0.95rem;font-weight:700;cursor:pointer;"
                        onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
                        Entrar no Portal
                    </button>
                </form>

                <div style="margin-top:20px;text-align:center;font-size:0.84rem;color:#6b7280;">
                    Ainda não tem conta?
                    <a href="{{ route('portal.register') }}" style="color:#1e3a5f;font-weight:600;text-decoration:none;">Registar</a>
                </div>

                <div style="margin-top:28px;padding-top:20px;border-top:1px solid #f3f4f6;text-align:center;">
                    <p style="font-size:0.75rem;color:#9ca3af;margin:0 0 6px;">Acesso institucional (admin / técnico)?</p>
                    <a href="{{ route('login') }}" style="font-size:0.8rem;color:#6b7280;text-decoration:none;font-weight:500;">Entrar no painel institucional →</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
