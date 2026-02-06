<footer class="border-t mt-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 py-8 text-sm text-[var(--brand-dark)]">
    <div class="grid grid-cols-2 gap-4 md:grid-cols-none md:flex md:flex-row md:justify-between md:items-center">
      <div class="bg-gray-50 rounded-lg p-3 flex items-center space-x-3">
        <img src="/images/logo.svg" alt="ISP-Bié" class="w-8 h-8 object-contain" onerror="this.style.display='none'">
        <div>
          <strong class="text-xs md:text-sm">Instituto Superior Politécnico do Bié</strong>
          <div class="text-[10px] md:text-xs text-gray-500">Endereço (placeholder)</div>
        </div>
      </div>
      <div class="bg-gray-50 rounded-lg p-3 text-gray-600 flex flex-col justify-center">
        <div><a href="/contactos" class="hover:underline link-brand text-xs md:text-sm">Contactos</a></div>
        <div class="mt-2 text-[10px] md:text-xs">© ISP-Bié</div>
      </div>
    </div>
    <div class="flex justify-end gap-2 mt-6">
      <!-- Botão Voltar ao Topo -->
      <button onclick="window.scrollTo({top: 0, behavior: 'smooth'});" aria-label="Voltar ao topo" class="bg-[#2563eb] text-white px-3 py-2 rounded-full shadow hover:bg-[#174ea6] transition-colors flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
        Topo
      </button>
      <!-- Botão Ir para o Fim -->
      <button onclick="window.scrollTo({top: document.body.scrollHeight, behavior: 'smooth'});" aria-label="Ir para o fim" class="bg-[#F05A28] text-white px-3 py-2 rounded-full shadow hover:bg-[#c94a1f] transition-colors flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        Fim
      </button>
    </div>
  </div>
</footer>
