<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            // Remover índice baseado em email
            $table->dropUnique('unique_candidatura_periodo_curso');
            // Criar índice baseado em BI
            $table->unique(['bi', 'periodo', 'curso'], 'unique_candidatura_bi_periodo_curso');
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropUnique('unique_candidatura_bi_periodo_curso');
            $table->unique(['email', 'periodo', 'curso'], 'unique_candidatura_periodo_curso');
        });
    }
};
