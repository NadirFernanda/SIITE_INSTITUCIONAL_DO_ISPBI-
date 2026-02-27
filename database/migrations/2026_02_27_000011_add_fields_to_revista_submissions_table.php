<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToRevistaSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::table('revista_submissions', function (Blueprint $table) {
            $table->string('email')->nullable()->after('title');
            $table->string('affiliation')->nullable()->after('email');
            $table->string('category')->nullable()->after('affiliation');
            $table->text('notes')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('revista_submissions', function (Blueprint $table) {
            $table->dropColumn(['email','affiliation','category','notes']);
        });
    }
}
