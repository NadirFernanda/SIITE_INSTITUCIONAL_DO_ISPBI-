@extends('layouts.site')

@section('title', 'Conta em Verificacao — ISP-Bié')

@section('content')
<div style="min-height:75vh;display:flex;align-items:center;justify-content:center;padding:48px 16px;">
    <div style="width:100%;max-width:520px;text-align:center;">

        <div style="background:#fff;border-radius:16px;box-shadow:0 4px 32px rgba(30,58,95,0.10);padding:48px 40px;">

            {{-- Icon --}}
            <div style="width:72px;height:72px;background:#e8f0fe;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                <svg width="36" height="36" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                </svg>
            </div>

            <h1 style="font-size:1.55rem;font-weight:700;color:#1e3a5f;margin:0 0 12px;">Pedido Recebido</h1>

            <p style="color:#4b5563;font-size:0.95rem;line-height:1.65;margin:0 0 8px;">
                A sua conta de alumni esta a ser verificada pela nossa equipa.
            </p>

            <p style="color:#4b5563;font-size:0.95rem;line-height:1.65;margin:0 0 28px;">
                Entraremos em contacto assim que o seu acesso for aprovado. Este processo pode demorar alguns dias uteis.
            </p>

            @if(session('success'))
                <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 16px;border-radius:8px;margin-bottom:24px;font-size:0.88rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="border-top:1px solid #e5e7eb;padding-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('welcome') }}"
                    style="display:inline-flex;align-items:center;gap:6px;background:#1e3a5f;color:#fff;padding:10px 22px;border-radius:9px;font-weight:600;font-size:0.88rem;text-decoration:none;"
                    onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
                    Voltar ao Site
                </a>
                <a href="{{ route('contactos') }}"
                    style="display:inline-flex;align-items:center;gap:6px;background:#f1f5f9;color:#1e3a5f;padding:10px 22px;border-radius:9px;font-weight:600;font-size:0.88rem;text-decoration:none;"
                    onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                    Contactar Suporte
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
