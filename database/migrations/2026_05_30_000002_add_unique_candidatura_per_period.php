<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            // Um candidato não pode submeter duas candidaturas para o mesmo
            // curso no mesmo período. Pode candidatar-se ao mesmo curso em
            // períodos diferentes, ou a cursos diferentes no mesmo período.
            $table->unique(['email', 'periodo', 'curso'], 'unique_candidatura_periodo_curso');
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropUnique('unique_candidatura_periodo_curso');
        });
    }
};
