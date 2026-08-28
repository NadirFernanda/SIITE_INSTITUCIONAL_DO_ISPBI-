<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->string('resultado_admissao')->nullable()->after('nota_lancada_em');
            $table->timestamp('resultado_calculado_em')->nullable()->after('resultado_admissao');
            $table->foreignId('resultado_calculado_por')->nullable()->after('resultado_calculado_em')
                ->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('resultado_calculado_por');
            $table->dropColumn(['resultado_admissao', 'resultado_calculado_em']);
        });
    }
};
