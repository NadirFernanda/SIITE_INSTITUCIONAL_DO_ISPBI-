# 📋 Guia Rápido — Lançamento de Notas por Sala

## Menu de Acesso

```
┌─────────────────────────────────────────────┐
│  ISP-Bié | Painel Professor                 │
├─────────────────────────────────────────────┤
│  📍 Por Sala ← CLIQUE AQUI PARA COMEÇAR    │
│  📋 Pesquisa Rápida (busca individual)     │
│  🚪 Sair                                    │
└─────────────────────────────────────────────┘
```

---

## Tela 1: Seleção de Sala

```
┌──────────────────────────────────────────────────────────────────┐
│  Lançamento de Notas por Sala                                    │
│  Selecione uma sala para visualizar os candidatos...             │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│  ┌────────────────────┐  ┌────────────────────┐                │
│  │ Informática        │  │ Enfermagem         │                │
│  │ 📅 27/07/2026 •    │  │ 📅 28/07/2026 •    │                │
│  │ ⏰ 08:00-10:00     │  │ ⏰ 10:30-12:30     │                │
│  │                    │  │                    │                │
│  │ Total: 25          │  │ Total: 18          │                │
│  │ ✓ Com nota: 18     │  │ ✓ Com nota: 12     │                │
│  │ ✗ Sem nota: 7      │  │ ✗ Sem nota: 6      │                │
│  │ [████████░░░░░░░]  │  │ [██████████░░░░░░]  │                │
│  │ 72% concluído      │  │ 67% concluído      │                │
│  │                    │  │                    │                │
│  │ [Abrir Pauta →]    │  │ [Abrir Pauta →]    │                │
│  └────────────────────┘  └────────────────────┘                │
│                                                                  │
└──────────────────────────────────────────────────────────────────┘
```

---

## Tela 2: Pauta da Sala (Lançamento de Notas)

```
┌──────────────────────────────────────────────────────────────────┐
│  ← Voltar às salas                                               │
│                                                                  │
│  Informática                                                    │
│  📅 27/07/2026 • ⏰ 08:00-10:00 • 25 candidatos                │
│                                                                  │
│  Total: 25 | ✓ Com nota: 18 | ✗ Sem nota: 7 | Progresso: 72% │
│                                                                  │
│  🔒 Garantia de Anonimato: Apenas o código de exame é exibido  │
│                                                                  │
├──────────────────────────────────────────────────────────────────┤
│ Lugar │ Código Exame │ Nota      │ Status            │ Acção   │
├──────────────────────────────────────────────────────────────────┤
│   1   │ E0234        │ ✓ 14.5/20 │ Lançada por João  │ ✏️ Edit │
│   2   │ E0235        │ —         │ Pendente          │ ➕ Lançar
│   3   │ E0236        │ ✗ 8.5/20  │ Lançada por Maria │ ✏️ Edit │
│   4   │ E0237        │ ✓ 15.0/20 │ Lançada por João  │ ✏️ Edit │
│  ...  │ ...          │ ...       │ ...               │ ...     │
└──────────────────────────────────────────────────────────────────┘
```

---

## Tela 3: Modal de Lançamento de Nota

```
┌────────────────────────────────────────────┐
│  Lançar Nota                               │
│  Código de Exame: E0235                    │
├────────────────────────────────────────────┤
│                                            │
│  Nota (0 – 20)                             │
│  ┌──────────────────────────────────────┐ │
│  │ 15.5                                   │ │  ← Digite a nota
│  └──────────────────────────────────────┘ │
│                                            │
│  ✓ APROVADO (15.5/20) ← Feedback visual   │
│                                            │
├────────────────────────────────────────────┤
│  [✓ Guardar Nota]  [Cancelar]             │
└────────────────────────────────────────────┘
```

**Feedback Visual:**
- 🟢 Nota ≥ 10: **APROVADO** (fundo verde)
- 🔴 Nota < 10: **REPROVADO** (fundo vermelho)

---

## Workflow Completo

### 1️⃣ Corrigir prova e obter nota
```
Prova física em mãos com código E0235
↓
Corrige e obtém nota: 14.5
```

### 2️⃣ Abrir pauta da sala
```
Painel Professor → Por Sala
→ Seleciona "Informática"
→ Vê pauta com todos os 25 candidatos
```

### 3️⃣ Localizar candidato pelo código
```
Procura na tabela: E0235
Status: Sem nota
Clica em "➕ Lançar"
```

### 4️⃣ Validar e lançar
```
Modal abre
Confirma código: E0235 ✓ (confere com prova física)
Digite nota: 14.5
Vê feedback: ✓ APROVADO
Clica "Guardar Nota"
```

### 5️⃣ Confirmação
```
Nota guardada com sucesso ✓
Tabela atualiza automaticamente:
  E0235 | ✓ 14.5/20 | Lançada por [Seu nome]
```

---

## Atalhos de Teclado

| Ação | Tecla |
|------|-------|
| Cancelar modal | ESC |
| Focar no campo de nota | TAB |
| Submeter nota | ENTER |

---

## Cenários Comuns

### Cenário 1: Lançar primeira nota
```
1. Pauta da sala
2. Procura por E0234
3. Status: "Sem nota"
4. Clica "➕ Lançar"
5. Digite 16.0
6. Vê "✓ APROVADO"
7. Clica "Guardar Nota"
✅ Concluído
```

### Cenário 2: Corrigir nota errada
```
1. Pauta da sala
2. E0235 tem nota 8.0 (reprovado)
3. Clica "✏️ Editar"
4. Modal abre com 8.0
5. Muda para 12.0
6. Vê "✓ APROVADO"
7. Clica "Guardar Nota"
✅ Atualizado (auditoria registra mudança)
```

### Cenário 3: Acompanhar progresso
```
Sala tem 25 candidatos
15 têm nota (60%)
Barra mostra: [████████░░░░░░░░░] 60%
Foco nos 10 sem nota (vermelho)
```

---

## Checklist de Segurança ✅

Antes de lançar cada nota, confirme:

- [ ] Código de exame na pauta (E####) confere com prova física
- [ ] Candidato presente no local físico do exame
- [ ] Nota está entre 0-20
- [ ] Você é responsável pelo lançamento (auditoria registra nome)
- [ ] Feedback visual corresponde ao resultado (aprovado/reprovado)

---

## Suporte Rápido

**Dúvida: Como acho um candidato específico?**
- Na pauta de uma sala, use Ctrl+F (busca do navegador) para procurar código de exame

**Dúvida: Posso lançar nota sem validar a prova?**
- ❌ Não! Sempre valide contra documentação física. A segurança depende disso.

**Dúvida: Errei na nota. Como corrijo?**
- Clique em "✏️ Editar" no candidato e mude a nota. Fica registrado no histórico.

**Dúvida: Esqueci de qual sala estava?**
- Volte ao menu "Por Sala" — o progresso está sempre visível.

---

**Lembrete:** Você está tratando dados sensíveis de exames. O anonimato é garantido apenas pelo código de exame. Mantenha a confidencialidade! 🔒
