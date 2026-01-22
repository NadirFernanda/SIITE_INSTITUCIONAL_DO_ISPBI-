# Documentação - Design Inspirado na USP

## Visão Geral
Este documento descreve as alterações implementadas no site do Instituto Superior Politécnico do Bié (ISP-Bié) com base no design da Universidade de São Paulo (USP).

## Data de Implementação
12 de Dezembro de 2025

---

## Alterações Implementadas

### 1. Sistema de Navegação (navbar.blade.php)

#### 1.1 Barra Laranja Superior
- **Implementação**: Barra fina de 1px na cor laranja (#F05A28)
- **Objetivo**: Elemento visual distintivo que segue o padrão da USP
- **Código**: `<div class="bg-[#F05A28] h-1 w-full"></div>`

#### 1.2 Barra de Serviços Superior
- **Cor de fundo**: Teal (#0E8F81)
- **Conteúdo**: Links para serviços institucionais
- **Links incluídos**:
  - Contacto (📧)
  - Webmail (✉️)
  - Serviços (📋)
  - Transparência (👁️)
  - Reitoria (🏛️)
  - Institucional (🏢)
  - Faculdades (🎓)
  - Sistemas (⚙️)
- **Comportamento**: Links secundários ocultos em mobile (md:flex)

#### 1.3 Header Principal
- **Cor de fundo**: Azul escuro (#2C4A5E)
- **Logo**: Aumentado para 16x16 (w-16 h-16)
- **Estrutura**:
  - Nome da instituição em destaque
  - Subtítulo "Angola"
  - Menu principal horizontal

#### 1.4 Menu Principal
- **Itens**:
  - 📚 ENSINO → /cursos
  - 🔬 PESQUISA E INOVAÇÃO → /investigacao
  - ⭐ CULTURA E EXTENSÃO → /vida
  - 📰 COMUNICAÇÃO → /noticias
- **Efeitos hover**: Transição de cor para laranja (#F05A28)
- **Responsividade**: Oculto em telas pequenas (lg:flex)

---

### 2. Hero Section (welcome.blade.php)

#### 2.1 Estrutura
- **Container**: Posição relativa com altura mínima de 500px
- **Cor base**: Azul escuro (#2C4A5E)
- **Camadas**:
  1. Imagem de fundo (`/images/campus-hero.jpg`)
  2. Overlay gradiente
  3. Conteúdo textual
  4. Elemento decorativo

#### 2.2 Imagem de Fundo
- **Path**: `/images/campus-hero.jpg`
- **Estilo**: Cover, centralizada
- **Opacidade**: 50% para não sobrepor o texto
- **Nota**: Imagem necessita ser adicionada ao diretório public/images

#### 2.3 Overlay
- **Tipo**: Gradiente vertical
- **Cores**: De #2C4A5E com 80% de opacidade para 60%
- **Objetivo**: Garantir legibilidade do texto

#### 2.4 Conteúdo
- **Título**: 
  - Tamanho: text-5xl (mobile) → text-6xl (desktop)
  - Peso: Extrabold
  - Texto: "Instituto Superior Politécnico do Bié"
- **Subtítulo**:
  - Tamanho: text-xl
  - Cor: Cinza claro (text-gray-200)
  - Texto descritivo da missão institucional

#### 2.5 Botões de Ação
- **Botão Primário**:
  - Cor: Laranja (#F05A28)
  - Hover: Laranja escuro (#d94d1f)
  - Texto: "Conheça os cursos"
  - Link: /cursos
- **Botão Secundário**:
  - Cor: Branco semi-transparente (20%)
  - Efeito: Backdrop blur
  - Texto: "Últimas notícias"
  - Link: /noticias

#### 2.6 Elemento Decorativo
- **Posicionamento**: Canto inferior direito
- **Visibilidade**: Apenas em telas extra-grandes (xl:block)
- **Estilo**: Barra vertical com gradiente (simula obelisco/monumento)
- **Dimensões**: 24px largura × 384px altura

---

### 3. Sistema de Cores (app.css)

#### 3.1 Paleta de Cores
```css
--brand-primary: #F05A28;  /* Laranja - Ações primárias */
--brand-teal: #0E8F81;     /* Teal - Barra de serviços */
--brand-accent: #39C28A;   /* Verde - Acentos */
--brand-dark: #2C4A5E;     /* Azul escuro - Headers */
--brand-text: #0b5a52;     /* Tom escuro - Texto */
```

#### 3.2 Uso das Cores
- **#F05A28 (Laranja)**: 
  - Barra superior fina
  - Botões de ação
  - Hover states nos menus
- **#0E8F81 (Teal)**: 
  - Barra de serviços
- **#2C4A5E (Azul escuro)**: 
  - Header principal
  - Fundo do hero
- **#39C28A (Verde)**: 
  - Acentos (disponível para uso futuro)

---

## Semelhanças com o Design da USP

### Elementos Correspondentes

| Elemento USP | Implementação ISP-Bié |
|--------------|----------------------|
| Barra laranja superior | Barra laranja de 1px |
| Barra azul de serviços | Barra teal com links institucionais |
| Header com logo grande | Logo 16×16 com nome completo |
| Menu principal (Ensino, Pesquisa, etc.) | Menu com mesmas categorias adaptadas |
| Hero com imagem de campus | Hero com overlay e imagem de fundo |
| Obelisco/monumento | Elemento decorativo vertical |

### Adaptações Realizadas

1. **Cores**: Adaptadas para manter identidade do ISP-Bié mantendo harmonia visual
2. **Links**: Contextualizados para Angola e estrutura do ISP
3. **Conteúdo**: Texto institucional próprio do ISP-Bié
4. **Emojis**: Adicionados para melhor UX em telas modernas

---

## Arquivos Modificados

### 1. resources/views/partials/navbar.blade.php
- **Linhas alteradas**: Todas (substituição completa)
- **Mudanças principais**:
  - Adição de barra laranja
  - Adição de barra de serviços
  - Reestruturação do header
  - Novo menu principal

### 2. resources/views/welcome.blade.php
- **Linhas alteradas**: 1-16
- **Mudanças principais**:
  - Hero section completamente redesenhado
  - Adição de camadas de fundo
  - Novos botões de ação
  - Elemento decorativo

### 3. resources/css/app.css
- **Linhas alteradas**: 1-18
- **Mudanças principais**:
  - Documentação do sistema de cores
  - Atualização das variáveis CSS
  - Comentários explicativos

---

## Próximos Passos

### Tarefas Pendentes

1. **Imagens**:
   - [ ] Adicionar imagem do campus em `/public/images/campus-hero.jpg`
   - [ ] Otimizar logo institucional em `/public/images/logo.svg`

2. **Páginas**:
   - [ ] Criar/atualizar página `/servicos`
   - [ ] Criar/atualizar página `/transparencia`
   - [ ] Criar/atualizar página `/reitoria`
   - [ ] Criar/atualizar página `/institucional`
   - [ ] Criar/atualizar página `/faculdades`
   - [ ] Criar/atualizar página `/sistemas`
   - [ ] Criar/atualizar página `/webmail`

3. **Responsividade**:
   - [ ] Implementar menu mobile funcional
   - [ ] Testar em diferentes dispositivos
   - [ ] Ajustar breakpoints se necessário

4. **Acessibilidade**:
   - [ ] Adicionar aria-labels adequados
   - [ ] Verificar contraste de cores (WCAG AA)
   - [ ] Testar navegação por teclado

5. **Performance**:
   - [ ] Otimizar imagem hero (WebP, lazy loading)
   - [ ] Minificar CSS em produção
   - [ ] Implementar cache de assets

---

## Observações Técnicas

### Tailwind CSS
- Utilizamos classes utilitárias do Tailwind para estilização
- Cores customizadas usando notação `bg-[#hex]`
- Sistema de breakpoints padrão (sm, md, lg, xl)

### Responsividade
- **Mobile first**: Layout base para mobile
- **Breakpoints**:
  - `md`: 768px - Mostra links secundários
  - `lg`: 1024px - Mostra menu principal completo
  - `xl`: 1280px - Mostra elemento decorativo

### Compatibilidade
- **Browsers modernos**: Chrome, Firefox, Safari, Edge (últimas 2 versões)
- **Fallbacks**: Imagens com `onerror` handler

---

## Referências

- Design inspirado em: [Universidade de São Paulo (USP)](https://www5.usp.br/)
- Framework CSS: [Tailwind CSS](https://tailwindcss.com/)
- Framework Backend: Laravel 11.x

---

## Manutenção

Para manter a consistência do design:

1. **Sempre use as variáveis CSS** definidas em `app.css`
2. **Mantenha a estrutura de três camadas** no header (barra laranja, serviços, menu)
3. **Siga a paleta de cores** estabelecida
4. **Teste em múltiplos dispositivos** antes de deploy

---

## Suporte

Para dúvidas ou sugestões sobre o design:
- Consulte este documento
- Verifique os comentários no código
- Compare com o site da USP para referência visual

---

**Documento criado por**: GitHub Copilot  
**Última atualização**: 12/12/2025
