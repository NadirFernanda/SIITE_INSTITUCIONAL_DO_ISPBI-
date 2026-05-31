<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->date('data_exame')->nullable()->after('capacidade');
            $table->string('horario', 20)->nullable()->after('data_exame');
            // Ex: '08:00-10:00', '10:30-12:30', '13:00-15:00', '15:30-18:00'
        });
    }

    public function down(): void
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->dropColumn(['data_exame', 'horario']);
        });
    }
};
