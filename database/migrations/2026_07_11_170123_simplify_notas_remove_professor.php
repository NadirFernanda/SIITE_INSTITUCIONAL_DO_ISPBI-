<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remover tabela notas e campo codigo_exame
        Schema::dropIfExists('notas');
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropUnique(['codigo_exame']);
            $table->dropColumn('codigo_exame');
        });

        // Adicionar nota_exame directamente na candidatura
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->decimal('nota_exame', 4, 1)->nullable()->after('status');
            $table->unsignedBigInteger('nota_lancada_por')->nullable()->after('nota_exame');
            $table->timestamp('nota_lancada_em')->nullable()->after('nota_lancada_por');
            $table->foreign('nota_lancada_por')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropForeign(['nota_lancada_por']);
            $table->dropColumn(['nota_exame', 'nota_lancada_por', 'nota_lancada_em']);
        });
    }
};
