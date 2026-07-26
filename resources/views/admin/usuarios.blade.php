@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1000px;margin:0 auto;">

    <div style="margin-bottom:28px;">
        <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Utilizadores</h1>
        <p style="color:#64748b;font-size:0.95rem;margin:0;">Contas com acesso ao painel — técnicos e administradores</p>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Criar técnico --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:26px 28px;margin-bottom:28px;">
        <h2 style="font-size:1rem;font-weight:700;color:#1565c0;margin:0 0 20px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            Criar Novo Técnico
        </h2>
        <form method="POST" action="{{ route('admin.usuarios.store') }}" autocomplete="off">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">
                        Nome <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required maxlength="255" autocomplete="off"
                           style="width:100%;border:1px solid {{ $errors->has('name') ? '#f87171' : '#e2e8f0' }};border-radius:8px;padding:9px 12px;font-size:0.9rem;box-sizing:border-box;">
                    @error('name')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">
                        Email <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="off"
                           style="width:100%;border:1px solid {{ $errors->has('email') ? '#f87171' : '#e2e8f0' }};border-radius:8px;padding:9px 12px;font-size:0.9rem;box-sizing:border-box;">
                    @error('email')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">
                        Password <span style="color:#ef4444;">*</span>
                        <span style="font-weight:400;color:#94a3b8;">(mín. 10 caracteres)</span>
                    </label>
                    <input type="password" name="password" required minlength="10" autocomplete="new-password"
                           style="width:100%;border:1px solid {{ $errors->has('password') ? '#f87171' : '#e2e8f0' }};border-radius:8px;padding:9px 12px;font-size:0.9rem;box-sizing:border-box;">
                    @error('password')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">
                        Confirmar Password <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="password" name="password_confirmation" required minlength="10" autocomplete="new-password"
                           style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.9rem;box-sizing:border-box;">
                </div>
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:5px;">Tipo de Utilizador <span style="color:#ef4444;">*</span></label>
                <div style="display:flex;gap:16px;flex-wrap:wrap;align-items:center;">
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:0.9rem;min-width:160px;flex:0 0 auto;">
                        <input type="radio" name="role" value="tecnico" checked style="accent-color:#1565c0;flex-shrink:0;"> <span style="white-space:normal;">Técnico <small style="color:#94a3b8;display:block;">(painel candidaturas)</small></span>
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:0.9rem;min-width:160px;flex:0 0 auto;">
                        <input type="radio" name="role" value="daac" style="accent-color:#2563eb;flex-shrink:0;"> <span style="white-space:normal;">DAAC <small style="color:#94a3b8;display:block;">(assinar comprovativos)</small></span>
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:0.9rem;min-width:160px;flex:0 0 auto;">
                        <input type="radio" name="role" value="secretaria" style="accent-color:#7c3aed;flex-shrink:0;"> <span style="white-space:normal;">Secretaria <small style="color:#94a3b8;display:block;">(confirmar pagamentos)</small></span>
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:0.9rem;min-width:160px;flex:0 0 auto;">
                        <input type="radio" name="role" value="subcomissao_correcao" style="accent-color:#6d28d9;flex-shrink:0;"> <span style="white-space:normal;">Subcomissão Correcção <small style="color:#94a3b8;display:block;">(corrigir notas)</small></span>
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:0.9rem;min-width:160px;flex:0 0 auto;">
                        <input type="radio" name="role" value="subcomissao_lancamento" style="accent-color:#0f766e;flex-shrink:0;"> <span style="white-space:normal;">Subcomissão Lançamento <small style="color:#94a3b8;display:block;">(editar pautas)</small></span>
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:0.9rem;min-width:160px;flex:0 0 auto;">
                        <input type="radio" name="role" value="presidencia" style="accent-color:#7c3aed;flex-shrink:0;"> <span style="white-space:normal;">Presidência <small style="color:#94a3b8;display:block;">(imprimir pautas)</small></span>
                    </label>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:12px;">
                <button type="submit"
                        style="background:#1565c0;color:#fff;border:none;border-radius:8px;padding:10px 24px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                        onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                    Criar utilizador
                </button>
            </div>
        </form>
    </div>

    {{-- Lista de utilizadores --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <div style="background:#f8fafc;border-bottom:1px solid #e2e8f0;padding:14px 22px;">
            <span style="font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.08em;">
                Utilizadores registados ({{ $usuarios->count() }})
            </span>
        </div>

        @if($usuarios->isEmpty())
        <div style="padding:56px 40px;text-align:center;">
            <svg width="48" height="48" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 14px;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p style="color:#94a3b8;font-size:1rem;margin:0;">Nenhum utilizador.</p>
        </div>
        @else
        <style>
/* Responsive: transform table into stacked cards on small screens */
@media (max-width: 768px) {
  .responsive-table { font-size: 0.95rem; }
  .responsive-table thead { display: none; }
  .responsive-table, .responsive-table tbody, .responsive-table tr, .responsive-table td, .responsive-table th { display: block; width: 100%; }
  .responsive-table tr { margin-bottom: 12px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; }
  .responsive-table td { padding: 8px 12px; display: flex; justify-content: space-between; align-items: center; }
  .responsive-table td[data-label]:before { content: attr(data-label); font-weight: 700; color: #475569; margin-right: 8px; flex-shrink:0; }
  .responsive-table td > div, .responsive-table td > span { flex: 1; }
  .responsive-table .actions-column { display: flex; gap: 8px; flex-direction: row; }
}
</style>

<table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.88rem;">
            <thead>
                <tr style="border-bottom:2px solid #e2e8f0;">
                    <th style="padding:13px 22px;text-align:left;font-weight:700;color:#475569;">#</th>
                    <th style="padding:13px 22px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                    <th style="padding:13px 22px;text-align:left;font-weight:700;color:#475569;">Email</th>
                    <th style="padding:13px 22px;text-align:left;font-weight:700;color:#475569;">Role</th>
                    <th style="padding:13px 22px;text-align:center;font-weight:700;color:#475569;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr style="border-bottom:1px solid #f1f5f9;" id="row-{{ $u->id }}">
                    <td style="padding:14px 22px;color:#94a3b8;font-size:0.8rem;" data-label="ID">{{ $u->id }}</td>
                    <td style="padding:14px 22px;" data-label="Nome">
                        <div style="display:flex;align-items:center;gap:11px;">
                            @php
                            $avatarBg  = match($u->role) { 'admin'=>'#e3f2fd','tecnico'=>'#dcfce7','daac'=>'#ede9fe','secretaria'=>'#fdf4ff','subcomissao_correcao'=>'#f5f3ff','subcomissao_lancamento'=>'#d1fae5','presidencia'=>'#faf5ff', default=>'#f1f5f9' };
                            $avatarClr = match($u->role) { 'admin'=>'#1565c0','tecnico'=>'#15803d','daac'=>'#7c3aed','secretaria'=>'#a21caf','subcomissao_correcao'=>'#6d28d9','subcomissao_lancamento'=>'#0f766e','presidencia'=>'#7c3aed', default=>'#64748b' };
                            @endphp
                            <div style="width:34px;height:34px;border-radius:50%;background:{{ $avatarBg }};color:{{ $avatarClr }};display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.9rem;flex-shrink:0;">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;color:#1a2332;"><a href="{{ route('admin.usuarios.show', $u) }}" target="_blank" style="color:inherit;text-decoration:none;">{{ $u->name }}</a></div>
                                @if($u->id === auth()->id())
                                    <div style="font-size:0.72rem;color:#94a3b8;">(a sua conta)</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="padding:14px 22px;color:#475569;" data-label="Email">{{ $u->email }}</td>
                    <td style="padding:14px 22px;" data-label="Role">
                        @if($u->role === 'admin')
                            <span style="background:#e3f2fd;color:#1565c0;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">Admin</span>
                        @elseif($u->role === 'tecnico')
                            <span style="background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">Técnico</span>
                        @elseif($u->role === 'daac')
                            <span style="background:#ede9fe;color:#7c3aed;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">DAAC</span>
                        @elseif($u->role === 'secretaria')
                            <span style="background:#fdf4ff;color:#a21caf;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">Secretaria</span>
                        @elseif($u->role === 'subcomissao_correcao')
                            <span style="background:#f5f3ff;color:#6d28d9;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">Sub. Correcção</span>
                        @elseif($u->role === 'subcomissao_lancamento')
                            <span style="background:#d1fae5;color:#0f766e;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">Sub. Lançamento</span>
                        @elseif($u->role === 'presidencia')
                            <span style="background:#faf5ff;color:#7c3aed;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">Presidência</span>
                        @else
                            <span style="background:#f1f5f9;color:#64748b;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600;">{{ $u->role }}</span>
                        @endif
                    </td>
                    <td style="padding:10px 22px;" data-label="Ações">
                        @if($u->role !== 'admin')
                        <div class="actions-column" style="display:inline-flex;flex-direction:column;gap:5px;min-width:160px;">
                            {{-- Redefinir password --}}
                            <button onclick="document.getElementById('row-actions-{{ $u->id }}').style.display='table-row';document.getElementById('pwd-panel-{{ $u->id }}').style.display='block';document.getElementById('sig-panel-{{ $u->id }}').style.display='none';"
                                    style="display:flex;align-items:center;gap:6px;background:#fffbeb;color:#92400e;border:1px solid #fde68a;border-radius:7px;padding:5px 12px;font-size:0.8rem;font-weight:600;cursor:pointer;width:100%;text-align:left;"
                                    onmouseover="this.style.background='#fef3c7'" onmouseout="this.style.background='#fffbeb'">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path stroke-linecap="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                Redefinir password
                            </button>
                            {{-- Assinatura digitalizada — apenas DAAC --}}
                            @if($u->role === 'daac')
                            <button onclick="document.getElementById('row-actions-{{ $u->id }}').style.display='table-row';document.getElementById('sig-panel-{{ $u->id }}').style.display='block';document.getElementById('pwd-panel-{{ $u->id }}').style.display='none';"
                                    style="display:flex;align-items:center;gap:6px;background:{{ $u->signature_image ? '#f5f3ff' : '#faf5ff' }};color:#6d28d9;border:1px solid {{ $u->signature_image ? '#c4b5fd' : '#ddd6fe' }};border-radius:7px;padding:5px 12px;font-size:0.8rem;font-weight:600;cursor:pointer;width:100%;text-align:left;"
                                    onmouseover="this.style.background='#ede9fe'" onmouseout="this.style.background='{{ $u->signature_image ? '#f5f3ff' : '#faf5ff' }}'">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H9v-1.414a2 2 0 01.586-1.414z"/></svg>
                                {{ $u->signature_image ? 'Assinatura ✓' : 'Carregar assinatura' }}
                            </button>
                            @endif
                            {{-- Eliminar --}}
                            <form method="POST" action="{{ route('admin.usuarios.destroy', $u) }}"
                                  onsubmit="return confirm('Eliminar o utilizador {{ addslashes($u->name) }}? Esta acção é irreversível.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="display:flex;align-items:center;gap:6px;background:#fff5f5;color:#b91c1c;border:1px solid #fca5a5;border-radius:7px;padding:5px 12px;font-size:0.8rem;font-weight:600;cursor:pointer;width:100%;text-align:left;"
                                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0a1 1 0 01-1-1V5a1 1 0 011-1h8a1 1 0 011 1v1a1 1 0 01-1 1H9z"/></svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                        @else
                            <span style="color:#cbd5e1;font-size:0.8rem;">—</span>
                        @endif
                    </td>
                </tr>
                {{-- Painel de acções inline (hidden) --}}
                @if($u->role !== 'admin')
                <tr style="display:none;" id="row-actions-{{ $u->id }}">
                    <td colspan="5" style="padding:0 22px 16px;">

                        {{-- Painel: redefinir password --}}
                        <div id="pwd-panel-{{ $u->id }}" style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:16px 18px;margin-top:10px;">
                            <div style="font-size:0.78rem;font-weight:700;color:#92400e;margin-bottom:10px;text-transform:uppercase;letter-spacing:.04em;">Redefinir Password</div>
                            <form method="POST" action="{{ route('admin.usuarios.password', $u) }}"
                                  autocomplete="off"
                                  style="display:flex;align-items:flex-end;gap:12px;flex-wrap:wrap;">
                                @csrf @method('PATCH')
                                <input type="text" name="_dummy_user" tabindex="-1" style="display:none;" aria-hidden="true">
                                <input type="password" name="_dummy_pass" tabindex="-1" style="display:none;" aria-hidden="true">
                                <div>
                                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#92400e;margin-bottom:4px;">Nova password (mín. 10)</label>
                                    <input type="password" name="password" required minlength="10" autocomplete="new-password"
                                           style="border:1px solid #fcd34d;border-radius:7px;padding:7px 11px;font-size:0.88rem;width:200px;">
                                </div>
                                <div>
                                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#92400e;margin-bottom:4px;">Confirmar</label>
                                    <input type="password" name="password_confirmation" required minlength="10" autocomplete="new-password"
                                           style="border:1px solid #fcd34d;border-radius:7px;padding:7px 11px;font-size:0.88rem;width:200px;">
                                </div>
                                <button type="submit"
                                        style="background:#f59e0b;color:#fff;border:none;border-radius:7px;padding:8px 18px;font-weight:700;cursor:pointer;font-size:0.88rem;">
                                    Guardar
                                </button>
                                <button type="button"
                                        onclick="document.getElementById('row-actions-{{ $u->id }}').style.display='none'"
                                        style="background:#f1f5f9;color:#475569;border:none;border-radius:7px;padding:8px 14px;font-weight:600;cursor:pointer;font-size:0.88rem;">
                                    Cancelar
                                </button>
                            </form>
                        </div>

                        {{-- Painel: assinatura digitalizada --}}
                        <div id="sig-panel-{{ $u->id }}" style="display:none;background:#f5f3ff;border:1px solid #c4b5fd;border-radius:10px;padding:16px 18px;margin-top:10px;">
                            <div style="font-size:0.78rem;font-weight:700;color:#6d28d9;margin-bottom:12px;text-transform:uppercase;letter-spacing:.04em;">Assinatura Digitalizada</div>
                            @if($u->signature_image)
                            <div style="margin-bottom:14px;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                                <div>
                                    <div style="font-size:0.72rem;color:#94a3b8;font-weight:600;margin-bottom:4px;text-transform:uppercase;">Assinatura actual</div>
                                    <div style="background:#fff;border:1px solid #ddd6fe;border-radius:8px;padding:8px 16px;display:inline-block;">
                                        <img src="{{ $u->signature_image }}" alt="Assinatura de {{ $u->name }}" style="height:48px;max-width:200px;object-fit:contain;display:block;">
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('admin.usuarios.assinatura.remove', $u) }}"
                                      onsubmit="return confirm('Remover a assinatura de {{ addslashes($u->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            style="background:#fee2e2;color:#b91c1c;border:1px solid #fca5a5;border-radius:7px;padding:6px 14px;font-size:0.8rem;font-weight:600;cursor:pointer;">
                                        Remover
                                    </button>
                                </form>
                            </div>
                            @else
                            <p style="font-size:0.85rem;color:#6d28d9;margin-bottom:12px;">Nenhuma assinatura guardada. Carregue uma imagem PNG/JPG da assinatura manuscrita em papel branco.</p>
                            @endif
                            <form method="POST" action="{{ route('admin.usuarios.assinatura', $u) }}"
                                  enctype="multipart/form-data"
                                  style="display:flex;align-items:flex-end;gap:12px;flex-wrap:wrap;">
                                @csrf
                                <div>
                                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#6d28d9;margin-bottom:4px;">
                                        {{ $u->signature_image ? 'Substituir imagem' : 'Carregar imagem' }} (PNG ou JPG, máx. 2 MB)
                                    </label>
                                    <input type="file" name="signature_image" accept="image/png,image/jpeg"
                                           style="border:1px solid #c4b5fd;border-radius:7px;padding:6px 10px;font-size:0.85rem;background:#fff;">
                                </div>
                                <button type="submit"
                                        style="background:#7c3aed;color:#fff;border:none;border-radius:7px;padding:8px 18px;font-weight:700;cursor:pointer;font-size:0.88rem;">
                                    Guardar
                                </button>
                                <button type="button"
                                        onclick="document.getElementById('row-actions-{{ $u->id }}').style.display='none'"
                                        style="background:#f1f5f9;color:#475569;border:none;border-radius:7px;padding:8px 14px;font-weight:600;cursor:pointer;font-size:0.88rem;">
                                    Cancelar
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</div>
@endsection
