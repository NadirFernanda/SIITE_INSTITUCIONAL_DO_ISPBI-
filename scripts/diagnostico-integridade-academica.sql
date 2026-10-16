-- Executar com psql -X -v ON_ERROR_STOP=1, usando uma conta PostgreSQL de leitura.
-- Mostra apenas identificadores internos; tratar a saída como informação sensível.
-- Não corrige, elimina ou consolida registos.
BEGIN TRANSACTION ISOLATION LEVEL REPEATABLE READ READ ONLY;
SET LOCAL statement_timeout = '120s';
SET LOCAL lock_timeout = '5s';

SELECT current_database() AS base, inet_server_addr() AS servidor,
       inet_server_port() AS porta, current_user AS utilizador,
       current_setting('transaction_read_only') AS apenas_leitura;

-- Cada linha abaixo impede o índice único (candidatura_id, discipline).
SELECT candidatura_id, discipline, count(*) AS ocorrencias,
       array_agg(id ORDER BY id) AS ids_notas
FROM candidatura_notas
GROUP BY candidatura_id, discipline
HAVING count(*) > 1
ORDER BY candidatura_id, discipline;

-- Cada linha abaixo impede o índice único (sala_id, discipline).
SELECT sala_id, discipline, count(*) AS ocorrencias,
       array_agg(id ORDER BY id) AS ids_disciplinas
FROM sala_disciplines
GROUP BY sala_id, discipline
HAVING count(*) > 1
ORDER BY sala_id, discipline;

-- NULL não entra no diagnóstico: o índice PostgreSQL permite múltiplos NULL.
SELECT sala_id, numero_lugar, count(*) AS ocorrencias,
       array_agg(id ORDER BY id) AS ids_candidaturas
FROM candidaturas
WHERE sala_id IS NOT NULL AND numero_lugar IS NOT NULL
GROUP BY sala_id, numero_lugar
HAVING count(*) > 1
ORDER BY sala_id, numero_lugar;

ROLLBACK;
