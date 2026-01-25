<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('curso');
            $table->year('ano');
            $table->string('contacto');
            $table->boolean('trabalha');
            $table->string('empresa')->nullable();
            $table->string('cargo')->nullable();
            $table->text('satisfacao')->nullable();
            $table->boolean('publicado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
