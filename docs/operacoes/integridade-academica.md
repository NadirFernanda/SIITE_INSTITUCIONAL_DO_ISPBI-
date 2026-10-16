# Integridade académica

## Notas e disciplinas

Os pesos configurados numa sala têm de somar 100%. Cada nota disciplinar é
limitada pelo máximo proporcional ao peso; só disciplinas configuradas podem
receber notas. A nota final é a soma das notas disciplinares e fica pendente
enquanto a pauta estiver incompleta. Alterações às disciplinas recalculam notas
finais que eram derivadas da pauta; notas de disciplinas removidas permanecem
guardadas como histórico.

## Admissões

As notas, o pagamento, o curso, o período, a categoria especial, o estado de
rejeição e as vagas invalidam resultados de admissão existentes para o grupo
afectado. O cálculo preserva a regra actualmente implementada para as quotas:
3% por categoria especial, arredondamento `round()` e lugares de quotas não
preenchidas devolvidos à lista geral. As quotas são reservadas dentro da
capacidade total. Todos os candidatos empatados na nota de corte são admitidos,
mesmo quando isso excede a capacidade.

## Salas

A distribuição automática apenas acrescenta candidatos com pagamento confirmado
e sem sala atribuída; não apaga salas existentes nem substitui atribuições
manuais. O índice único por sala/lugar e os bloqueios transaccionais impedem
duplicados concorrentes. Alterações de atribuição são registadas em
`sala_atribuicoes_historico`, sem chaves estrangeiras que removam o registo
histórico quando uma candidatura ou sala deixa de existir.

## Migração e testes

`2026_10_13_000001_add_academic_integrity_indexes` é aditiva, mas interrompe a
migração se encontrar notas duplicadas por candidatura/disciplina, disciplinas
duplicadas por sala ou lugares duplicados por sala. Não elimina nem consolida
registos automaticamente. Investigue e autorize separadamente qualquer
correcção de dados antes de tentar novamente a publicação.

Os testes de regressão usam exclusivamente a base PostgreSQL local isolada
`isp_bie_test` (loopback, porta `55432`, utilizador sem privilégios elevados):

```powershell
php .test-runtime\vendor\bin\pest --configuration=phpunit.xml --test-directory=..\tests
```

Não execute migrações de teste com configuração de produção nem use os dados
reais para validar estas alterações.
