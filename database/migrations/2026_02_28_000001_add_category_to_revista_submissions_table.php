<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToRevistaSubmissionsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('revista_submissions', 'category')) {
            Schema::table('revista_submissions', function (Blueprint $table) {
                $table->string('category')->nullable()->after('affiliation');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('revista_submissions', 'category')) {
            Schema::table('revista_submissions', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }
}
