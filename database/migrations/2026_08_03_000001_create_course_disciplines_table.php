<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('course_disciplines', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('discipline');
            $table->unsignedTinyInteger('weight_percent')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_disciplines');
    }
};
