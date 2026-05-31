<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Adicionar colunas de assinatura digital
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->unsignedBigInteger('assinado_por')->nullable()->after('notas_admin');
            $table->timestamp('assinado_em')->nullable()->after('assinado_por');
            $table->string('assinatura_codigo', 64)->nullable()->after('assinado_em');
        });

        // Expandir o enum do status para incluir 'concluida'
        // (SQLite não suporta ALTER COLUMN, por isso usamos SQL directo)
        if (DB::getDriverName() === 'sqlite') {
            DB::statement("
                CREATE TABLE IF NOT EXISTS candidaturas_new AS SELECT * FROM candidaturas WHERE 0
            ");
            // Não recriamos a tabela — o SQLite neste projecto usa VARCHAR sem CHECK
            // Verificar e adicionar 'concluida' apenas no nível de aplicação
        } else {
            // MySQL/PostgreSQL: modificar o enum directamente
            DB::statement("ALTER TABLE candidaturas MODIFY COLUMN status ENUM('pendente','em_analise','aprovada','rejeitada','concluida') NOT NULL DEFAULT 'pendente'");
        }
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn(['assinado_por', 'assinado_em', 'assinatura_codigo']);
        });
    }
};
