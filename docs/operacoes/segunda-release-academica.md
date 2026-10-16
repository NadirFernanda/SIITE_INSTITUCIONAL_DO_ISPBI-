# Segunda release académica — plano de execução, não autorização

Esta release parte de `b8ef3ee` e contém as correcções de notas, admissões e
salas, os testes e a migração `2026_10_13_000001_add_academic_integrity_indexes`.
Nenhum comando deste plano foi executado em produção. Substituir os caminhos e
identificadores de exemplo só depois de os confirmar no servidor Ubuntu.

## Regras preservadas

- Quota especial de 3% por categoria, calculada com `round()`; vagas reservadas
  não preenchidas regressam ao concurso geral. A reserva cabe no total de vagas.
- Todos os candidatos empatados na nota de corte são admitidos, inclusive se o
  total final ultrapassar as vagas. Candidatos sem nota positiva não concorrem.
- A atribuição **manual excepcional** permite uma sala cheia ou com outro curso;
  escolhe um lugar livre, inclusive acima da capacidade. A distribuição
  automática respeita a capacidade e preserva atribuições já existentes.

Estas regras têm cobertura em `tests/Feature/AcademicIntegrityTest.php`.

## Antes da janela aprovada

1. Confirmar o SHA integral da release, CI verde, artefacto e SHA-256. O workflow
   manual continua apenas em `docs/proposals/`; só pode ser activado depois de
   uma aprovação operacional separada. `main` não é destino desta preparação.
2. Confirmar no servidor a topologia de releases e `CURRENT_LINK`, o espaço
   livre, as permissões e uma janela em que **todas as escritas académicas**
   possam ser suspensas sem bloquear o `HEALTH_URL` usado pelo publicador.
   Testar esse controlo num ambiente isolado. Sem este controlo, parar: o
   publicador actual activa o código antes de ser possível executar a migração.
3. Confirmar que a release anterior funciona com os novos índices, ou preparar
   uma release de recuperação compatível. Não presumir que `migrate:rollback`
   recupera os dados: a reversão automática desta migração é recusada para
   proteger o histórico.
4. Produzir backup consistente da base PostgreSQL e do `storage/app` **real**.
   Verificar o conjunto, SHA-256, cópia externa e restauro isolado, conforme
   `docs/operacoes/release-backup-alumni.md`. Registar IDs e hora do backup.
5. Executar o diagnóstico com um papel PostgreSQL apenas de leitura, por uma
   ligação e base confirmadas no preflight. O SQL está em
   `scripts/diagnostico-integridade-academica.sql` e não entra no artefacto da
   aplicação. Disponibilizá-lo ao operador por um canal controlado, conferir o
   hash e restringir a saída, que contém identificadores internos:

   ```sh
   PGSERVICE=isp_bie_readonly psql -X -v ON_ERROR_STOP=1 \
     -f scripts/diagnostico-integridade-academica.sql
   ```

   As três listagens de conflitos devem estar vazias. O SQL abre uma transacção
   `READ ONLY` e termina com `ROLLBACK`; não altera registos. Duplicados exigem
   análise e decisão humana específica, preservando o histórico; não iniciar a
   migração nem eliminar/consolidar automaticamente.

## Janela de execução autorizável no Ubuntu

1. Abrir registo de mudança, confirmar operadores, versão anterior, backup e
   capacidade de rollback. Suspender as escritas académicas em todos os pontos
   de entrada, incluindo jobs e importadores; preservar o `HEALTH_URL` de leitura.
   Confirmar o bloqueio com uma tentativa controlada e verificar que não há
   operações em curso. Não usar `php artisan down` se isso fizer falhar o
   health check da activação.
2. Repetir o diagnóstico na mesma base e verificar zero conflitos. Conferir
   `current_database()`, servidor, porta e utilizador apresentados pelo SQL.
3. Publicar o artefacto aprovado pelo mecanismo de release manual, sem
   migrações automáticas. O publicador verifica SHA-256, prepara a release,
   troca `CURRENT_LINK` e executa health check; se falhar, repõe o link anterior.
   Antes de o executar em produção, validar as variáveis `RELEASE_ROOT`,
   `SHARED_ROOT`, `CURRENT_LINK` e `HEALTH_URL` no ensaio de cutover.
4. Com escritas ainda suspensas, entrar na **release activa confirmada** e
   verificar `php artisan migrate:status`. Aplicar apenas a migração académica:

   ```sh
   cd /CAMINHO/CONFIRMADO/CURRENT_LINK
   php artisan migrate --force \
     --path=database/migrations/2026_10_13_000001_add_academic_integrity_indexes.php
   php artisan migrate:status
   ```

   A migração verifica as três classes de duplicados novamente antes de criar
   índices e histórico. É aditiva; não elimina ou consolida linhas. Confirmar em
   ensaio isolado que o PostgreSQL/Laravel executa esta migração numa transacção.
5. Repetir o diagnóstico de leitura; conferir que os três índices únicos e a
   tabela de histórico existem, e validar registo de nota, recálculo de
   admissão, consulta de pauta, distribuição sem sobrescrita e atribuição manual
   excepcional com contas de teste autorizadas. Confirmar que os documentos
   públicos e privados continuam com as permissões previstas.
6. Só levantar o bloqueio de escritas após os pontos anteriores estarem
   documentados e aprovados pelo responsável da mudança. Monitorizar erros da
   aplicação, PostgreSQL, filas e health check durante a janela acordada.

## Interrupção e recuperação

Parar imediatamente se: backup/restauro não comprovado, destino DB divergente,
qualquer duplicado, escrita não suspensa, SHA divergente, falha de migração,
health check falhado, conflito de índice ou alteração inesperada das regras.
Manter escritas suspensas; recolher logs e estado dos índices sem expor dados
pessoais. Se a activação falhou, o publicador tenta recuperar automaticamente o
link anterior; confirmar o destino com `readlink -f` e testar o serviço.

Se a migração falhar, **não** executar `migrate:rollback` nem corrigir dados na
janela sem aprovação. Repor a release de código compatível com o esquema
efectivamente presente e validar. Se a migração tiver concluído mas a aplicação
falhar, voltar para a release anterior **apenas** após a verificação de
compatibilidade prevista no preflight; os índices e o histórico permanecem.
Restauro da base e documentos a partir do backup é uma intervenção distinta,
com autorização, janela e verificação de integridade próprias; nunca é
automático. Preservar o backup original e o registo da falha.

Este plano não autoriza deploy, migração, alteração de dados ou publicação no
GitHub. Os comandos de produção são para uma execução posterior aprovada.
