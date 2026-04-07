<style>
  #email:focus, #password:focus { border-color: #1565c0 !important; }
</style>
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;background:#f4f8fb;">
    <div style="width:100%;max-width:410px;margin:auto;">
        <div style="text-align:center;margin-bottom:18px;">
            <img src="/images/logo.png" alt="Logo" style="max-width:110px;margin-bottom:10px;">
            <h2 style="font-size:2rem;font-weight:700;color:#1565c0;margin-bottom:2px;">Painel administrativo do site</h2>
        </div>
        <form method="POST" action="{{ route('login') }}" style="background:#fff;padding:32px 28px 24px 28px;border-radius:18px;box-shadow:0 4px 24px rgba(21,101,192,0.10);display:flex;flex-direction:column;gap:18px;">
            @csrf
            <!-- Session Status -->
            <x-auth-session-status class="mb-2" :status="session('status')" />
            @if(session('errors'))
                <div style="color:#e3342f;background:#fff0f0;padding:8px 14px;border-radius:8px;font-size:1rem;text-align:center;">{{ $errors->first() }}</div>
            @endif
            <input id="email" name="email" type="email" required autofocus autocomplete="username"
                placeholder="E-mail"
                value="{{ old('email') }}"
                style="width:100%;padding:13px 16px;border:2px solid #dbeafe;border-radius:10px;font-size:1.08rem;background:#f8fafc;transition:border .2s;outline:none;"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
            <input id="password" name="password" type="password" required autocomplete="current-password"
                placeholder="Senha"
                style="width:100%;padding:13px 16px;border:2px solid #dbeafe;border-radius:10px;font-size:1.08rem;background:#f8fafc;transition:border .2s;outline:none;"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:8px;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size:0.98rem;color:#1565c0;text-decoration:underline;">Esqueceu a sua palavra-passe?</a>
                @endif
                <button type="submit" style="background:#1565c0;color:#fff;padding:12px 32px;border:none;border-radius:10px;font-weight:700;font-size:1.1rem;box-shadow:0 2px 8px rgba(21,101,192,0.10);transition:background 0.2s;cursor:pointer;">Entrar</button>
            </div>
        </form>
    </div>
</div>
