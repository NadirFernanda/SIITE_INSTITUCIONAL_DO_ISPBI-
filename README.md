# INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ


![Laravel](https://img.shields.io/badge/Laravel-11.47.0-red?style=flat&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38bdf8?style=flat&logo=tailwindcss)
![Vite](https://img.shields.io/badge/Vite-4.5.14-646cff?style=flat&logo=vite)
![PHP](https://img.shields.io/badge/PHP-8.4.13-777bb4?style=flat&logo=php)

Website institucional oficial do INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ, desenvolvido com Laravel e Tailwind CSS, inspirado nas melhores práticas de design e arquitetura da informação de universidades de referência mundial.

## 🎯 Sobre o Projeto

Este projeto é o website oficial do INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ, criado para oferecer uma experiência moderna, acessível e informativa para estudantes, docentes, funcionários e público em geral. O site apresenta informações completas sobre a instituição, cursos, serviços e oportunidades.

**Instituição:** INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ  
**Criação:** Decreto Presidencial nº 285/20 de 29 de outubro de 2020  
**NIF:** 5000308765  
**Localização:** Rua Padre Fidalgo, entre Artur de Paiva e Francisco de Leite Cardoso S/N, Cuito/Bié - Angola

## 🎨 Inspirações de Design

O design do website foi desenvolvido com base nas melhores práticas de universidades de referência:

### Universidade de São Paulo (USP) - Brasil
- **Navbar de três níveis** com barra de serviços superior
- **Seção "Acesso Rápido"** com 16 ícones para acesso direto a serviços essenciais
- **Estrutura de navegação** clara e hierárquica
- **Sistema de cores institucionais** aplicado consistentemente
- **Footer informativo** com 6 colunas temáticas

### Outras Referências
- Organização de conteúdo institucional inspirada em universidades politécnicas europeias
- Arquitetura da informação baseada em padrões de usabilidade web moderna
- Design responsivo seguindo padrões mobile-first

## 🏗️ Arquitetura e Tecnologias

### Stack Principal
- **Backend:** Laravel 11.47.0
- **Frontend:** Blade Templates + Tailwind CSS
- **Build Tool:** Vite 4.5.14
- **PHP:** 8.4.13

### Estrutura do Projeto
```
├── app/
│   ├── Http/Controllers/     # Controladores (futura implementação)
│   └── Models/               # Modelos de dados
├── resources/
│   ├── views/
│   │   ├── layouts/          # Templates base
│   │   ├── partials/         # Componentes reutilizáveis
│   │   │   ├── navbar.blade.php      # Navbar de 3 níveis com dropdown
│   │   │   └── footer-content.blade.php  # Footer com 6 colunas
│   │   └── pages/            # Páginas do site
│   ├── css/                  # Estilos Tailwind
│   └── js/                   # JavaScript
├── routes/
│   └── web.php               # 26 rotas definidas
└── public/
    ├── images/               # Imagens e assets
    └── build/                # Assets compilados
```

## 🌈 Sistema de Cores

- **Laranja Principal:** `#F05A28` - Identidade institucional
- **Verde Água (Teal):** `#0E8F81` - Ações e links
- **Verde:** `#39C28A` - Hover states e destaques
- **Azul Escuro:** `#2C4A5E` - Textos e contraste
- **Dourado:** `#FFD700` - Destaques especiais
- **Preto Footer:** `#1a1a1a` - Rodapé

## 📄 Páginas Implementadas

### Páginas Institucionais (10)
1. **Homepage (/)** - Hero section, pilares institucionais, notícias, acesso rápido, estatísticas
2. **Missão (/missao)** - Declaração de missão oficial
3. **Visão (/visao)** - Visão estratégica da instituição
4. **Valores (/valores)** - 6 valores fundamentais da instituição
5. **Cursos de Graduação (/cursos)** - Apresentação dos 6 cursos
6. **Mestrado (/pos-graduacao)** - Programa de pós-graduação em Genecologia
7. **Pesquisa e Inovação (/investigacao)** - Áreas de pesquisa e infraestrutura
8. **Cultura e Extensão (/cultura)** - Projetos culturais e extensão comunitária
9. **Inclusão e Pertencimento (/inclusao)** - Programas de inclusão e acessibilidade
10. **Gestão e Governança (/gestao)** - Estrutura administrativa e órgãos de governo

### Páginas de Acesso Rápido (16)
11. **Portal institucional (/portal)** - Acesso centralizado aos sistemas institucionais
12. **Transparência (/transparencia)** - Gestão financeira, orçamentos e prestação de contas
13. **Ouvidoria (/ouvidoria)** - Canal de manifestações, reclamações e sugestões
14. **Webmail (https://isp-bie.ao/webmail)** - Acesso ao email institucional @ispbie.ao
15. **Alumni (/alumni)** - Rede de ex-alunos, networking e oportunidades
16. **Revista Científica (/revista)** - Publicações científicas da instituição
17. **Biblioteca Digital (/biblioteca)** - Acervo digital (2.500+ livros, 1.200+ artigos)
18. **Repositório Académico (/repositorio)** - Trabalhos de conclusão por curso
19. **Estatísticas (/estatisticas)** - Dados institucionais, matrículas, evolução
20. **Candidaturas (/candidaturas)** - Processo de ingresso e documentação
21. **Carta de Serviços (/servicos)** - Compromissos e prazos dos serviços
22. **App institucional (/app)** - Aplicativo móvel institucional
23. **Contactos (/contactos)** - Informações de contacto e formulário
24. **Concursos (/concursos)** - Processos seletivos para docentes e funcionários
25. **Busca de Pessoas (/pesquisa-pessoas)** - Diretório de docentes e funcionários
26. **Busca na Biblioteca (/busca-biblioteca)** - Catálogo da biblioteca

## 🎓 Cursos Oferecidos

1. **Contabilidade e Administração** - 4 anos, 40 vagas
2. **Engenharia Informática** - 5 anos, 40 vagas
3. **Engenharia em Recursos Hídricos** - 5 anos, 40 vagas
4. **Comunicação Social** - 4 anos, 40 vagas
5. **Psicologia Clínica** - 5 anos, 40 vagas
6. **Engenharia Civil** - 5 anos, 40 vagas

## 🚀 Funcionalidades Principais

### Navegação
- **Navbar de 3 níveis:** Barra de serviços, links institucionais e navegação principal
- **Menu dropdown:** ENSINO com submenu (Graduação, Pós-graduação, Cursos On-line)
- **Breadcrumbs:** Navegação contextual em todas as páginas
- **Footer de 6 colunas:** Educação, Pesquisa, Institucional, Parceiros, Contacto, Ensino Superior

### Seções da Homepage
- **Hero Section:** Imagem de destaque com chamada institucional
- **Banner Institucional:** Informação sobre o INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ
- **4 Pilares:** Ensino, Pesquisa, Cultura, Inclusão
- **Notícias:** Grade de 3 notícias em destaque
- **Acesso Rápido:** 16 ícones para serviços principais
- **Estatísticas:** Números institucionais em destaque

## ✨ Estratégia de Animações e UX

O website adota uma abordagem de animação pensada para um contexto institucional: presente o suficiente para transmitir modernidade, mas discreta para não competir com o conteúdo.

- **Animações de entrada pontuais:** apenas a _Hero Section_ e a secção de estatísticas **"ISP‑Bié em números"** utilizam animações de entrada ao rolar a página. São as áreas de maior destaque visual e estratégico, onde o movimento reforça a mensagem institucional e os indicadores-chave.
- **Demais secções estáveis:** blocos como **Missão, Visão, Valores**, **Pilares**, **Notícias**, **Acesso Rápido** e **Serviços ao Estudante** são apresentados de forma estática, garantindo leitura imediata, previsível e sem distrações.
- **Microinterações nos elementos-chave:** cards informativos, atalhos de acesso rápido, serviços ao estudante e ícones de redes sociais possuem efeitos de _hover_ e transições suaves, oferecendo feedback visual claro ao utilizador sem excesso de movimento.

### Justificativa da escolha

- **Priorizar a informação:** por ser um site institucional, a hierarquia de conteúdos (cursos, serviços, contactos, transparência) tem precedência sobre efeitos visuais. As animações são usadas como apoio à leitura, não como protagonista da interface.
- **Experiência confortável e profissional:** limitar o número de elementos animados reduz a sensação de “site em constante movimento”, o que é especialmente importante para públicos que acessam o portal com frequência ou por longos períodos.
- **Desempenho e acessibilidade:** menos elementos animados em simultâneo contribuem para tempos de carregamento mais estáveis, melhor desempenho em dispositivos modestos e maior conforto para utilizadores sensíveis a movimentos excessivos.
- **Consistência de marca:** a combinação de animações pontuais com microinterações sutis ajuda a comunicar uma imagem de instituição moderna, séria e confiável, em alinhamento com o posicionamento do INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ.

### Design Patterns
- **Cards informativos:** Design consistente em todas as páginas
- **Gradientes:** Banners com gradientes temáticos por seção
- **Hover effects:** Transições suaves em cards e links
- **Responsive design:** Mobile-first com breakpoints otimizados
- **Ícones SVG:** Sistema de ícones escalável

## 🛠️ Instalação e Configuração

### Requisitos
- PHP >= 8.4
- Composer
- Node.js >= 18.x
- NPM

### Passos de Instalação

1. **Clone o repositório**
```bash
git clone <repository-url>
cd VersaoDevNew
```

2. **Instale as dependências PHP**
```bash
composer install
```

3. **Instale as dependências Node**
```bash
npm install
```

4. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Compile os assets**
```bash
npm run build
```

6. **Inicie o servidor de desenvolvimento**
```bash
php artisan serve
```

O site estará disponível em `http://127.0.0.1:8000`

## 📦 Scripts Disponíveis

```bash
# Desenvolvimento com hot reload
npm run dev

# Build de produção
npm run build

# Limpar caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## 🔐 Acesso ao Servidor (Produção)

- Tipo: VPS Linux (produção)
- SSH (substituir `usuario` pelo utilizador autorizado, por exemplo `deploy`):

```bash
ssh usuario@isp-bie
```

- Diretório do projeto em produção: `/var/www/isp-bie.ao`

Caso ainda não tenhas acesso, pede à infraestrutura para adicionar a tua chave SSH ao servidor.

## 🚀 Deploy em Produção (VPS)

`git push` neste repositório:
 git add resources/views/pages/sistemas.blade.php
git commit -m "Melhorias drásticas na página de sistemas"
git push origin main
```bash

# 2. Entrar no diretório do projeto
```
cd /var/www/isp-bie.ao
git pull
npm run build
php artisan view:clear
php artisan cache:clear
php artisan config:clear

## 🎯 Roadmap Futuro

### Funcionalidades Pendentes
- [ ] Sistema de autenticação para estudantes e docentes
- [ ] Integração com sistema académico
- [ ] Sistema de gestão de conteúdo (CMS)
- [ ] Portal do estudante com consulta de notas
- [ ] Sistema de candidaturas online funcional
- [ ] Newsletter e notificações
- [ ] Galeria de imagens institucional
- [ ] Calendário académico interativo
- [ ] Menu mobile responsivo
- [ ] Multilinguismo (Português/Inglês)

### Melhorias de Conteúdo
- [ ] Substituir imagens placeholder por fotografias reais
- [ ] Implementar sistema de notícias dinâmico
- [ ] Adicionar perfis de docentes
- [ ] Criar área de downloads
- [ ] Implementar mapa interativo do campus

## 📊 Estatísticas do Projeto

- **Total de Rotas:** 26
- **Total de Views:** 27 (1 layout + 26 páginas)
- **Componentes Reutilizáveis:** 2 (navbar, footer)
- **Linhas de Código:** ~5.000+
- **Tempo de Desenvolvimento:** 1 dia

## 👥 Contribuição

Para contribuir com o projeto:

1. Faça um fork do repositório
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto é propriedade do INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ.

## 📞 Contacto

**INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ**  
📍 Rua Padre Fidalgo entre Artur de Paiva e Francisco de Leite Cardoso S/N, Cuito/Bié  
📧 geral@ispbie.ao  
📞 +244 000 000 000  
🌐 NIF: 5000308765

---

**Desenvolvido com ❤️ para o INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ** | Dezembro 2025

## 🚀 Tecnologias Utilizadas

O site institucional do INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ foi desenvolvido utilizando as seguintes tecnologias:

- **Laravel** (Backend, Framework PHP)
- **Blade** (Sistema de templates do Laravel)
- **Tailwind CSS** (Framework CSS utilitário para design responsivo e moderno)
- **Vite** (Ferramenta de build e hot reload para assets front-end)
- **PHP** (Linguagem principal do backend)
- **JavaScript** (Scripts customizados para interatividade)
- **HTML5** (Estrutura das páginas)
- **CSS3** (Estilização customizada)
- **postgres** (Banco de dados relacional, integração futura)
- **Autenticação Laravel** (Login, painel administrativo)
- **Favicon personalizado** (favicon.ico/png institucional)
- **Imagens institucionais** (logo, fotos, ícones)
- **Design responsivo** (Mobile-first, compatível com todos os dispositivos)
- **Integração com rotas web** (routes/web.php)
- **Estrutura modular de componentes** (partials, layouts, pages)

Essas tecnologias garantem performance, segurança, escalabilidade e uma experiência moderna para todos os usuários do site.
