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
14. **Webmail (http://www.isp-bie.ao/webmail)** - Acesso ao email institucional @ispbie.ao
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


## 🔒 Medidas de Segurança Aplicadas

O projeto segue as melhores práticas de segurança para aplicações Laravel e web modernas. As principais medidas implementadas são:

- **Autenticação obrigatória**: Todas as rotas administrativas estão protegidas pelo middleware `auth`, exigindo login para acesso.
- **Autorização por papel**: Apenas usuários com papel `admin` (campo `role` na tabela `users`) podem acessar a listagem de usuários e áreas sensíveis do painel.
- **Proteção contra enumeração de usuários**: Não há endpoints públicos que exponham dados de usuários administrativos.
- **Senhas protegidas**: O campo `password` é sempre oculto e armazenado de forma segura (hash).
- **Proteção CSRF**: Todos os formulários utilizam tokens CSRF, padrão do Laravel.
- **Proteção XSS**: Saída de dados nas views Blade utiliza `{{ }}` para evitar injeção de scripts.
- **Proteção SQL Injection**: Todas as queries utilizam Eloquent/Query Builder, nunca SQL manual.
- **Permissões de arquivos**: Recomenda-se permissões restritas em `storage` e `bootstrap/cache`.
- **Variáveis de ambiente seguras**: `.env` nunca é versionado e contém apenas dados sensíveis necessários.
- **Execução de migrations**: O banco de dados é atualizado apenas por migrations versionadas e seguras.
- **Dependências auditadas**: Recomenda-se rodar `composer audit` e `npm audit` regularmente.
- **HTTPS obrigatório**: O servidor deve ser configurado para aceitar apenas conexões seguras.
- **Headers de segurança**: Recomenda-se configurar headers como `X-Frame-Options`, `X-Content-Type-Options`, `Strict-Transport-Security` no servidor web.
- **Backups e monitoramento**: Recomenda-se backups regulares e monitoramento de acessos e logs.

Essas medidas reduzem drasticamente o risco de ataques comuns (XSS, CSRF, SQL Injection, enumeração de usuários, vazamento de dados sensíveis, etc). A segurança é tratada como prioridade contínua no ciclo de vida do projeto.

---

`git push` neste repositório:
 git add resources/views/pages/sistemas.blade.php
git commit -m "Melhorias drásticas na página de sistemas"
git push origin main
```bash

# 2. Entrar no diretório do projeto
```
git pull
npm run build
php artisan view:clear
php artisan cache:clear
php artisan config:clear
cd /var/www/isp-bie.ao
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
npm run build
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```
<userPrompt>
Provide the fully rewritten file, incorporating the suggested code change. You must produce the complete file.
</userPrompt>
