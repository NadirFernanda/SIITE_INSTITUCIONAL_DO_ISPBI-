<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sala_disciplines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sala_id')->constrained('salas')->onDelete('cascade');
            $table->string('discipline');
            $table->unsignedTinyInteger('weight_percent')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sala_disciplines');
    }
};
