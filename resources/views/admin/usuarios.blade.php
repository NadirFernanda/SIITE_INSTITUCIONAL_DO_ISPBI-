@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1000px;margin:0 auto;">

    {{-- Header --}}
    <div style="margin-bottom:28px;">
        <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Utilizadores</h1>
        <p style="color:#64748b;font-size:0.95rem;margin:0;">Contas com acesso ao painel administrativo</p>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Table card --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <div style="background:#f8fafc;border-bottom:1px solid #e2e8f0;padding:16px 24px;">
            <span style="font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.08em;">Lista de utilizadores</span>
        </div>

        @if(isset($usuarios) && $usuarios->count() > 0)
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #e2e8f0;">
                    <th style="padding:12px 24px;text-align:left;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;width:60px;">#</th>
                    <th style="padding:12px 24px;text-align:left;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Nome</th>
                    <th style="padding:12px 24px;text-align:left;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Email</th>
                    <th style="padding:12px 24px;text-align:left;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Papel</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr style="border-bottom:1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <td style="padding:14px 24px;font-size:0.82rem;color:#94a3b8;font-weight:600;">{{ $usuario->id }}</td>
                    <td style="padding:14px 24px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:#e3f2fd;color:#1565c0;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.95rem;flex-shrink:0;">
                                {{ strtoupper(substr($usuario->name, 0, 1)) }}
                            </div>
                            <span style="font-weight:600;color:#1a2332;font-size:0.92rem;">{{ $usuario->name }}</span>
                        </div>
                    </td>
                    <td style="padding:14px 24px;font-size:0.88rem;color:#475569;">{{ $usuario->email }}</td>
                    <td style="padding:14px 24px;">
                        @if(isset($usuario->role) && $usuario->role === 'admin')
                            <span style="background:#e3f2fd;color:#1565c0;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Admin</span>
                        @else
                            <span style="background:#f1f5f9;color:#64748b;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">Utilizador</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div style="padding:64px 48px;text-align:center;">
            <svg width="52" height="52" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p style="color:#94a3b8;font-size:1rem;margin:0;">Nenhum utilizador cadastrado.</p>
        </div>
        @endif
    </div>

</div>
@endsection
