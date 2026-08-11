<?php

namespace App\Support;

class MailAddressSanitizer
{
    /**
     * Remove caracteres de controlo (CR/LF/NUL) de um endereço de email e
     * rejeita-o (devolve null) se, depois de limpo, deixar de ser um email
     * válido de uma só linha.
     *
     * Defesa em profundidade contra CVE-2026-48019 (bypass da regra de
     * validação 'email' do Laravel <12.60/<13.10 que permite injecção de
     * cabeçalhos de email) — este site ainda não pode adoptar a versão
     * corrigida sem um upgrade maior do framework, por isso os endereços
     * submetidos publicamente (formulário de contacto, alertas de concurso,
     * candidaturas) são revalidados aqui antes de serem usados em
     * cabeçalhos de email (To/Reply-To).
     */
    public static function clean(?string $email): ?string
    {
        if ($email === null || $email === '') {
            return null;
        }

        $stripped = trim(preg_replace('/[\r\n\x00]+/', '', $email));

        return filter_var($stripped, FILTER_VALIDATE_EMAIL) !== false ? $stripped : null;
    }

    /**
     * Filtra uma lista de endereços, descartando os que sejam inválidos ou
     * contenham caracteres de controlo.
     *
     * @param  iterable<string|null>  $emails
     * @return array<int, string>
     */
    public static function cleanMany(iterable $emails): array
    {
        $clean = [];
        foreach ($emails as $email) {
            $safe = static::clean($email);
            if ($safe !== null) {
                $clean[] = $safe;
            }
        }

        return $clean;
    }
}
