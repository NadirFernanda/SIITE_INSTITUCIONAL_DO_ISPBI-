@extends('layouts.site')


@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
        <nav class="text-sm opacity-75 mb-8">
            <a href="/" class="hover:underline">Início</a> \ Contactos
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
            <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Contactos</h1>
            <p class="text-lg text-gray-700">Fale connosco</p>
        </div>
    </div>

    <section class="py-16 bg-white scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
            <div>
                <h2 class="text-3xl font-bold text-[#2563eb] mb-8">Informações de Contacto</h2>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 bg-[#2563eb]/10">
                            <svg class="w-6 h-6 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Endereço</h3>
                            <p class="text-gray-600">Rua Padre Fidalgo entre Artur de Paiva e Francisco de Leite Cardoso S/N<br>Cuito, Bié - Angola</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 bg-[#2563eb]/10">
                            <svg class="w-6 h-6 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Telefone</h3>
                            <p class="text-gray-600">(244) 922 408 061</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 bg-[#2563eb]/10">
                            <svg class="w-6 h-6 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-600">geral@ispbie.ao<br>secretaria@ispbie.ao</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 bg-[#2563eb]/10">
                            <svg class="w-6 h-6 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Horário de Atendimento</h3>
                            <p class="text-gray-600">Segunda a Sexta: 8h00 - 17h00</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="font-semibold text-gray-900 mb-4">Redes Sociais</h3>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/search/top?q=instituto%20superior%20polit%C3%A9cnico%20do%20bi%C3%A9" target="_blank" rel="noopener" aria-label="Facebook ISP-Bié" class="w-10 h-10 rounded-full border border-[#2563eb] text-[#2563eb] flex items-center justify-center hover:bg-[#2563eb] hover:text-white transition-colors transform transition-transform hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.instagram.com/ispbie?igsh=MWpuaWVwMnYyN3c3OA==" target="_blank" rel="noopener" aria-label="Instagram ISP-Bié" class="w-10 h-10 rounded-full border border-[#2563eb] text-[#2563eb] flex items-center justify-center hover:bg-[#2563eb] hover:text-white transition-colors transform transition-transform hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/><path d="M12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/company/instituto-superior-polit%C3%A9cnico-do-bi%C3%A9" target="_blank" rel="noopener" aria-label="LinkedIn ISP-Bié" class="w-10 h-10 rounded-full border border-[#2563eb] text-[#2563eb] flex items-center justify-center hover:bg-[#2563eb] hover:text-white transition-colors transform transition-transform hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg>
                        </a>
                    </div>
                </div>

            <div>
                <h2 class="text-3xl font-bold text-[#2563eb] mb-8">Envie uma Mensagem</h2>
                <form class="space-y-4" novalidate>
                    <div>
                        <label for="contact-name" class="block text-gray-700 font-semibold mb-2">Nome Completo</label>
                        <input id="contact-name" name="nome" type="text" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2563eb]" aria-required="true">
                    </div>
                    <div>
                        <label for="contact-email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input id="contact-email" name="email" type="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2563eb]" aria-required="true">
                    </div>
                    <div>
                        <label for="contact-subject" class="block text-gray-700 font-semibold mb-2">Assunto</label>
                        <input id="contact-subject" name="assunto" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                    </div>
                    <div>
                        <label for="contact-message" class="block text-gray-700 font-semibold mb-2">Mensagem</label>
                        <textarea id="contact-message" name="mensagem" rows="6" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2563eb]" aria-required="true"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#2563eb] text-white px-8 py-4 rounded-lg font-semibold hover:bg-[#1d4ed8] transition-colors">
                        Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-gray-200 rounded-lg overflow-hidden h-96">
            <iframe
                title="Mapa de localização do INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ"
                src="https://www.google.com/maps?q=Rua+Padre+Fidalgo,+Cuito,+Bi%C3%A9,+Angola&output=embed"
                class="w-full h-full border-0"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        </div>
    </section>
@endsection