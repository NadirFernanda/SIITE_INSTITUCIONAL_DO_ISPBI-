<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('email', 255);
            $table->string('telefone', 50);
            $table->string('bi', 20)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('curso', 255);
            $table->string('escola_origem', 255)->nullable();
            $table->year('ano_conclusao')->nullable();
            $table->text('observacoes')->nullable();
            $table->enum('status', ['pendente', 'em_analise', 'aprovada', 'rejeitada'])->default('pendente');
            $table->text('notas_admin')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('curso');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidaturas');
    }
};
