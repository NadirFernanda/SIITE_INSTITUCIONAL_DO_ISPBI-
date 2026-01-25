<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carrosseis', function (Blueprint $table) {
            $table->boolean('publicado')->default(false)->after('ordem');
        });
    }

    public function down(): void
    {
        Schema::table('carrosseis', function (Blueprint $table) {
            $table->dropColumn('publicado');
        });
    }
};
