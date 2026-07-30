@extends('layouts.site')

@section('content')
<div class="max-w-xl mx-auto py-16 px-4">
    <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center shadow">
        <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin-bottom:8px;">Sessão expirada</h1>
        <p style="color:#475569;margin-bottom:18px;font-size:0.95rem;">A sua sessão expirou por inatividade (código 419). Isto impede que a acção seja concluída e é uma medida de segurança.</p>

        <div style="display:flex;justify-content:center;gap:10px;flex-wrap:wrap;">
            <button onclick="location.reload()" style="background:#1565c0;color:#fff;border:none;border-radius:10px;padding:10px 18px;font-weight:700;cursor:pointer;">Recarregar página</button>
            <a href="{{ route('login') }}" style="background:#15803d;color:#fff;border:none;border-radius:10px;padding:10px 18px;font-weight:700;text-decoration:none;">Iniciar sessão</a>
            <a href="{{ url('/') }}" style="border:1px solid #e2e8f0;color:#475569;border-radius:10px;padding:10px 18px;font-weight:700;text-decoration:none;">Página inicial</a>
        </div>

        <p style="color:#94a3b8;margin-top:16px;font-size:0.86rem;">Se o problema persistir, limpe o cache do navegador ou contacte o suporte técnico.</p>
    </div>
</div>
@endsection
