<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->string('codigo_exame', 12)->nullable()->unique()->after('pagamento_confirmado_por');
        });

        // Gerar código para candidaturas já existentes
        \DB::table('candidaturas')->whereNull('codigo_exame')->orderBy('id')->each(function ($row) {
            do {
                $code = 'EX' . strtoupper(Str::random(8));
            } while (\DB::table('candidaturas')->where('codigo_exame', $code)->exists());
            \DB::table('candidaturas')->where('id', $row->id)->update(['codigo_exame' => $code]);
        });
    }

    public function down(): void
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn('codigo_exame');
        });
    }
};
