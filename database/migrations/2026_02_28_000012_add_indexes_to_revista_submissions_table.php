<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('revista_submissions')) {
            Schema::table('revista_submissions', function (Blueprint $table) {
                $table->index('status');
                $table->index('published_at');
                $table->index('category');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('revista_submissions')) {
            Schema::table('revista_submissions', function (Blueprint $table) {
                $table->dropIndex(['status']);
                $table->dropIndex(['published_at']);
                $table->dropIndex(['category']);
            });
        }
    }
};
