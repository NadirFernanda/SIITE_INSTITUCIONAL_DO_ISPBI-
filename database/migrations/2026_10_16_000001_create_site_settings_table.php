<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->boolean('value')->default(false);
        });

        DB::table('site_settings')->insert([
            'key' => 'candidaturas_ativas',
            'value' => false,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
