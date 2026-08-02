<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->unsignedBigInteger('comprovativo_gerado_por')->nullable()->after('folha_impressa_em');
            $table->timestamp('comprovativo_gerado_em')->nullable()->after('comprovativo_gerado_por');
        });

        // A geração de folhas por sala passou a usar o mesmo mecanismo por-candidato
        // (candidaturas.folha_impressa_em/_por) usado na impressão individual — estas
        // colunas ao nível da sala ficaram redundantes e o botão que as usava estava
        // ligado ao PDF errado (lista da sala, não as folhas de prova geradas).
        Schema::table('salas', function (Blueprint $table) {
            $table->dropColumn(['folhas_geradas_por', 'folhas_geradas_em']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn(['comprovativo_gerado_por', 'comprovativo_gerado_em']);
        });

        Schema::table('salas', function (Blueprint $table) {
            $table->unsignedBigInteger('folhas_geradas_por')->nullable();
            $table->timestamp('folhas_geradas_em')->nullable();
        });
    }
};
