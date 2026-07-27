# Sistema de Lançamento de Notas — Por Sala
## Subcomissão de Correção

### 📋 Visão Geral

Este novo módulo permite que a **Subcomissão de Correção** lance notas de forma organizada **por sala**, garantindo total anonimato dos candidatos (apenas código de exame é exibido).

### ✨ Características Principais

#### 1. **Organização por Sala**
- Visualize todas as salas com candidatos
- Veja o progresso (percentual de notas lançadas) para cada sala
- Estatísticas em tempo real: total, com nota, sem nota

#### 2. **Anonimato Garantido**
- ✅ Apenas o **código de exame** é exibido
- ✅ Nenhum dado pessoal (nome, BI, etc.) aparece na interface
- ✅ Validação obrigatória contra documentação física da DAAC

#### 3. **Interface Otimizada para Lançamento Rápido**
- Tabela clara com código de exame, nota e status
- Modal interativo para lançamento de notas
- Feedback visual: aprovado/reprovado (≥10 passa)
- Suporte a notas decimais (ex: 15.5)

#### 4. **Rastreabilidade Completa**
- Cada nota registra quem lançou e quando
- Histórico mantido no banco de dados (auditoria)

---

### 🚀 Como Usar

#### Passo 1: Acessar o Painel Professor
1. Faça login como **Subcomissão de Correção** em: `https://isp-bie.ao/professor/`
2. No menu lateral, clique em **"Por Sala"**

#### Passo 2: Selecionar uma Sala
A página inicial mostra um **grid com todas as salas**:
- Nome da sala
- Data e horário do exame
- Estatísticas: total de candidatos, com nota, sem nota
- Percentual de progresso (barra visual)

Clique em **"Abrir Pauta"** para entrar na pauta da sala.

#### Passo 3: Lançar Notas
Na pauta da sala:
1. Visualize a lista de candidatos (identificados apenas pelo código de exame)
2. Para cada candidato, clique em **"➕ Lançar"** ou **"✏️ Editar"** (se já tem nota)
3. Confirme o código de exame contra a prova física
4. Digite a nota (0 a 20, com casas decimais se necessário)
5. Veja o feedback visual: APROVADO (≥10) ou REPROVADO (<10)
6. Clique em **"Guardar Nota"**

#### Exemplo de Workflow
```
Sala: Informática — 27/07/2026 — 08:00-10:00
├─ E0234 | Sem nota | ➕ Lançar → Modal → 14.5 → APROVADO → ✓ Salvo
├─ E0235 | 12.0    | ✏️ Editar → Modal → 13.0 → APROVADO → ✓ Atualizado
└─ E0236 | Sem nota | ➕ Lançar → Modal → 8.5  → REPROVADO → ✓ Salvo
```

---

### 🔒 Garantias de Segurança

**Anonimato Total:**
- A interface **oculta completamente** nomes, BI, endereço, etc.
- Apenas o código de exame (Ex: E0234) é exibido
- Validação **obrigatória** com documentação física antes de lançar

**Auditoria:**
- Todas as notas têm rastreamento: quem lançou, data, hora
- Modificações futuras são registradas no histórico

**Controle de Acesso:**
- Apenas utilizadores com permissão `subcomissao_correcao` podem acessar
- Rate limiting: máx. 30 requisições/minuto por utilizador

---

### 📊 Estrutura Técnica

#### Rotas Novas Adicionadas
```php
Route::prefix('professor')->name('professor.')->group(function () {
    // Listar salas
    Route::get('salas', [App\Http\Controllers\Professor\SalaController::class, 'index'])
        ->name('salas.index');
    
    // Pauta de uma sala (candidatos + lançamento de notas)
    Route::get('salas/{sala}', [App\Http\Controllers\Professor\SalaController::class, 'show'])
        ->name('salas.show');
    
    // Lançar/atualizar nota
    Route::patch('candidaturas/{candidatura}/nota', [App\Http\Controllers\Professor\CandidaturaController::class, 'updateNota'])
        ->name('candidaturas.nota');
});
```

#### Arquivos Criados/Modificados

**Novos Controllers:**
- `app/Http/Controllers/Professor/SalaController.php` — Lógica de salas

**Novas Views:**
- `resources/views/professor/salas/index.blade.php` — Grid de salas
- `resources/views/professor/salas/show.blade.php` — Pauta com lançamento

**Modificações:**
- `routes/web.php` — Adicionadas rotas de salas
- `resources/views/layouts/professor.blade.php` — Menu atualizado

---

### 💡 Dicas de Uso

1. **Organização Eficiente:**
   - Comece pelas salas com menor progresso
   - Use o filtro de status para focar em candidatos sem nota

2. **Entrada de Notas:**
   - Pressione **TAB** para validação em tempo real
   - Pressione **ESC** para cancelar o modal
   - Suporte a casas decimais: `15.5`, `9.8`, etc.

3. **Validação:**
   - Sempre confirme o código de exame com a prova física
   - A DAAC/Secretaria fornece a correspondência oficial sala-candidato

4. **Recuperação de Erros:**
   - Se lançou nota errada, clique em **"✏️ Editar"** para corrigir
   - Todas as alterações ficam registradas no histórico

---

### ⚙️ Configuração do Sistema

**Permissões Necessárias:**
- Utilizador deve ter role: `subcomissao_correcao`
- Acesso via middleware: `['auth', 'subcomissao_correcao', 'throttle:30,1']`

**Campos de Nota:**
- Min: 0 | Max: 20 | Step: 0.1
- Limite de aprovação: ≥ 10 (global na instituição)

**Salas Exibidas:**
- Apenas salas com candidatos atribuídos
- Ordenadas por data de exame (ascendente)

---

### 📞 Suporte

Para questões técnicas ou sugestões de melhoria:
1. Consulte a DAAC/Secretaria sobre a correspondência oficial
2. Reporte bugs ao administrador do sistema
3. Solicite acesso adicional ao painel de administração se necessário

---

**Versão:** 1.0  
**Data de Criação:** 27/07/2026  
**Última Atualização:** 27/07/2026  
**Mantido por:** ISP-Bié — Departamento de TI
