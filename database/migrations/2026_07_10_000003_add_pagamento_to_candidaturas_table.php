<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->boolean('pagamento_confirmado')->default(false)->after('local_inscricao');
            $table->timestamp('pagamento_confirmado_em')->nullable()->after('pagamento_confirmado');
            $table->unsignedBigInteger('pagamento_confirmado_por')->nullable()->after('pagamento_confirmado_em');
            $table->foreign('pagamento_confirmado_por')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropForeign(['pagamento_confirmado_por']);
            $table->dropColumn(['pagamento_confirmado', 'pagamento_confirmado_em', 'pagamento_confirmado_por']);
        });
    }
};
