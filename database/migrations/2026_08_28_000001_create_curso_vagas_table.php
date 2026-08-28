<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso_vagas', function (Blueprint $table) {
            $table->id();
            $table->string('curso');
            $table->string('periodo');
            $table->unsignedInteger('vagas')->default(0);
            $table->timestamps();

            $table->unique(['curso', 'periodo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_vagas');
    }
};
