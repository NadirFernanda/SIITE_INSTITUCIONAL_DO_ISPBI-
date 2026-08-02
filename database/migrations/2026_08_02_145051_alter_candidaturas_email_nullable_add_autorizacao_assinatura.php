<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->string('email', 255)->nullable()->change();
            $table->boolean('autorizacao_assinatura')->default(false)->after('email');
            $table->timestamp('autorizacao_assinatura_em')->nullable()->after('autorizacao_assinatura');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn(['autorizacao_assinatura', 'autorizacao_assinatura_em']);
            $table->string('email', 255)->nullable(false)->change();
        });
    }
};
