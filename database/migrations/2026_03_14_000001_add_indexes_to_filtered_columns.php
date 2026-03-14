<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->index('publicada');
        });

        Schema::table('concursos', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('alumni', function (Blueprint $table) {
            $table->index('publicado');
        });
    }

    public function down(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropIndex(['publicada']);
        });

        Schema::table('concursos', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('alumni', function (Blueprint $table) {
            $table->dropIndex(['publicado']);
        });
    }
};
