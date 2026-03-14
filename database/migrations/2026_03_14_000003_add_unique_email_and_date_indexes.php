<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // M-3: unique constraint on concurso_alerts.email to prevent duplicate subscriptions
        Schema::table('concurso_alerts', function (Blueprint $table) {
            $table->unique('email');
        });

        // L-8: indexes on date/publish_at columns used in ORDER BY and WHERE clauses
        Schema::table('noticias', function (Blueprint $table) {
            $table->index('data');
        });

        Schema::table('concursos', function (Blueprint $table) {
            $table->index('publish_at');
        });
    }

    public function down(): void
    {
        Schema::table('concurso_alerts', function (Blueprint $table) {
            $table->dropUnique(['email']);
        });

        Schema::table('noticias', function (Blueprint $table) {
            $table->dropIndex(['data']);
        });

        Schema::table('concursos', function (Blueprint $table) {
            $table->dropIndex(['publish_at']);
        });
    }
};
