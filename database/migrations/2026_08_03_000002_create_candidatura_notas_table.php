<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('candidatura_notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidatura_id')->constrained('candidaturas')->onDelete('cascade');
            $table->string('discipline');
            $table->decimal('nota', 5, 2)->nullable();
            $table->foreignId('lancada_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('lancada_em')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidatura_notas');
    }
};
