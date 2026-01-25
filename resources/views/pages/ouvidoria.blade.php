<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ouvidoria - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <!-- Banner -->
    <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16">
        <div class="container mx-auto px-6">
            <div class="flex items-center mb-4">
                <svg class="w-12 h-12 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"/>
                </svg>
                <h1 class="text-5xl font-bold">Ouvidoria</h1>
            </div>
            <p class="text-xl text-green-100 max-w-3xl">
                Canal de comunicação direto com a comunidade acadêmica
            </p>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Ouvidoria</span>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-6 py-12">
        <!-- Formulário de Manifestação -->
        <section class="mb-16">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Envie sua Manifestação</h2>
                <p class="text-gray-600 mb-8">A Ouvidoria do ISP-Bié recebe reclamações, sugestões, elogios, denúncias e solicitações de informação.</p>
                
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <form>
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Tipo de Manifestação</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <option>Selecione...</option>
                                <option>Reclamação</option>
                                <option>Sugestão</option>
                                <option>Elogio</option>
                                <option>Denúncia</option>
                                <option>Solicitação de Informação</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Nome Completo</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Seu nome completo">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="seu@email.com">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Telefone</label>
                                <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="(244) 922 408 061">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Assunto</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Assunto da sua manifestação">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Mensagem</label>
                            <textarea rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Descreva sua manifestação com o máximo de detalhes possível"></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                <span class="ml-2 text-gray-700">Desejo manter o anonimato</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-teal-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                            Enviar Manifestação
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Informações sobre a Ouvidoria -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Como Funciona a Ouvidoria</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl font-bold text-green-600">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Envio</h3>
                    <p class="text-gray-600">Você envia sua manifestação através do formulário online ou presencialmente</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl font-bold text-teal-600">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Análise</h3>
                    <p class="text-gray-600">Sua manifestação é analisada e encaminhada ao setor responsável</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl font-bold text-orange-600">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Resposta</h3>
                    <p class="text-gray-600">Você recebe uma resposta em até 15 dias úteis</p>
                </div>
            </div>
        </section>

        <!-- Estatísticas -->
        <section class="mb-16">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-xl p-8 text-white">
                <h2 class="text-3xl font-bold mb-8 text-center">Estatísticas 2024</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2">342</div>
                        <div class="text-teal-100">Manifestações Recebidas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2">95%</div>
                        <div class="text-teal-100">Taxa de Resposta</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2">12</div>
                        <div class="text-teal-100">Dias Média de Resposta</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2">89%</div>
                        <div class="text-teal-100">Satisfação</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contactos -->
        <section class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Outros Canais de Atendimento</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <p class="text-gray-600">ouvidoria@ispbie.ao</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Telefone</h3>
                        <p class="text-gray-600">(244) 922 408 061</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Presencial</h3>
                        <p class="text-gray-600">Edifício Principal, Sala 105<br>Segunda a Sexta, 8h Í s 17h</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">WhatsApp</h3>
                        <p class="text-gray-600">+244 000 000 000</p>
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>
    @include('partials.footer')
</html>

