<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            if (! Schema::hasColumn('candidaturas', 'codigo_exame')) {
                $table->string('codigo_exame', 12)->nullable()->unique()->after('pagamento_confirmado_por');
            }
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            if (Schema::hasColumn('candidaturas', 'codigo_exame')) {
                $table->dropUnique(['codigo_exame']);
                $table->dropColumn('codigo_exame');
            }
        });
    }
};
