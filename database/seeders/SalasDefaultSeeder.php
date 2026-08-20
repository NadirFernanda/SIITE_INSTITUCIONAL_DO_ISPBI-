<?php

namespace Database\Seeders;

use App\Models\Sala;
use Illuminate\Database\Seeder;

class SalasDefaultSeeder extends Seeder
{
    /**
     * Salas por defeito, conforme o documento oficial "Capacidade das Salas"
     * (24 salas, capacidade total de 1.130 estudantes por turno).
     *
     * Usa updateOrCreate por nome para poder correr em segurança mais do que
     * uma vez (não duplica nem falha se as salas já existirem) — o
     * administrador continua livre para editar ou eliminar qualquer uma
     * destas depois, e para adicionar outras salas além destas.
     */
    public function run(): void
    {
        $capacidades = [
            1 => 55, 2 => 55, 3 => 55, 4 => 55, 5 => 55, 6 => 60, 7 => 65,
            8 => 40, 9 => 40, 10 => 40, 11 => 40, 12 => 40, 13 => 70, 14 => 70,
            15 => 35, 16 => 35, 17 => 35, 18 => 35, 19 => 35, 20 => 35,
            21 => 35, 22 => 35, 23 => 40, 24 => 70,
        ];

        foreach ($capacidades as $numero => $capacidade) {
            Sala::updateOrCreate(
                ['nome' => "Sala {$numero}"],
                ['capacidade' => $capacidade]
            );
        }
    }
}
