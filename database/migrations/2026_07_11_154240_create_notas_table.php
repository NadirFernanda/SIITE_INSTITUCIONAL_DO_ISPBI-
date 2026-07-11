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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidatura_id')->unique(); // uma nota por candidatura
            $table->unsignedBigInteger('professor_id');
            $table->decimal('nota', 4, 1);                          // 0.0 – 20.0
            $table->text('observacoes')->nullable();
            $table->timestamp('lancada_em');
            $table->timestamps();

            $table->foreign('candidatura_id')->references('id')->on('candidaturas')->cascadeOnDelete();
            $table->foreign('professor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
