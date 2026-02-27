<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('revista_submissions', function (Blueprint $table) {
            if (Schema::hasColumn('revista_submissions', 'file')) {
                $table->dropColumn('file');
            }
        });
    }

    public function down(): void
    {
        Schema::table('revista_submissions', function (Blueprint $table) {
            if (! Schema::hasColumn('revista_submissions', 'file')) {
                $table->string('file')->nullable();
            }
        });
    }
};
