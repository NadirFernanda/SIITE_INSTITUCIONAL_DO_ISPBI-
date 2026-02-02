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

      <!-- Demonstração de Resultados -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8 interactive-card">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Exemplo de Pauta de Notas</h2>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="bg-gray-100 border-b-2 border-gray-300">
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Disciplina</th>
                <th class="text-center py-3 px-4 font-semibold text-gray-700">1ª Parcial</th>
                <th class="text-center py-3 px-4 font-semibold text-gray-700">2ª Parcial</th>
                <th class="text-center py-3 px-4 font-semibold text-gray-700">Exame</th>
                <th class="text-center py-3 px-4 font-semibold text-gray-700">Estado</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">Matemática I</td>
                <td class="text-center py-3 px-4">14</td>
                <td class="text-center py-3 px-4">15</td>
                <td class="text-center py-3 px-4 font-bold">16</td>
                <td class="text-center py-3 px-4">
                  <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                    Aprovado
                  </span>
                </td>
              </tr>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">Física Geral</td>
                <td class="text-center py-3 px-4">12</td>
                <td class="text-center py-3 px-4">11</td>
                <td class="text-center py-3 px-4 font-bold">13</td>
                <td class="text-center py-3 px-4">
                  <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                    Aprovado
                  </span>
                </td>
              </tr>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">Química Geral</td>
                <td class="text-center py-3 px-4">15</td>
                <td class="text-center py-3 px-4">16</td>
                <td class="text-center py-3 px-4 font-bold">17</td>
                <td class="text-center py-3 px-4">
                  <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                    Aprovado
                  </span>
                </td>
              </tr>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">Desenho Técnico</td>
                <td class="text-center py-3 px-4">16</td>
                <td class="text-center py-3 px-4">17</td>
                <td class="text-center py-3 px-4 font-bold">18</td>
                <td class="text-center py-3 px-4">
                  <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                    Aprovado
                  </span>
                </td>
              </tr>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">Informática</td>
                <td class="text-center py-3 px-4">10</td>
                <td class="text-center py-3 px-4">9</td>
                <td class="text-center py-3 px-4 font-bold text-red-600">8</td>
                <td class="text-center py-3 px-4">
                  <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                    Reprovado
                  </span>
                </td>
              </tr>
              <tr class="bg-gray-50 font-bold">
                <td class="py-3 px-4" colspan="4">Média do Semestre</td>
                <td class="text-center py-3 px-4 text-lg">14,0</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="text-sm text-gray-500 mt-4">
          <strong>Nota:</strong> As notas das parcelares e do exame são publicadas individualmente ao longo do semestre.
        </p>
      </div>

      <!-- Recurso de Prova -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8 interactive-card">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Recurso de Prova</h2>
        <p class="text-gray-700 mb-4">
          Se não concordar com a nota atribuída, pode solicitar a revisão da prova de exame seguindo os procedimentos:
        </p>
        <div class="space-y-4">
          <div class="flex items-start">
            <div class="w-8 h-8 bg-[#2563eb] text-white rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">
              1
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">Prazo</h4>
              <p class="text-gray-600">Solicitar recurso até 48 horas após a publicação das notas</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="w-8 h-8 bg-[#2563eb] text-white rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">
              2
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">Requerimento</h4>
              <p class="text-gray-600">Preencher formulário de recurso nos Serviços Académicos</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="w-8 h-8 bg-[#2563eb] text-white rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">
              3
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">Taxa</h4>
              <p class="text-gray-600">Pagamento de taxa de 5.000 Kz (reembolsável se o recurso for deferido)</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="w-8 h-8 bg-[#2563eb] text-white rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">
              4
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">Resposta</h4>
              <p class="text-gray-600">Resultado do recurso em até 5 dias úteis</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="py-16 bg-white scroll-reveal">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Perguntas Frequentes</h2>
      <div class="space-y-4">
        <div class="border border-gray-200 rounded-lg p-6 interactive-card">
          <h4 class="font-semibold text-gray-900 mb-2">Quando são publicadas as notas?</h4>
          <p class="text-gray-600">
            As notas são publicadas até 7 dias úteis após a realização do exame final de cada disciplina.
          </p>
        </div>
        <div class="border border-gray-200 rounded-lg p-6 interactive-card">
          <h4 class="font-semibold text-gray-900 mb-2">Como é calculada a nota final?</h4>
          <p class="text-gray-600">
            Os estudantes são avaliados através de duas parcelares (1Âª e 2Âª) e um exame final. A nota mínima de aprovação é 10 valores.
          </p>
        </div>
        <div class="border border-gray-200 rounded-lg p-6 interactive-card">
          <h4 class="font-semibold text-gray-900 mb-2">Posso fazer exame de melhoria?</h4>
          <p class="text-gray-600">
            Contacte os Serviços Académicos para informações sobre exames de melhoria e época de recurso.
          </p>
        </div>
        <div class="border border-gray-200 rounded-lg p-6 interactive-card">
          <h4 class="font-semibold text-gray-900 mb-2">O que acontece se reprovar em mais de 3 disciplinas?</h4>
          <p class="text-gray-600">
            O estudante deve repetir o ano lectivo, matriculando-se novamente nas disciplinas em falta.
          </p>
        </div>
      </div>
    </div>
  </section>

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

