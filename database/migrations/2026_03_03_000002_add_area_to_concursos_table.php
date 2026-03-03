<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('concursos', function (Blueprint $table) {
            if (! Schema::hasColumn('concursos', 'area')) {
                $table->string('area')->nullable()->after('summary');
            }
        });
    }

    public function down()
    {
        Schema::table('concursos', function (Blueprint $table) {
            if (Schema::hasColumn('concursos', 'area')) {
                $table->dropColumn('area');
            }
        });
    }
};
