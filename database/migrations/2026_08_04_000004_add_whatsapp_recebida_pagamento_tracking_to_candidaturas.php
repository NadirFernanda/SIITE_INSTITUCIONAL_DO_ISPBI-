<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->timestamp('whatsapp_recebida_enviado_at')->nullable()->after('comprovativo_impresso_presencialmente_em');
            $table->timestamp('whatsapp_recebida_falhou_em')->nullable()->after('whatsapp_recebida_enviado_at');
            $table->timestamp('whatsapp_pagamento_enviado_at')->nullable()->after('whatsapp_recebida_falhou_em');
            $table->timestamp('whatsapp_pagamento_falhou_em')->nullable()->after('whatsapp_pagamento_enviado_at');
        });
    }

    public function down()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_recebida_enviado_at',
                'whatsapp_recebida_falhou_em',
                'whatsapp_pagamento_enviado_at',
                'whatsapp_pagamento_falhou_em',
            ]);
        });
    }
};
