<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->unsignedBigInteger('comprovativo_impresso_presencialmente_por')->nullable()->after('whatsapp_comprovativo_falhou_em');
            $table->timestamp('comprovativo_impresso_presencialmente_em')->nullable()->after('comprovativo_impresso_presencialmente_por');
        });
    }

    public function down()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn(['comprovativo_impresso_presencialmente_por', 'comprovativo_impresso_presencialmente_em']);
        });
    }
};
