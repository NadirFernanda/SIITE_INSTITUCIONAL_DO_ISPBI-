<x-guest-layout>
    @if ($errors->any())
        <div class="mb-5 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">E-mail</label>
            <input id="email" name="email" type="email" required autofocus autocomplete="username"
                   value="{{ old('email') }}"
                   placeholder="nome@isp-bie.ao"
                   class="auth-input w-full px-4 py-3 rounded-lg border {{ $errors->has('email') ? 'border-red-400 focus:ring-red-500' : 'border-gray-300 focus:ring-[#1e3a5f]' }} bg-gray-50 text-gray-900 placeholder-gray-500 text-base focus:outline-none focus:ring-2 focus:border-transparent transition">
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Palavra-passe</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                   placeholder="••••••••"
                   class="auth-input w-full px-4 py-3 rounded-lg border {{ $errors->has('password') ? 'border-red-400 focus:ring-red-500' : 'border-gray-300 focus:ring-[#1e3a5f]' }} bg-gray-50 text-gray-900 placeholder-gray-500 text-base focus:outline-none focus:ring-2 focus:border-transparent transition">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-gray-600 select-none cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#1e3a5f] focus:ring-[#1e3a5f]">
                Lembrar-me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-[#1e3a5f] hover:underline">
                    Esqueceu a palavra-passe?
                </a>
            @endif
        </div>

        <button type="submit"
                class="w-full bg-[#1e3a5f] hover:bg-[#0f1f3d] text-white font-bold py-3 rounded-lg shadow-md transition-colors">
            Entrar
        </button>
    </form>
</x-guest-layout>
