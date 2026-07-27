<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds fields to mark when a candidate's folha de prova was printed and by whom.
     */
    public function up()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->unsignedBigInteger('folha_impressa_por')->nullable()->after('assinatura_codigo');
            $table->timestamp('folha_impressa_em')->nullable()->after('folha_impressa_por');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn(['folha_impressa_por', 'folha_impressa_em']);
        });
    }
};
