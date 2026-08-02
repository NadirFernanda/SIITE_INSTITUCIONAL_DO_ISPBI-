@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:820px;margin:0 auto;">
    <a href="{{ route('admin.usuarios') }}" style="display:inline-block;margin-bottom:18px;color:#1e3a5f;">&larr; Voltar à lista de utilizadores</a>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:22px;">
        <div style="display:flex;gap:18px;align-items:center;">
            @php
            $avatarBg  = match($usuario->role) { 'admin'=>'#eaeff5','tecnico'=>'#dcfce7','daac'=>'#eaeff5','secretaria'=>'#eaeff5','subcomissao_correcao'=>'#eaeff5','subcomissao_lancamento'=>'#d1fae5','presidencia'=>'#eaeff5', default=>'#f1f5f9' };
            $avatarClr = match($usuario->role) { 'admin'=>'#1e3a5f','tecnico'=>'#15803d','daac'=>'#1e3a5f','secretaria'=>'#1e3a5f','subcomissao_correcao'=>'#0f1f3d','subcomissao_lancamento'=>'#1e3a5f','presidencia'=>'#1e3a5f', default=>'#64748b' };
            @endphp
            <div style="width:64px;height:64px;border-radius:50%;background:{{ $avatarBg }};color:{{ $avatarClr }};display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.4rem;">
                {{ strtoupper(substr($usuario->name,0,1)) }}
            </div>
            <div>
                <h1 style="margin:0;font-size:1.25rem;font-weight:700;color:#1a2332;">{{ $usuario->name }}</h1>
                <div style="color:#64748b;margin-top:4px;">{{ $usuario->email }} • <strong style="color:#475569">{{ ucfirst($usuario->role) }}</strong></div>
            </div>
        </div>

        <div style="margin-top:18px;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px;">
                <div style="font-size:0.88rem;font-weight:700;color:#92400e;margin-bottom:10px;">Redefinir Password</div>
                <form method="POST" action="{{ route('admin.usuarios.password', $usuario) }}" autocomplete="off">
                    @csrf @method('PATCH')
                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <input type="password" name="password" required minlength="10" placeholder="Nova password (mín. 10)" style="padding:8px;border:1px solid #fcd34d;border-radius:8px;">
                        <input type="password" name="password_confirmation" required minlength="10" placeholder="Confirmar" style="padding:8px;border:1px solid #fcd34d;border-radius:8px;">
                        <div style="display:flex;gap:8px;margin-top:6px;">
                            <button type="submit" style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:8px 14px;font-weight:700;">Guardar</button>
                            <a href="{{ route('admin.usuarios') }}" style="background:#f1f5f9;color:#475569;border-radius:8px;padding:8px 12px;text-decoration:none;">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>

            <div style="background:#eaeff5;border:1px solid #a8c4e0;border-radius:10px;padding:14px;">
                <div style="font-size:0.88rem;font-weight:700;color:#0f1f3d;margin-bottom:10px;">Assinatura digitalizada</div>
                @if($usuario->signature_image)
                    <div style="margin-bottom:12px;">
                        <img src="{{ $usuario->signature_image }}" alt="Assinatura" style="height:56px;object-fit:contain;display:block;border:1px solid #ddd;padding:8px;border-radius:8px;background:#fff;">
                    </div>
                    <form method="POST" action="{{ route('admin.usuarios.assinatura.remove', $usuario) }}" onsubmit="return confirm('Remover a assinatura de {{ addslashes($usuario->name) }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:#fee2e2;color:#b91c1c;border:1px solid #fca5a5;border-radius:8px;padding:8px 12px;">Remover</button>
                    </form>
                @else
                    <p style="margin:0 0 12px;color:#0f1f3d;">Nenhuma assinatura guardada. Carregue uma imagem PNG/JPG da assinatura manuscrita em papel branco.</p>
                @endif

                <form method="POST" action="{{ route('admin.usuarios.assinatura', $usuario) }}" enctype="multipart/form-data" style="margin-top:10px;display:flex;gap:8px;align-items:center;">
                    @csrf
                    <input type="file" name="signature_image" accept="image/png,image/jpeg">
                    <button type="submit" style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:8px 12px;">Guardar</button>
                </form>
            </div>
        </div>

        <div style="margin-top:18px;">
            <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario) }}" onsubmit="return confirm('Eliminar o utilizador {{ addslashes($usuario->name) }}? Esta acção é irreversível.')">
                @csrf @method('DELETE')
                <button type="submit" style="background:#fff5f5;color:#b91c1c;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;font-weight:700;">Eliminar utilizador</button>
            </form>
        </div>

    </div>
</div>
@endsection
