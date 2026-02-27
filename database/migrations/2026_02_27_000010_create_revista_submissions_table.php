<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevistaSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('revista_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->string('title');
            $table->text('description');
            $table->string('link');
            $table->string('status')->default('pending');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('revista_submissions');
    }
}
