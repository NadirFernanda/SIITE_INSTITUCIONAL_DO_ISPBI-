<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Adicionar colunas de assinatura (compatível com todos os drivers)
        Schema::table('candidaturas', function (Blueprint $table) {
            if (! Schema::hasColumn('candidaturas', 'assinado_por')) {
                $table->unsignedBigInteger('assinado_por')->nullable()->after('notas_admin');
            }
            if (! Schema::hasColumn('candidaturas', 'assinado_em')) {
                $table->timestamp('assinado_em')->nullable()->after('assinado_por');
            }
            if (! Schema::hasColumn('candidaturas', 'assinatura_codigo')) {
                $table->string('assinatura_codigo', 64)->nullable()->after('assinado_em');
            }
        });

        // Expandir o enum/check do status para incluir 'concluida'
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE candidaturas MODIFY COLUMN status ENUM('pendente','em_analise','aprovada','rejeitada','concluida') NOT NULL DEFAULT 'pendente'");
        } elseif ($driver === 'pgsql') {
            // PostgreSQL: remover a constraint CHECK antiga e criar nova
            DB::statement("ALTER TABLE candidaturas DROP CONSTRAINT IF EXISTS candidaturas_status_check");
            DB::statement("ALTER TABLE candidaturas ADD CONSTRAINT candidaturas_status_check CHECK (status IN ('pendente','em_analise','aprovada','rejeitada','concluida'))");
        }
        // SQLite: não tem suporte nativo para modificar constraints — a validação
        // é feita apenas na camada de aplicação (CandidaturaController + Eloquent)
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn(array_filter(
                ['assinado_por', 'assinado_em', 'assinatura_codigo'],
                fn($col) => Schema::hasColumn('candidaturas', $col)
            ));
        });

        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE candidaturas MODIFY COLUMN status ENUM('pendente','em_analise','aprovada','rejeitada') NOT NULL DEFAULT 'pendente'");
        } elseif ($driver === 'pgsql') {
            DB::statement("ALTER TABLE candidaturas DROP CONSTRAINT IF EXISTS candidaturas_status_check");
            DB::statement("ALTER TABLE candidaturas ADD CONSTRAINT candidaturas_status_check CHECK (status IN ('pendente','em_analise','aprovada','rejeitada'))");
        }
    }
};
