<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6 mt-4 p-6 bg-white rounded-xl shadow-lg">
        @csrf

        <!-- Usuário -->
        <input id="email" name="email" type="email" required autofocus autocomplete="username"
            placeholder="Usuário" value="{{ old('email') }}"
            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl text-base placeholder-gray-400 shadow-sm focus:outline-none focus:border-ispbie-orange focus:ring-2 focus:ring-ispbie-orange transition-all duration-200"
            oninvalid="this.setCustomValidity('Por favor, preencha o campo Usuário.')"
            oninput="this.setCustomValidity('')"
        />
        <x-input-error :messages="$errors->get('email')" class="mt-1" />

        <!-- Senha -->
        <input id="password" name="password" type="password" required autocomplete="current-password"
            placeholder="Senha"
            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl text-base placeholder-gray-400 shadow-sm focus:outline-none focus:border-ispbie-orange focus:ring-2 focus:ring-ispbie-orange transition-all duration-200"
            oninvalid="this.setCustomValidity('Por favor, preencha o campo Senha.')"
            oninput="this.setCustomValidity('')"
        />
        <x-input-error :messages="$errors->get('password')" class="mt-1" />

        <div class="flex flex-col sm:flex-row items-center justify-between mt-4 gap-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-ispbie-blue hover:text-ispbie-orange rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ispbie-orange" href="{{ route('password.request') }}">
                    Esqueceu a sua palavra-passe?
                </a>
            @endif
            <button type="submit" class="btn-ispbie w-full sm:w-auto text-lg py-3 px-8 rounded-xl shadow-md">Entrar</button>
        </div>
    </form>
</x-guest-layout>
