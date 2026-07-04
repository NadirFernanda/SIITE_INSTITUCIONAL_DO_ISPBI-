<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('user_nome', 200)->nullable();
            $table->string('user_role', 50)->nullable();
            $table->string('accao', 80)->index();
            $table->string('modelo', 80)->nullable();
            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->string('descricao', 500)->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamp('created_at')->useCurrent()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
