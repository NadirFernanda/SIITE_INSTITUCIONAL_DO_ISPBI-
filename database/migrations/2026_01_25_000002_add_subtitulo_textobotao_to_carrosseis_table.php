<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carrosseis', function (Blueprint $table) {
            $table->string('subtitulo')->nullable()->after('titulo');
            $table->string('texto_botao')->nullable()->after('subtitulo');
        });
    }

    public function down(): void
    {
        Schema::table('carrosseis', function (Blueprint $table) {
            $table->dropColumn(['subtitulo', 'texto_botao']);
        });
    }
};
