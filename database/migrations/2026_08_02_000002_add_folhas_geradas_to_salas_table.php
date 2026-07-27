<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->unsignedBigInteger('folhas_geradas_por')->nullable()->after('updated_at');
            $table->timestamp('folhas_geradas_em')->nullable()->after('folhas_geradas_por');
        });
    }

    public function down()
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->dropColumn(['folhas_geradas_por', 'folhas_geradas_em']);
        });
    }
};
