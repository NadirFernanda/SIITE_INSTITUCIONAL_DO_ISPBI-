<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumni_count')->default(0);
            $table->unsignedInteger('employability_percentage')->default(0);
            $table->unsignedInteger('countries_count')->default(0);
            $table->unsignedInteger('companies_founded')->default(0);
            $table->timestamps();
        });

        // Insert initial row
        DB::table('alumni_stats')->insert([
            'alumni_count' => 0,
            'employability_percentage' => 0,
            'countries_count' => 0,
            'companies_founded' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_stats');
    }
};
