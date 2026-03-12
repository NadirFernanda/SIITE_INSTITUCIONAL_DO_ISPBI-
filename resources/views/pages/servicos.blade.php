@extends('layouts.site')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Carta de Serviços',
    'subtitle'   => 'Compromissos e prazos dos serviços institucionais do ISP-Bié.',
    'breadcrumb' => 'Carta de Serviços',
])

		<section class="mb-8 scroll-reveal">
			<h2 class="text-3xl font-bold text-gray-900 mb-8">Serviços Acadêmicos</h2>
				<div class="space-y-4">
					<div class="bg-white p-6 rounded-lg shadow-md interactive-card">
					<div class="flex justify-between items-start">
						<div class="flex-1">
							<h3 class="text-xl font-semibold text-gray-900 mb-2">Emissão de Declaração</h3>
							<p class="text-gray-600 mb-2">Declaração, frequência com notas, sem notas ou conclusão de curso</p>
							<div class="mt-2 flex items-center gap-3">
								<span class="inline-flex items-center bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full">Com urgência: <span class="font-semibold ml-2">48h</span></span>
								<span class="inline-flex items-center bg-[#2563eb] text-white text-xs px-3 py-1 rounded-full">Sem urgência: <span class="font-semibold ml-2">7 dias</span></span>
							</div>
						</div>
					</div>
				</div>

				<div class="bg-white p-6 rounded-lg shadow-md interactive-card">
					<div class="flex justify-between items-start">
						<div class="flex-1">
							<h3 class="text-xl font-semibold text-gray-900 mb-2">Emissão de Certificado</h3>
						<p class="text-gray-600 mb-2">Certificado de conclusão de curso</p>
						<div class="mt-2 flex items-center gap-3">
							<span class="inline-flex items-center bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full">Com urgência: <span class="font-semibold ml-2">30 dias</span></span>
							<span class="inline-flex items-center bg-[#2563eb] text-white text-xs px-3 py-1 rounded-full">Sem urgência: <span class="font-semibold ml-2">60 dias</span></span>
						</div>
						</div>
					</div>
				</div>

				<div class="bg-white p-6 rounded-lg shadow-md interactive-card">
					<div class="flex justify-between items-start">
						<div class="flex-1">
							<h3 class="text-xl font-semibold text-gray-900 mb-2">Solicitação de Histórico Escolar</h3>
						<p class="text-gray-600 mb-2">Histórico completo ou parcial</p>
						<div class="mt-2 flex items-center gap-3">
							<span class="inline-flex items-center bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full">Com urgência: <span class="font-semibold ml-2">7 dias</span></span>
							<span class="inline-flex items-center bg-[#2563eb] text-white text-xs px-3 py-1 rounded-full">Sem urgência: <span class="font-semibold ml-2">15 dias</span></span>
						</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="scroll-reveal mt-8">
			<h2 class="text-3xl font-bold text-gray-900 mb-8">Serviços Administrativos</h2>
				<div class="space-y-4">
					<div class="bg-white p-6 rounded-lg shadow-md interactive-card">
					<h3 class="text-xl font-semibold text-gray-900 mb-2">Matrícula</h3>
					<p class="text-gray-600 mb-2">Processo de matrícula para novos alunos</p>
					<span class="inline-block bg-[#2563eb] text-white text-sm px-3 py-1 rounded-full">Prazo: Conforme calendário</span>
				</div>

				<div class="bg-white p-6 rounded-lg shadow-md interactive-card">
					<h3 class="text-xl font-semibold text-gray-900 mb-2">Renovação de Matrícula</h3>
					<p class="text-gray-600 mb-2">Renovação para estudantes veteranos</p>
					<span class="inline-block bg-[#2563eb] text-white text-sm px-3 py-1 rounded-full">Prazo: Conforme calendário</span>
				</div>
			</div>
		</section>
	</div>
@endsection


