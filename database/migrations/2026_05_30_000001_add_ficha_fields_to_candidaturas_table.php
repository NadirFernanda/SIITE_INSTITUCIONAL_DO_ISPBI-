<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->string('filiacao_pai', 255)->nullable()->after('nome');
            $table->string('filiacao_mae', 255)->nullable()->after('filiacao_pai');
            $table->string('naturalidade_municipio', 255)->nullable()->after('data_nascimento');
            $table->string('naturalidade_provincia', 255)->nullable()->after('naturalidade_municipio');
            $table->string('bi_emitido_em', 255)->nullable()->after('bi');
            $table->date('bi_data_emissao')->nullable()->after('bi_emitido_em');
            $table->enum('sexo', ['masculino', 'feminino'])->nullable()->after('bi_data_emissao');
            $table->string('estado_civil', 100)->nullable()->after('sexo');
            $table->string('necessidade_especial', 255)->nullable()->after('estado_civil');
            $table->string('residencia_municipio', 255)->nullable()->after('necessidade_especial');
            $table->string('residencia_bairro', 255)->nullable()->after('residencia_municipio');
            $table->string('telefone2', 50)->nullable()->after('telefone');
            $table->string('habilitacoes', 100)->nullable()->after('escola_origem');
            $table->enum('estado_financeiro', ['maximo', 'medio', 'minimo'])->nullable()->after('habilitacoes');
            $table->boolean('trabalhador')->nullable()->after('estado_financeiro');
            $table->string('instituicao_laboral', 255)->nullable()->after('trabalhador');
            $table->enum('periodo', ['regular', 'pos-laboral'])->nullable()->after('curso');
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn([
                'filiacao_pai', 'filiacao_mae',
                'naturalidade_municipio', 'naturalidade_provincia',
                'bi_emitido_em', 'bi_data_emissao',
                'sexo', 'estado_civil', 'necessidade_especial',
                'residencia_municipio', 'residencia_bairro',
                'telefone2', 'habilitacoes',
                'estado_financeiro', 'trabalhador', 'instituicao_laboral',
                'periodo',
            ]);
        });
    }
};
