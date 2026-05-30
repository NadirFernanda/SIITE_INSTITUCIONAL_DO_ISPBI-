<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->unsignedInteger('capacidade');
            $table->timestamps();
        });

        Schema::table('candidaturas', function (Blueprint $table) {
            $table->foreignId('sala_id')->nullable()->after('status')
                  ->constrained('salas')->nullOnDelete();
            $table->unsignedInteger('numero_lugar')->nullable()->after('sala_id');
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropForeign(['sala_id']);
            $table->dropColumn(['sala_id', 'numero_lugar']);
        });

        Schema::dropIfExists('salas');
    }
};
