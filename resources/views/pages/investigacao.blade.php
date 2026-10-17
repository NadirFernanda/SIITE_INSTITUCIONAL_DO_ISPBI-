@extends('layouts.site')

@section('title', 'Investigação, Inovação e Empreendedorismo')
@section('meta_description', 'Conheça os 71 projectos de investigação do ISP-Bié, organizados por estado e área científica, com base no inventário institucional de 2024–2025.')

@push('head')
    <style>[x-cloak] { display: none !important; }</style>
@endpush

@php
    // Fonte: BASE_DE_DADOS_DOS_PROJECTOS_2024-2025_ACTUALIZADA.xlsx, folha PROJECTOS.
    // Os títulos mantêm a grafia e a classificação da listagem. A coluna E indica o estado.
    // O cabeçalho "PROJECTOS EXECUTADOS (55)" diverge das 53 linhas e do resumo final (53).
    $projectos = [
        ['titulo' => 'Programa Mulheres do Bié em STEM', 'area' => 'Não indicada no documento', 'estado' => 'elaboracao', 'linha' => 14, 'destaque' => true],
        ['titulo' => 'Cuito Business School - Escola de Negócios do ISP-Bié', 'area' => 'Não indicada no documento', 'estado' => 'elaboracao', 'linha' => 15, 'destaque' => true],
        ['titulo' => 'Programa KAZA de Segurança Hídrica Transfronteiriça Resiliente ao Clima e Investimento na Paisagem Kavango-Zambezi (KAZA-WaSIP)', 'area' => 'Não indicada no documento', 'estado' => 'elaboracao', 'linha' => 16, 'destaque' => true],
        ['titulo' => 'Intervenção de cuidados continuados em adultos com doenças cronicas não transmissíveis na comunidade bairro Cantíflas Cuito-Bié', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'curso', 'linha' => 18],
        ['titulo' => 'Práticas de Enfermagem em mulheres candidatas com Hemorragia em Peri, Parto e Puerpério na Maternidade do Cuito-Bié;', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'curso', 'linha' => 19],
        ['titulo' => 'Impacto do Alcoolismo e suas Consequências na População Jovem no Bairro Cantíflas Cuito-Bié;', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'curso', 'linha' => 20],
        ['titulo' => 'Sistema de acções na Gestão Económica e Finaceira para o Desenvolvimento Local das empresas e instituições públicas e privadas do Cuito, Província do Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Contabilidade e Administração', 'estado' => 'curso', 'linha' => 21],
        ['titulo' => 'Criação de uma Rádio Internet do ISP-BIÉ.', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'curso', 'linha' => 22],
        ['titulo' => 'Proposta de Monitoramento Hidrometeorológico sem Suporte de Sensor Remoto na Bacia do rio Cuquema, Cuito – Bié;', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'curso', 'linha' => 23],
        ['titulo' => 'Avaliação da Qualidade das Águas Subterrâneas Utilizadas para o Consumo Humano ao Redor dos Cemitérios do Cuito-Bié', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'curso', 'linha' => 24],
        ['titulo' => 'Sistema de Alerta para reduzir o Risco de Inundações na Localidade de Cangote, Município do Cuito - Bié, Angola;', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'curso', 'linha' => 25],
        ['titulo' => 'Projecto TEST', 'area' => 'Não indicada no documento', 'estado' => 'curso', 'linha' => 26, 'destaque' => true],
        ['titulo' => 'Modernização e Apetrechamento da Sala de Informática do Instituto Superior Politécnico do Bié (ISP-Bié)', 'area' => 'Engenharias e Inovação Tecnológicas', 'estado' => 'avaliacao', 'linha' => 28],
        ['titulo' => 'Apetrechamento e Modernização do Laboratório de Simulação Clínica do Instituto Superior Politécnico do Bié (ISP-BIÉ)', 'area' => 'Ciências da Saúde', 'estado' => 'avaliacao', 'linha' => 29],
        ['titulo' => 'Apetrechamento e Reforço Técnico-Científico do Laboratorio de Hidrología do curso de Engenharia em Recursos Hídricos', 'area' => 'Engenharias e Inovação Tecnológicas', 'estado' => 'avaliacao', 'linha' => 30],
        ['titulo' => 'Fortalecimento das Competências Científicas: Capacitação de Docentes do ISPB na Elaboração de Projetos de Investigação', 'area' => 'Investigação Científica, Inovação, Empreendedorismo e Pós-Graduação', 'estado' => 'avaliacao', 'linha' => 31],
        ['titulo' => 'Reforço da Infraestrutura de Apoio Académico: Apetrechamento da Biblioteca do Instituto Superior Politécnico do Bié (ISP-Bié)', 'area' => 'Biblioteca', 'estado' => 'avaliacao', 'linha' => 32],
        ['titulo' => 'Criação e Apetrechamento da Sala de Análise de Dados Qualitativos e Quantitativos do Instituto Superior Politécnico do Bié', 'area' => 'Engenharias e Inovação Tecnológicas', 'estado' => 'avaliacao', 'linha' => 33],
        ['titulo' => 'Boas práticas de enfermagem ginecobstétrica: desafios e perspectivas em estágio', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 35],
        ['titulo' => 'Cuidados culturais e familiares em adultos com diabetes mellitus tipo 2 em Angola', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 36],
        ['titulo' => 'Motivação profissional e estratégias de aprendizagem. Estudo comparativo no Instituto Superior Politécnico do Bié', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 37],
        ['titulo' => 'Processo de cuidado de enfermagem a pacientes com traumatismo cranioencefálico', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 38],
        ['titulo' => 'Intervenção de enfermagem na hemorragia pós-parto', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 39],
        ['titulo' => 'Superação da equipe de enfermagem nos níveis de apoio às mulheres da idade média na província do Bié. Proposta de intervenção educacional', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 40],
        ['titulo' => 'Gravidez na adolescência: adesão das adolescentes grávidas às consultas pré-natais', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 41],
        ['titulo' => 'A prática de leitura como factor determinante na aquisição de conhecimentos em enfermagem nos estudantes do Instituto Superior Politécnico do Bié', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 42],
        ['titulo' => 'Os ciclos dos desastres e sua metodologia para a mitigação dos riscos', 'area' => 'Ciências da Saúde', 'curso' => 'Enfermagem Geral', 'estado' => 'executado', 'linha' => 43],
        ['titulo' => 'A pegada hídrica do milho sob rega por pivot central no projecto Novagrolider Quibala/Cuanza Sul, República de Angola 2025', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 44],
        ['titulo' => 'Vulnerabilidade à contaminação das águas subterrâneas numa zona ocupada por cemitério: bairro Fátima-Cachiungo, Huambo', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 45],
        ['titulo' => 'Dimensionamento da rede técnica de água fria de um edifício de 12 pisos', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 46],
        ['titulo' => 'Gestão sustentável dos recursos hídricos em cenários de mudanças climáticas: o caso do sul de Angola', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 47],
        ['titulo' => 'Infraestruturas na construção civil: um factor de desenvolvimento social e económico no município do Cuito', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 48],
        ['titulo' => 'Proposta de gestão de protecção ambiental em Angola. Estudo de caso: estação de captação de água do rio Cuquema, província do Bié, Cuito (2022 – 2024)', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 49],
        ['titulo' => 'Educação ambiental versus saneamento ambiental', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 50],
        ['titulo' => 'A descontinuidade da infraestrutura de saneamento e drenagem pluvial do habitat popular da cidade do Cuito', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 51],
        ['titulo' => 'Programação dinâmica como ferramenta de planeamento de actividades', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 52],
        ['titulo' => 'Proposta de desenho de uma rede de abastecimento de água potável e drenagem de águas residuais para o centro urbano do município de Catabola', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia de Recursos Hídricos', 'estado' => 'executado', 'linha' => 53],
        ['titulo' => 'Implementação de serviços IPTV nas instituições de ensino superior: caso de estudo Instituto Superior Politécnico do Bié, Angola', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 54],
        ['titulo' => 'Proposta de aplicação de técnicas de aprendizado de máquina para orientação vocacional de exame de acesso ao ensino superior: caso de estudo no Instituto Superior Politécnico', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 55],
        ['titulo' => 'Sistema informático para gestão e monitoramento dos autocarros da agência de viagens Real Express do Cuito-Bié', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 56],
        ['titulo' => 'Proposta de implementação de um sistema inteligente de alerta contra fumaça, gás e álcool nos armazéns da empresa Grupo Carrinho na província do Bié, em Angola', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 57],
        ['titulo' => 'Aplicação de TIC e ferramentas multimédia na prática fotográfica para estratégias de comunicação corporativa no Instituto Superior Politécnico do Bié', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 58],
        ['titulo' => 'A utilização de TICs no ensino e aprendizagem da língua inglesa, aos estudantes do 4.º ano do curso de Enfermagem, do Instituto Superior Politécnico do Bié', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 59],
        ['titulo' => 'Rumo a um uso ético da inteligência artificial na educação', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 60],
        ['titulo' => 'Optimização de horários académicos aplicando técnicas de IA no curso de Engenharia Informática no ISP-Bié', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 61],
        ['titulo' => 'Proposta de um método de investigação científica-tecnológica para estudantes de licenciatura e pós-graduação', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 62],
        ['titulo' => 'IA adaptativa hands-on: rotas dinâmicas, matching e tutores inteligentes na plataforma Ascende', 'area' => 'Engenharias e Inovação Tecnológicas', 'curso' => 'Engenharia Informática', 'estado' => 'executado', 'linha' => 63],
        ['titulo' => 'O impacto das políticas e práticas de recursos humanos no presentismo e na procrastinação: um estudo empírico efectuado na administração pública angolana', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Contabilidade e Administração', 'estado' => 'executado', 'linha' => 64],
        ['titulo' => 'Procedimentos da auditoria interna para o controlo de imobilizados corpóreos da empresa Yusildany Consultoria, Fiscalização e Prestação de Serviços Lda. do Cuito-Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Contabilidade e Administração', 'estado' => 'executado', 'linha' => 65],
        ['titulo' => 'Aplicativo de controle salarial e financeiro', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Contabilidade e Administração', 'estado' => 'executado', 'linha' => 66],
        ['titulo' => 'Proposta de indicadores para a sustentabilidade do transporte urbano nas cidades modernas', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Contabilidade e Administração', 'estado' => 'executado', 'linha' => 67],
        ['titulo' => 'Papel do Estado na promoção e garantia do interesse público: visões de Marx, Engels e da Public Choice', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Contabilidade e Administração', 'estado' => 'executado', 'linha' => 68],
        ['titulo' => 'A participação das mulheres no mercado de trabalho, como manifestação do enfoque de género', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Contabilidade e Administração', 'estado' => 'executado', 'linha' => 69],
        ['titulo' => 'Contributo do comunicador social formado na ESP-Bié no mercado laboral do Cuito', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 70],
        ['titulo' => 'Prosumidores mediáticos: a criação de comunidades virtuais digitais', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 71],
        ['titulo' => 'O audiovisual como ferramenta de transformação social: uma experiência interdisciplinar na “Aldea Nissi”', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 72],
        ['titulo' => 'A extensão universitária desde a comunicação para o desenvolvimento nas comunidades bienas', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 73],
        ['titulo' => 'O papel do curso de Comunicação Social no contexto angolano', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 74],
        ['titulo' => 'Educação cidadã na formação profissional universitária. Experiência inclusiva no Instituto Politécnico do Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 75],
        ['titulo' => 'Perfil adequado para o docente universitário no contexto angolano', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 76],
        ['titulo' => 'O ensino da língua portuguesa em contexto multilíngue no Magistério Cândida Celeste, província do Bié/Cuito', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 77],
        ['titulo' => 'Realidade da prostituição no Cuito (Bié): causas, consequências sociais e perspectivas de intervenção comunitária', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 78],
        ['titulo' => 'O cepticismo e o relativismo actuais: seus reflexos directos no ser e no agir da pessoa', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 79],
        ['titulo' => 'Campanhas de bem público para o desenvolvimento sustentável dos moradores do bairro Cantiflas no município do Cuito-Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 80],
        ['titulo' => 'Comunicação educativa na prevenção do consumo de álcool em jovens do bairro Cantiflas no Cuito/Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 81],
        ['titulo' => 'A relação entre o assédio moral e a imagem das instituições do ensino superior', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 82],
        ['titulo' => 'Estratégias comunicativas para o reforço do programa Minha Rua Minha Paixão, Meu Bairro Minha Paixão no Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 83],
        ['titulo' => 'O papel da comunicação na gestão de crises: “Empresa Grupo Orquídea”', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Comunicação Social', 'estado' => 'executado', 'linha' => 84],
        ['titulo' => 'Síndrome de burnout nos estudantes-trabalhadores do ISP-Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Psicologia', 'estado' => 'executado', 'linha' => 85],
        ['titulo' => 'Impacto do assédio sexual nas estudantes das instituições de ensino superior', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Psicologia', 'estado' => 'executado', 'linha' => 86],
        ['titulo' => 'Prevalência da síndrome de burnout nos profissionais de enfermagem do Hospital Sanatório do Cuito-Bié', 'area' => 'Ciências Humanas Sociais e Económicas', 'curso' => 'Curso de Psicologia', 'estado' => 'executado', 'linha' => 87],
    ];

    $estados = [
        'elaboracao' => ['titulo' => 'Projectos em elaboração', 'resumo' => 'Iniciativas em preparação, conforme a listagem institucional.', 'rotulo' => 'Em elaboração'],
        'curso' => ['titulo' => 'Projectos em curso', 'resumo' => 'Trabalhos classificados como em curso no inventário.', 'rotulo' => 'Em curso'],
        'avaliacao' => ['titulo' => 'Projectos em avaliação', 'resumo' => 'Propostas e iniciativas sob avaliação, conforme o inventário.', 'rotulo' => 'Em avaliação'],
        'executado' => ['titulo' => 'Projectos executados', 'resumo' => 'Registos classificados como executados no inventário institucional.', 'rotulo' => 'Executado'],
    ];
    $porEstado = ['elaboracao' => [], 'curso' => [], 'avaliacao' => [], 'executado' => []];
    foreach ($projectos as $projecto) {
        $porEstado[$projecto['estado']][] = $projecto;
    }
    $areas = array_values(array_unique(array_column($projectos, 'area')));
    sort($areas);
@endphp

@section('content')
<div class="mx-auto max-w-7xl px-4 pb-16 pt-4 sm:px-6 lg:px-8"
     x-data="{
        estado: 'todos', area: 'todas', pesquisa: '',
        normalizar(valor) { return String(valor || '').normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase(); },
        combina(elemento) {
            return (this.estado === 'todos' || elemento.dataset.estado === this.estado)
                && (this.area === 'todas' || elemento.dataset.area === this.area)
                && this.normalizar(elemento.dataset.busca).includes(this.normalizar(this.pesquisa.trim()));
        },
        contar(estado = null) {
            return Array.from(document.querySelectorAll('#catalogo-projectos [data-projecto]'))
                .filter(elemento => (!estado || elemento.dataset.estado === estado) && this.combina(elemento)).length;
        }
     }">
    @include('partials.page-hero', [
        'title' => 'Investigação, Inovação e Empreendedorismo',
        'subtitle' => 'Conhecimento aplicado aos desafios das comunidades.',
        'breadcrumb' => 'Investigação',
    ])

    <section aria-labelledby="titulo-introducao" class="relative mb-10 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="absolute inset-y-0 left-0 w-1.5 bg-[#F05A28]" aria-hidden="true"></div>
        <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-center lg:p-10">
            <div>
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Investigação no ISP-Bié</p>
                <h2 id="titulo-introducao" class="text-2xl font-extrabold tracking-tight text-[#1e3a5f] sm:text-3xl">Ciência próxima das comunidades</h2>
                <p class="mt-4 max-w-3xl leading-relaxed text-slate-600">
                    A investigação, a inovação e o empreendedorismo integram a missão académica do ISP-Bié.
                    O inventário institucional reúne trabalhos em saúde, recursos hídricos, tecnologia,
                    ciências humanas e outras áreas, com temas ligados a necessidades das comunidades.
                    Explore cada projecto pelo estado registado e pela área identificada no documento.
                </p>
            </div>
            <div class="rounded-2xl bg-[#142d4f] px-6 py-5 text-white lg:max-w-56">
                <span class="block text-4xl font-black">71</span>
                <span class="mt-1 block text-sm font-semibold text-blue-100">projectos no inventário 2024–2025</span>
            </div>
        </div>
    </section>

    <section aria-labelledby="titulo-indicadores" class="mb-12">
        <div class="mb-5 flex flex-wrap items-end justify-between gap-2">
            <h2 id="titulo-indicadores" class="text-xl font-extrabold text-[#1e3a5f] sm:text-2xl">Indicadores documentados</h2>
            <p class="text-sm text-slate-500">Classificação do inventário institucional</p>
        </div>
        <div class="grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-5">
            <div class="col-span-2 rounded-2xl border border-[#1e3a5f] bg-[#1e3a5f] p-5 text-white shadow-sm md:col-span-1">
                <span class="block text-3xl font-black">{{ count($projectos) }}</span>
                <span class="mt-2 block text-sm font-semibold text-blue-100">Total de projectos</span>
            </div>
            @foreach($estados as $chave => $estadoInfo)
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <span class="block text-3xl font-black text-[#1e3a5f]">{{ count($porEstado[$chave]) }}</span>
                    <span class="mt-2 block text-sm font-semibold text-slate-600">{{ $estadoInfo['rotulo'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section aria-labelledby="titulo-catalogo" id="catalogo-projectos">
        <div class="mb-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Inventário 2024–2025</p>
            <h2 id="titulo-catalogo" class="mt-2 text-2xl font-extrabold text-[#1e3a5f] sm:text-3xl">Explore os projectos</h2>
            <p class="mt-2 max-w-3xl text-sm leading-relaxed text-slate-600">Os projectos em destaque surgem uma única vez, na secção correspondente ao seu estado documental.</p>
        </div>

        <div class="mb-9 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6" x-cloak>
            <div class="flex gap-2 overflow-x-auto pb-2" role="group" aria-label="Filtrar por estado">
                <button type="button" @click="estado = 'todos'" :aria-pressed="estado === 'todos'"
                    :class="estado === 'todos' ? 'bg-[#1e3a5f] text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'"
                    class="shrink-0 rounded-full px-4 py-2.5 text-sm font-semibold transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]">Todos <span class="ml-1 opacity-75">{{ count($projectos) }}</span></button>
                @foreach($estados as $chave => $estadoInfo)
                    <button type="button" @click="estado = '{{ $chave }}'" :aria-pressed="estado === '{{ $chave }}'"
                        :class="estado === '{{ $chave }}' ? 'bg-[#1e3a5f] text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'"
                        class="shrink-0 rounded-full px-4 py-2.5 text-sm font-semibold transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]">
                        {{ $estadoInfo['rotulo'] }} <span class="ml-1 opacity-75">{{ count($porEstado[$chave]) }}</span>
                    </button>
                @endforeach
            </div>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="projectos-area" class="mb-1.5 block text-sm font-semibold text-slate-700">Área científica ou institucional</label>
                    <select id="projectos-area" x-model="area" class="w-full rounded-xl border-slate-300 text-sm text-slate-700 focus:border-[#1e3a5f] focus:ring-[#1e3a5f]">
                        <option value="todas">Todas as áreas</option>
                        @foreach($areas as $areaItem)
                            <option value="{{ $areaItem }}">{{ $areaItem }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="projectos-pesquisa" class="mb-1.5 block text-sm font-semibold text-slate-700">Pesquisar projectos</label>
                    <input id="projectos-pesquisa" type="search" x-model.debounce.150ms="pesquisa" placeholder="Título, tema ou curso"
                        class="w-full rounded-xl border-slate-300 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#1e3a5f] focus:ring-[#1e3a5f]">
                </div>
            </div>
            <p class="mt-4 text-sm text-slate-600" aria-live="polite"><strong x-text="contar()">{{ count($projectos) }}</strong> projectos encontrados</p>
        </div>

        <div x-show="contar() === 0" x-cloak role="status" class="mb-9 rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center">
            <p class="font-semibold text-[#1e3a5f]">Nenhum projecto corresponde aos filtros seleccionados.</p>
            <button type="button" @click="estado = 'todos'; area = 'todas'; pesquisa = ''" class="mt-3 text-sm font-bold text-[#c84a20] underline focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]">Limpar filtros</button>
        </div>

        @foreach($estados as $chave => $estadoInfo)
            <section id="projectos-{{ $chave }}" aria-labelledby="titulo-{{ $chave }}" class="mb-12" x-show="contar('{{ $chave }}') > 0">
                <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">{{ count($porEstado[$chave]) }} no inventário</p>
                        <h3 id="titulo-{{ $chave }}" class="mt-1 text-2xl font-extrabold text-[#1e3a5f]">{{ $estadoInfo['titulo'] }}</h3>
                        <p class="mt-1 text-sm text-slate-600">{{ $estadoInfo['resumo'] }}</p>
                    </div>
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-[#1e3a5f]" x-cloak><span x-text="contar('{{ $chave }}')">{{ count($porEstado[$chave]) }}</span> visíveis</span>
                </div>
                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach($porEstado[$chave] as $projecto)
                        <article id="projecto-{{ $projecto['linha'] }}" data-projecto data-estado="{{ $projecto['estado'] }}" data-area="{{ $projecto['area'] }}"
                            data-busca="{{ $projecto['titulo'] }} {{ $projecto['area'] }} {{ $projecto['curso'] ?? '' }}"
                            x-show="combina($el)"
                            class="flex h-full min-w-0 flex-col rounded-2xl border bg-white p-5 shadow-sm transition-shadow hover:shadow-lg sm:p-6 {{ !empty($projecto['destaque']) ? 'border-orange-200 ring-1 ring-orange-100' : 'border-slate-200' }}">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                @switch($chave)
                                    @case('elaboracao') <span class="rounded-full bg-orange-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-orange-800">Em elaboração</span> @break
                                    @case('curso') <span class="rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-blue-800">Em curso</span> @break
                                    @case('avaliacao') <span class="rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-violet-800">Em avaliação</span> @break
                                    @default <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-emerald-800">Executado</span>
                                @endswitch
                                @if(!empty($projecto['destaque']))
                                    <span class="text-xs font-bold text-[#c84a20]">Em destaque</span>
                                @endif
                            </div>
                            <h4 class="mt-5 break-words text-lg font-bold leading-snug text-[#1e3a5f]">{{ $projecto['titulo'] }}</h4>
                            <dl class="mt-auto space-y-2 border-t border-slate-100 pt-4 text-sm">
                                <div><dt class="inline font-semibold text-slate-500">Área: </dt><dd class="inline text-slate-700">{{ $projecto['area'] }}</dd></div>
                                @if(!empty($projecto['curso']))
                                    <div><dt class="inline font-semibold text-slate-500">Curso: </dt><dd class="inline text-slate-700">{{ $projecto['curso'] }}</dd></div>
                                @endif
                            </dl>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach
    </section>
</div>
@endsection
