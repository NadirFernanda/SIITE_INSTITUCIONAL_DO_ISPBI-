<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_visitas', function (Blueprint $table) {
            $table->id();
            $table->string('pais', 100)->default('Desconhecido');
            $table->string('pais_code', 2)->default('??');
            $table->string('pagina', 255)->default('/');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_visitas');
    }
};
