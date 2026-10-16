<?php

namespace Tests\Support;

use App\Models\Candidatura;
use App\Models\Sala;
use App\Models\SalaDiscipline;

class AcademicFixtures
{
    public static function sala(array $attributes = []): Sala
    {
        return Sala::create(array_merge([
            'nome' => 'Sala de Teste',
            'capacidade' => 10,
            'data_exame' => null,
            'horario' => null,
        ], $attributes));
    }

    public static function candidatura(array $attributes = []): Candidatura
    {
        static $sequence = 0;
        $sequence++;

        return Candidatura::create(array_merge([
            'nome' => 'Candidato de Teste '.$sequence,
            'email' => 'teste'.$sequence.'@example.test',
            'telefone' => '90000000',
            'curso' => 'Comunicação Social',
            'periodo' => 'regular',
            'status' => 'aprovada',
            'pagamento_confirmado' => true,
            'necessidade_especial' => 'Nenhuma',
        ], $attributes));
    }

    public static function disciplinas(Sala $sala, array $disciplinas): void
    {
        foreach ($disciplinas as $nome => $peso) {
            SalaDiscipline::create([
                'sala_id' => $sala->id,
                'discipline' => $nome,
                'weight_percent' => $peso,
            ]);
        }
    }
}
