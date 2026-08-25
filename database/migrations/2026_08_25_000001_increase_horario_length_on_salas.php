<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Os horários actuais (ex.: '08:00-10:00 e 10:30-12:30') têm 25
        // caracteres — a coluna original tinha só varchar(20), o que
        // rejeitava o insert com "value too long for type character
        // varying(20)" e causava erro 500 ao distribuir os candidatos pelas
        // salas. SQL directo em vez de Schema::change() para não depender do
        // pacote doctrine/dbal, que não está instalado neste projecto.
        DB::statement('ALTER TABLE salas ALTER COLUMN horario TYPE VARCHAR(50)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE salas ALTER COLUMN horario TYPE VARCHAR(20)');
    }
};
