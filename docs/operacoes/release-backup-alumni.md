# Operação futura: release, backup e documentos alumni

Este documento acompanha a branch `work/operational-safety-2026-10-13`. Os scripts
foram preparados e testados localmente com dados descartáveis. **Nenhuma etapa
de produção está autorizada por este documento.** O deploy antigo fica inerte
quando esta branch for publicada; o workflow manual continua como proposta em
`docs/proposals/workflow-publicacao-controlada.yml`.

## Pré-condições antes de activar o workflow manual

1. Confirmar no GitHub que `main` exige PR, revisão e CI; configurar revisores
   obrigatórios, impedir autoaprovação, restringir branches e guardar os
   segredos apenas no ambiente `production`. Fixar as actions por SHA revisto.
2. Confirmar no servidor todos os `server`, `root`, `alias`, proxies e caches;
   aplicar e testar a regra restrita de `docs/proposals/nginx-alumni.conf` em
   todos os pontos de entrada. Outros documentos em `/storage/` devem manter 200;
   alumni directo deve devolver 403/404.
3. Demonstrar backup PostgreSQL + storage real e restauro numa base isolada.
   Só depois iniciar retenção. O script actual **não apaga backups antigos**.
4. Preparar e testar separadamente o cutover da árvore antiga para
   `RELEASE_ROOT/releases/<sha>`, `SHARED_ROOT/.env`, `SHARED_ROOT/storage` e
   `CURRENT_LINK` como symlink. O publicador recusa substituir uma árvore real.
   A versão anterior tem de ser uma release compatível, com `RELEASE_SHA`.
5. Definir `HEALTH_URL` do servidor de origem, sem cache/CDN, e comprovar que
   `sudo nginx -t` e `sudo systemctl reload php8.4-fpm` podem ser executados
   com permissões restritas. Não há `artisan migrate` nos scripts de release.

## Backup agendado

`.github/workflows/backup.yml` exige um runner rotulado `production-backup` e
um ambiente GitHub `production-backup`. As variáveis `PRODUCTION_APP_DIR`,
`PRODUCTION_STORAGE_DIR` e `PRODUCTION_BACKUP_DIR` têm de apontar para caminhos
absolutos reais; `STORAGE_DIR` deve resolver exactamente para
`APP_DIR/storage/app`. A ligação PostgreSQL e o bucket S3 vêm dos segredos do
workflow. Se algum requisito faltar, o job falha sem marcar backup completo.

`scripts/backup.sh` cria um dump customizado, arquiva todo o `storage/app` real,
verifica ambos, calcula SHA-256, envia o conjunto para S3 com cifragem AES256,
descarrega-o e compara o hash. Só então promove a pasta local e cria `.complete`.
O ficheiro `.env` nunca entra no backup; a recuperação das credenciais precisa
de um procedimento de segredos separado. Os documentos e o manifesto local
devem ficar sob acesso restrito. Congele alterações a documentos ou use snapshot
coordenado para manter coerência entre a base e os ficheiros.

## Verificações de leitura a efectuar no servidor, após autorização de acesso

```sh
sudo nginx -t
sudo nginx -T
readlink -f /var/www/isp-bie.ao/public/storage
readlink -f /var/www/isp-bie.ao/storage/app
df -h /var/www /var/backups
df -i /var/www /var/backups
stat /var/www/isp-bie.ao /var/www/isp-bie.ao/storage/app
pg_restore --list /CAMINHO/DE/BACKUP/database.dump
```

Rever a saída de `nginx -T` antes de a partilhar: pode conter informação
sensível. Os caminhos exemplificativos devem ser substituídos pelos caminhos
confirmados no preflight. Verificar também a última execução do backup, hashes,
ACL, inodes, aliases, caches e o registo de um restauro isolado.

## Ensaios isolados

Em Linux com Nginx e curl, `bash tests/ops/nginx-alumni-smoke.sh` cria somente
ficheiros falsos em directório temporário, valida `nginx -t` e testa bloqueio do
caminho alumni e disponibilidade de outro documento público. Não prova a
configuração de produção.

Para verificar um backup num PostgreSQL de testes **previamente criado e vazio**,
usar `scripts/backup/verify-restore.sh BACKUP_SET_DIR`, com
`RESTORE_HOST=127.0.0.1`, `RESTORE_PORT=55432`,
`RESTORE_DB=isp_bie_restore_<identificador>` e `RESTORE_USER=isp_bie_test`.
O script recusa outros destinos, valida hashes, restaura a base e confere que
cada caminho em `alumni_documentos` existe no arquivo extraído. Não executar
contra a base utilizada pela aplicação nem contra produção.

## Sequência autorizável, ainda não executada

1. Aprovar em separado o backup, o bloqueio Nginx e o cutover para releases.
   Guardar a configuração anterior e registar a release anterior compatível.
2. Aplicar o bloqueio restrito; testar URLs directos, aliases, hosts e cache,
   bem como URLs públicos de controlo. Se qualquer caminho alumni responder com
   conteúdo, parar; não iniciar a cópia.
3. Com a release validada, usar o workflow manual **apenas após a sua activação
   aprovada**, ou invocar o publicador num operador autorizado com as mesmas
   variáveis de ambiente. O script verifica o artefacto, prepara a release e
   muda o symlink atomicamente. Uma falha de saúde volta à release anterior.
4. Validar portal autenticado, perfis recusados, documentos públicos de controlo
   e logs. Não executar migrações de base neste fluxo.
5. Para documentos antigos, executar primeiro
   `php artisan alumni:preparar-documentos-privados` sem opções: só inventaria.
   Após aprovação específica e congelamento/reconciliação dos documentos,
   executar `php artisan alumni:preparar-documentos-privados --copy
   --change-id=ID_APROVADO --confirm=COPIAR_DOCUMENTOS_ALUMNI`.
   Conferir contagens e SHA-256 com o inventário aprovado. Originais não são
   removidos pelo comando.

Critérios de paragem: backup incompleto ou sem restauro, alias público não
inspeccionado, espaço/permissões insuficientes, SHA divergente, ficheiro em
conflito, falha de saúde, `CURRENT_LINK` não preparado ou ausência de aprovação.
O rollback de código mantém sempre o bloqueio Nginx. O rollback não desfaz
alterações de esquema; por isso as migrações ficam fora do fluxo.
