# Preparação local para publicação controlada e documentos alumni

Estado: proposta técnica, sem activação. Destinatários: responsáveis pela aplicação, operações e aprovação de produção. A execução continua **NÃO APTA** até à verificação dos pontos abaixo no servidor e à autorização expressa. Este documento não aprova deploy, migrações de base de dados ou transferência de documentos.

## Evidência e riscos dos mecanismos actuais

| Área | Evidência no projecto | Risco e decisão futura |
| --- | --- | --- |
| CI | `.github/workflows/ci.yml` executa testes PostgreSQL isolados, build Node 22 e um job Lighthouse separado. | O deploy não depende do resultado da CI: ambos arrancam em eventos `push` para `main`. Tornar a CI uma verificação obrigatória da branch e repetir a validação do SHA exacto antes da aprovação. |
| CI | O job Lighthouse usa Node 18, instala a ferramenta mesmo sem `SITE_URL`, suprime falhas com `|| true` e tenta publicar um relatório que pode não existir. | Acessibilidade não funciona como gate. Executar apenas quando há URL, não ocultar erros e escolher uma versão de Node suportada pela ferramenta. A decisão de tornar esta verificação obrigatória fica explícita. |
| CI e deploy | Os workflows não fixam `permissions` mínimos para `GITHUB_TOKEN`; algumas acções são referidas por tags. | Definir permissões mínimas e, depois de rever a origem, fixar acções por SHA completo. Confirmar as regras efectivas do repositório. |
| Deploy | `.github/workflows/deploy.yml` aceita `push` e `workflow_dispatch`; usa `environment: production`, cuja regra de revisores não é conhecida. | `environment` sozinho não demonstra aprovação manual. Substituir o gatilho automático por `workflow_dispatch` e configurar revisores obrigatórios, impedimento de autoaprovação e restrição de branches no GitHub. |
| Deploy | O servidor faz `git reset --hard origin/main`, instala dependências e constrói assets na árvore em serviço. | Destrói alterações locais, permite que `main` avance entre validação e execução e pode expor uma versão incompleta. Construir artefacto a partir de SHA fixo; publicar num directório de release separado. |
| Deploy | Executa `php artisan migrate --force` e reinicia PHP-FPM/recarrega Nginx sem teste da configuração, verificação de saúde ou rollback automático. | Retirar migrações do fluxo de publicação. Rever Nginx com `nginx -t`; trocar `current` atomicamente apenas após pré-validação, testar endpoints e reverter para a release anterior perante falha. Migrações futuras precisam de procedimento e aprovação próprios. |
| Backup | `.github/workflows/backup.yml` usa runner `self-hosted`, faz checkout e chama `scripts/backup.sh` sem `APP_DIR` ou `BACKUP_DIR` explícitos. | Por defeito o script arquiva `storage/app` do checkout, que pode não ser o da aplicação em produção. A localização real do runner e dos dados permanece por verificar. |
| Backup | Se faltar `pg_dump`, `DB_DATABASE` ou configuração adequada, o script emite aviso e continua. Depois pode eliminar cópias antigas. | Uma execução bem-sucedida não prova backup da base. Falhar imediatamente, validar todos os artefactos e só aplicar retenção após backup completo, verificado e replicado. |
| Backup | O workflow fornece variáveis S3, mas o script não as utiliza. O script também copia `.env` em claro e executa `source` sobre ele. | Não assumir cópia externa. Evitar executar `.env` como shell; guardar configuração sensível apenas em pacote cifrado com acesso restrito ou mecanismo de recuperação de segredos aprovado. |
| Backup | A limpeza usa `find` em todos os ficheiros antigos do directório e não coordena a janela de backup com o deploy. | Limitar retenção aos conjuntos válidos criados pelo próprio mecanismo, usar bloqueio de execução e impedir a limpeza após falha. Rever o impacto de alterações simultâneas aos ficheiros. |
| Cópia alumni | `app/Console/Commands/PrepararDocumentosAlumniPrivados.php` copia por defeito; `--dry-run` tem de ser pedido explicitamente. | Uma chamada sem opção pode começar a escrever no destino privado. Antes de qualquer uso operacional, inverter o padrão: simular por defeito e exigir opção explícita de execução, identificador da mudança e confirmação do ambiente; rever também a saída de inventário. |

O repositório contém `composer.lock` e `package-lock.json` versionados. A aplicação usa `storage/app/public` para documentos públicos e `storage/app/private/alumni` para novos documentos alumni. As vistas de notícias e outros conteúdos dependem de `/storage/`; por isso o bloqueio tem de afectar apenas `alumni-documentos`, sem alterar o tratamento geral de `/storage/`.

## Arquitectura proposta

1. **Código aprovado.** Pull request com CI obrigatória, revisão e SHA de commit identificado. A aprovação de publicação refere-se a esse SHA e a um pedido de mudança. Nenhum `push` publica automaticamente.
2. **Validação antes dos segredos.** Um workflow iniciado manualmente testa o SHA num runner hospedado e prepara um artefacto imutável com manifesto e SHA-256. Esta fase não recebe credenciais de produção.
3. **Aprovação de produção.** O job de publicação usa o ambiente GitHub `production` com revisores obrigatórios configurados na plataforma. Os segredos de deploy ficam nesse ambiente e só chegam ao job aprovado. A possibilidade dessa regra depende das definições e plano do repositório; verificar no GitHub antes de activar. O modelo está em `docs/proposals/workflow-publicacao-controlada.yml`.
4. **Releases no servidor.** Preparar, numa intervenção futura autorizada, `/var/www/isp-bie.ao/releases/<sha>` e um espaço partilhado para `.env` e `storage`. `public/storage` aponta somente para `storage/app/public`; `storage/app/private` não fica sob o document root nem sob qualquer alias. O Nginx deverá apontar para `current/public`, em que `current` é um link para uma release completa. A mudança da instalação actual para esta estrutura exige plano próprio de cutover e testes de caminhos.
5. **Publicação e recuperação.** O publicador futuro verifica o SHA e o artefacto, cria a nova release sem tocar em `current`, liga recursos partilhados, valida configuração e permissões, troca `current` de forma atómica no mesmo filesystem e recarrega PHP-FPM de forma controlada. Guarda a release anterior. Se os testes de saúde falharem, repõe `current` anterior e repete os testes. O rollback de código não deve voltar a expor documentos alumni nem tentar reverter uma alteração de esquema; não há migrações neste fluxo.
6. **Separação da migração alumni.** O bloqueio directo no Nginx, a publicação de código e a cópia dos documentos são decisões operacionais com controlos próprios. A cópia preserva os originais; a remoção é uma etapa distinta. Congelar uploads e eliminações durante o inventário e a cópia, ou usar um mecanismo de reconciliação verificado antes de terminar a janela.

O modelo de workflow é deliberadamente inerte: está fora de `.github/workflows`, usa um publicador futuro que ainda não existe e falha se alguém tentar activá-lo sem essa implementação. A regra de revisores e as restrições de branch não podem ser estabelecidas pelo YAML; têm de ser comprovadas nas definições do ambiente GitHub. O antigo workflow de `push` tem de ser desactivado antes da activação do modelo; usar a mesma chave de concorrência não elimina o gatilho automático.

### Ficheiros e definições a alterar numa fase futura

| Local | Alteração proposta |
| --- | --- |
| `.github/workflows/deploy.yml` | Remover publicação no `push`, retirar migrações, usar SHA aprovado, artefacto e job protegido por aprovação. O modelo de referência está em `docs/proposals/workflow-publicacao-controlada.yml`. |
| `.github/workflows/ci.yml` | Fixar permissões mínimas, rever acções, corrigir o comportamento do Lighthouse e associar os checks exigidos à protecção de `main`. |
| `.github/workflows/backup.yml` | Declarar o `APP_DIR` correcto, restringir segredos e runner, coordenar a execução com a janela de release e verificar a cópia externa. |
| `scripts/backup.sh` | Falhar quando faltar base ou documentos, usar origem explícita, validar integridade/restauro, publicar conjuntos completos e aplicar retenção segura. |
| `scripts/release/build-artifact.sh` e `scripts/release/publish-artifact.sh` | Criar e rever scripts com testes de artefacto, paths, permissões, troca atómica, smoke tests e rollback. Estes scripts não existem hoje. |
| `app/Console/Commands/PrepararDocumentosAlumniPrivados.php` | Tornar a simulação o comportamento padrão e exigir opção explícita para copiar, com pré-condições de destino e identificação da operação. |
| Configuração Nginx fora do repositório | Adaptar `docs/proposals/nginx-alumni.conf` aos `server` e aliases reais; validar e activar apenas na intervenção autorizada. |
| Definições GitHub | Configurar revisores obrigatórios, impedir autoaprovação, restringir branches, aplicar protecção de `main` e limitar acesso a segredos e runners. |

## Proposta para corrigir o backup

O futuro `scripts/backup.sh` deverá receber `APP_DIR` e `BACKUP_DIR` absolutos e validados, apontando explicitamente para a instalação e o armazenamento partilhado correctos. A ligação PostgreSQL deverá vir de um mecanismo de segredos configurado para o backup, com privilégio mínimo, sem executar o conteúdo de `.env`. Falta qualquer parâmetro essencial ou ferramenta? Terminar com código diferente de zero antes de aplicar retenção.

Criar um conjunto temporário privado no volume de backup, com um identificador único: `database.dump` em formato customizado (`pg_dump -Fc`), arquivo dos documentos realmente usados pela aplicação (`storage/app/public` e `storage/app/private`, além de outros dados necessários identificados no preflight) e um manifesto com data UTC, SHA da release, nomes, tamanhos, contagens e SHA-256 dos artefactos. Proteger directórios e ficheiros com permissões restritas. Verificar `pg_restore --list`, `gzip -t` e a listagem integral do arquivo de ficheiros, além de `sha256sum`; estas verificações detectam corrupção evidente, mas não substituem um restauro. A promoção deve ser atómica no mesmo filesystem. Publicar o indicador de sucesso apenas depois de todas as verificações; falhas deixam o conjunto incompleto fora da lista de backups válidos.

Restaurar periodicamente um conjunto numa base PostgreSQL e armazenamento isolados, conferir registos e amostras de documentos por hash e registar o tempo de recuperação. Confirmar cópia externa cifrada e a sua integridade antes de apagar versões antigas. A retenção mantém, no mínimo, a última cópia verificada mesmo quando o backup do dia falha. A consistência entre metadados da base e ficheiros exige congelar alterações aos documentos durante o snapshot ou usar uma estratégia de snapshot coordenada; `pg_dump` por si só não sincroniza o arquivo de ficheiros.

Sequência de implementação do script futuro: validar caminhos absolutos e ferramentas; obter um bloqueio exclusivo para impedir execuções concorrentes; identificar a origem real dos ficheiros e a base esperada; criar apenas no destino de backup uma pasta temporária de modo restrito; produzir dump e arquivo; validar cada saída, manifesto e hashes; promover o conjunto completo; confirmar replicação externa; registar sucesso; só então executar retenção limitada aos conjuntos identificados pelo próprio script. Qualquer falha deixa um código de saída não zero e preserva todos os conjuntos anteriormente válidos. O tratamento de erro pode limpar apenas o temporário da execução corrente, nunca os documentos de origem nem backups anteriores.

## Bloqueio público de referência

`docs/proposals/nginx-alumni.conf` contém duas regras de Nginx para o caminho exacto e o prefixo `/storage/alumni-documentos/`. Devem ser adaptadas aos blocos `server` reais e a qualquer proxy/CDN/alias. A regra não substitui a autorização do Laravel. Confirmar que `/storage/noticias/documentos/`, imagens, editais e outros ficheiros públicos continuam disponíveis. Um ficheiro de configuração Apache `.htaccess` no repositório não prova que Nginx o utilize.

## Checklist de acesso de leitura ao servidor

Recolher apenas resultados sem segredos ou dados pessoais; não executar comandos que criem, movam ou apaguem ficheiros nesta fase.

- **Servidor e rotas:** identificar versão e processo de Nginx, `nginx -T` com saída revista antes de partilha, todos os `server_name`, `root`, `alias`, `location`, `try_files`, proxies e caches/CDN. Confirmar HTTP e HTTPS, nomes com e sem `www` e qualquer host alternativo. Resolver `realpath/readlink` de `public`, `public/storage`, `storage/app/public` e `storage/app/private/alumni`; verificar que o destino privado não é alcançável por aliases.
- **Inventário:** obter consulta de leitura dos IDs e caminhos de `alumni_documentos`, incluindo entradas ausentes, duplicadas, divergentes ou fora do prefixo. Comparar o prefixo com os campos de caminho de outros modelos e com os ficheiros físicos. Registar só contagens, tamanhos e hashes no relatório partilhado.
- **Capacidade e atomicidade:** consultar `df -h`, `df -i`, `findmnt` e `stat` nos volumes de origem, destino e backup. Calcular espaço para todos os ficheiros ainda sem cópia privada, o maior temporário e reserva operacional; verificar limites de inodes. A leitura do tipo de filesystem não prova suporte a `link(2)`: o ensaio de escrita descartável no volume exacto fica para uma autorização posterior.
- **Permissões:** identificar os utilizadores efectivos de PHP-FPM, Nginx e backup; consultar propriedade, modo e ACL dos caminhos. Confirmar leitura dos originais e escrita no destino privado pelo utilizador que executará a cópia; confirmar que Nginx e aliases não expõem o destino.
- **Backups:** localizar a execução real do job e o `APP_DIR` efectivo, a última cópia completa da base e dos documentos, manifestos, hashes, retenção e destino externo. Confirmar logs e código de saída, `pg_restore --list`, integridade do arquivo e registo de restauro isolado. Não partilhar `.env`, segredos ou conteúdo dos documentos.
- **GitHub:** verificar protecção de `main`, checks obrigatórios, permissões de `GITHUB_TOKEN`, estado e regras de aprovação do ambiente `production`, protecção de segredos, autorização de runners próprios e estado dos workflows agendados.

Classificar cada item como verificado, falhado ou não verificado. A ausência de prova de backup restaurável, de regra de bloqueio completa, de espaço/permissões ou de aprovação manual impede a execução em produção.

## Sequência recomendada e critérios de interrupção

1. Completar a checklist e guardar um inventário aprovado. Parar se existir alias desconhecido, um ficheiro não alumni sob o prefixo a bloquear ou acesso ao destino privado pelo servidor web.
2. Corrigir backup e demonstrar restauro isolado. Parar se faltar base, documentos, hashes, espaço ou cópia externa verificada.
3. Preparar release e publicador em testes; validar SHA, artefacto, troca de link e rollback. Aprovar separadamente a alteração de workflow e o cutover para releases. Parar se a publicação puder executar migrações ou se `main` ainda iniciar produção automaticamente.
4. Numa janela futura autorizada, guardar a configuração activa e aplicar o bloqueio específico após `nginx -t`. Verificar 403/404 para o caminho alumni directo e respostas esperadas para outros documentos, incluindo aliases e caches. Parar e ajustar se qualquer controlo falhar; não reabrir indiscriminadamente os URLs alumni.
5. Publicar o código validado, testar portal autenticado e perfis recusados, executar simulação da cópia e resolver conflitos. Só copiar após autorização específica; conferir contagem e SHA-256 de cada item. Um erro interrompe a fase e os originais permanecem.
6. Acompanhar logs e latência, manter o bloqueio público e as cópias originais. Se a release falhar, voltar à release anterior compatível e repetir os testes. Se a cópia falhar, servir os originais pela rota autenticada e retomar o comando após diagnóstico; não remover ficheiros nesta operação.

Fontes técnicas externas: [GitHub Actions deployments](https://docs.github.com/en/actions/how-tos/deploy/configure-and-manage-deployments/control-deployments), [GitHub environments](https://docs.github.com/en/actions/reference/workflows-and-actions/deployments-and-environments), [Nginx location](https://nginx.org/en/docs/http/ngx_http_core_module.html#location), [PostgreSQL pg_dump](https://www.postgresql.org/docs/current/app-pgdump.html) e [pg_restore](https://www.postgresql.org/docs/current/app-pgrestore.html).
