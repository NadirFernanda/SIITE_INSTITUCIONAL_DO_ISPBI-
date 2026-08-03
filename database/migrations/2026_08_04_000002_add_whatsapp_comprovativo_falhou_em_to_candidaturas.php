<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->timestamp('whatsapp_comprovativo_falhou_em')->nullable()->after('whatsapp_comprovativo_enviado_at');
        });
    }

    public function down()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn('whatsapp_comprovativo_falhou_em');
        });
    }
};
