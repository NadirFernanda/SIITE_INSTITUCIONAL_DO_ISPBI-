@extends('layouts.site')


@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
      <nav class="text-sm mb-8">
        <a href="/" class="hover:underline">Início</a>
        <span class="mx-2">/</span>
        <span>Resultados de Exames</span>
      </nav>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Resultados de Exames</h1>
        <p class="text-lg text-gray-700">Consulte as suas notas online</p>
      </div>

  <!-- Informação -->
  <section class="py-8 bg-yellow-50 border-b scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-start">
        <svg class="w-6 h-6 text-yellow-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <div>
          <h3 class="font-bold text-gray-900 mb-2">Importante</h3>
          <p class="text-gray-700">
            As notas são publicadas até 7 dias úteis após a realização dos exames. 
            Em caso de discrepância, o estudante tem o direito de solicitar a revisão da prova no prazo de 48 horas após a publicação.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Sistema de Consulta -->
  <section class="py-16 bg-gray-50 scroll-reveal">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Formulário de Acesso -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8 interactive-card">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Acesso ao Portal de Resultados</h2>
        <p class="text-gray-600 mb-6">
          Faça login com as suas credenciais do Portal do Estudante para consultar os resultados.
        </p>


        <form class="space-y-6">
          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
              Email
            </label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              placeholder="Digite o seu email"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2563eb] focus:border-transparent"
              required
            >
          </div>

          <!-- Senha -->
          <div>
            <label for="senha" class="block text-sm font-semibold text-gray-700 mb-2">
              Senha
            </label>
            <input 
              type="password" 
              id="senha" 
              name="senha" 
              placeholder="Digite a sua senha"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2563eb] focus:border-transparent"
              required
            >
          </div>

          <!-- Botão -->
          <button 
            type="submit" 
            class="w-full bg-[#2563eb] text-white py-3 rounded-lg font-semibold hover:bg-[#1f3342] transition-colors flex items-center justify-center"
          >
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            Entrar no Portal
          </button>
        </form>

        <!-- Links -->
        <div class="mt-6 pt-6 border-t border-gray-200 text-center">
          <a href="/portal" class="text-[#2563eb] hover:underline text-sm font-semibold">
            Esqueceu a senha?
          </a>
          <span class="text-gray-400 mx-3">|</span>
          <a href="/portal" class="text-[#2563eb] hover:underline text-sm font-semibold">
            Primeiro acesso? Criar conta
          </a>
        </div>
      </div>

      <!-- Conteúdo de demonstração de resultados e FAQ removido conforme solicitado -->
    </div>
  </section>

  <!-- FAQ removido conforme solicitado -->

  <!-- CTA -->
  <section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h3 class="text-2xl font-bold text-gray-900 mb-4">Precisa de Ajuda?</h3>
      <p class="text-lg text-gray-600 mb-6">
        Entre em contacto com os Serviços Académicos para esclarecimento de dúvidas.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/contactos" class="inline-block bg-[#2563eb] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#1f3342] transition-colors">
          Contactar Serviços Académicos
        </a>
        <a href="/guia-estudante" class="inline-block bg-white text-[#2563eb] border-2 border-[#2563eb] px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
          Ver Guia do Estudante
        </a>
      </div>
    </div>
  </section>
@endsection

