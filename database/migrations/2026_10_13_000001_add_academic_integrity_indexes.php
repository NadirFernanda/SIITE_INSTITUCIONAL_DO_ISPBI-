<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->assertNoDuplicates('candidatura_notas', ['candidatura_id', 'discipline']);
        $this->assertNoDuplicates('sala_disciplines', ['sala_id', 'discipline']);
        $this->assertNoDuplicates('candidaturas', ['sala_id', 'numero_lugar'], true);

        Schema::table('candidatura_notas', function (Blueprint $table) {
            $table->unique(['candidatura_id', 'discipline'], 'candidatura_notas_candidatura_disciplina_unique');
        });

        Schema::table('sala_disciplines', function (Blueprint $table) {
            $table->unique(['sala_id', 'discipline'], 'sala_disciplines_sala_disciplina_unique');
        });

        Schema::table('candidaturas', function (Blueprint $table) {
            $table->unique(['sala_id', 'numero_lugar'], 'candidaturas_sala_lugar_unique');
        });

        Schema::create('sala_atribuicoes_historico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidatura_id');
            $table->unsignedBigInteger('sala_anterior_id')->nullable();
            $table->unsignedInteger('lugar_anterior')->nullable();
            $table->unsignedBigInteger('sala_nova_id')->nullable();
            $table->unsignedInteger('lugar_novo')->nullable();
            $table->string('evento', 20);
            $table->unsignedBigInteger('ator_id')->nullable();
            $table->timestamps();
            $table->index(['candidatura_id', 'created_at'], 'sala_atribuicoes_historico_candidatura_idx');
        });
    }

    public function down(): void
    {
        throw new RuntimeException(
            'Reversão automática recusada: a tabela de histórico contém atribuições académicas. '
            .'Recupere o código por release; qualquer alteração de esquema requer plano separado.'
        );
    }

    private function assertNoDuplicates(string $table, array $columns, bool $ignoreNull = false): void
    {
        $duplicates = DB::table($table)
            ->select($columns)
            ->selectRaw('COUNT(*) AS duplicate_count')
            ->when($ignoreNull, fn ($query) => $query->whereNotNull($columns[0])->whereNotNull($columns[1]))
            ->groupBy($columns)
            ->havingRaw('COUNT(*) > 1')
            ->limit(1)
            ->first();

        if ($duplicates) {
            throw new RuntimeException(
                'Migração recusada: existem duplicados em '.$table.' ('.implode(', ', $columns).'). '
                .'Resolva-os com autorização, preservando o registo histórico, antes de aplicar os índices.'
            );
        }
    }
};
