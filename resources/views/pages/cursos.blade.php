@extends('layouts.site')

@section('content')

<section id="cursos" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">

    <!-- Engenharia e Tecnologia -->
    <div class="space-y-8">
        <h2 class="text-3xl font-bold text-[#2563eb] mt-0 mb-6">Engenharias e Inovação Tecnológica</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <x-course-card
                title="Engenharia Informática"
                duration="5 Anos"
                department="Engenharias"
                domain="Engenharias e Telecomunicações"
                :areas="['Desenvolvimento de Software','Redes e Sistemas','Segurança da Informação']"
                gradientFrom="blue-700"
                gradientTo="blue-500">
                Prepara profissionais para desenvolver soluções tecnológicas inovadoras, sistemas de informação, aplicações 
                de software, redes de computadores e infraestrutura de TI, atendendo às demandas da transformação digital.
            </x-course-card>

            <x-course-card
                title="Engenharia em Recursos Hídricos"
                duration="6 Anos"
                department="Engenharias"
                domain="Engenharias e Telecomunicações"
                :areas="['Gestão de Recursos Hídricos','Saneamento e Tratamento de Água','Infraestruturas Hidráulicas']"
                gradientFrom="sky-400"
                gradientTo="blue-400">
                Forma engenheiros especializados na gestão sustentável dos recursos hídricos, desenvolvimento de 
                infraestruturas hidráulicas, tratamento de água e saneamento básico, essenciais para o desenvolvimento regional.
            </x-course-card>
        </div>
    </div>

    <!-- Ciências Sociais, Humanas e Económicas -->
    <div class="space-y-8">
        <h2 class="text-3xl font-bold text-[#16a34a] mt-0 mb-6">Ciências Sociais, Humanas e Económicas</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-course-card
                title="Contabilidade e Administração"
                duration="4 Anos"
                department="Ciências Humanas, Sociais e Económicas"
                domain="Administração, Negócios e Direito"
                :areas="['Contabilidade e Auditoria','Gestão Empresarial','Consultoria Financeira']"
                gradientFrom="yellow-500"
                gradientTo="yellow-400">
                Forma profissionais capacitados para atuar nas áreas de contabilidade, gestão empresarial, auditoria, 
                finanças e administração, desenvolvendo competências para a tomada de decisões estratégicas em organizações públicas e privadas.
            </x-course-card>

            <x-course-card
                title="Comunicação Social"
                duration="4 Anos"
                department="Ciências Humanas, Sociais e Económicas"
                domain="Comunicação, Jornalismo e Media"
                :areas="['Jornalismo','Rádio e Televisão','Marketing e Relações Públicas']"
                gradientFrom="pink-500"
                gradientTo="rose-400">
                Prepara profissionais para atuar na produção de conteúdos, jornalismo, comunicação institucional e media digitais, 
                promovendo informação precisa e ética em diversos contextos sociais e corporativos.
            </x-course-card>
        </div>
    </div>

    <!-- Ciências da Saúde -->
    <div class="space-y-8">
        <h2 class="text-3xl font-bold text-[#dc2626] mt-0 mb-6">Ciências da Saúde</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <x-course-card
                title="Enfermagem Geral"
                duration="4 Anos"
                department="Ciências da Saúde"
                domain="Saúde e Bem-estar"
                :areas="['Cuidados de Enfermagem','Saúde Comunitária','Gestão Hospitalar']"
                gradientFrom="red-600"
                gradientTo="red-400">
                Forma profissionais qualificados para prestar cuidados de saúde de forma segura e humanizada, 
                atuando em hospitais, clínicas, centros de saúde e programas comunitários.
            </x-course-card>

            <x-course-card
                title="Psicologia Clínica"
                duration="5 Anos"
                department="Ciências da Saúde"
                domain="Saúde Mental"
                :areas="['Psicoterapia','Aconselhamento','Avaliação Psicológica']"
                gradientFrom="violet-600"
                gradientTo="violet-400">
                Prepara profissionais para atuar na saúde mental, realizando avaliação psicológica, psicoterapia e 
                acompanhamento clínico, promovendo bem-estar emocional e qualidade de vida.
            </x-course-card>
        </div>
    </div>

</section>

@endsection

