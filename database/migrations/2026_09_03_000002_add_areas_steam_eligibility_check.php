<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE candidaturas ADD CONSTRAINT candidaturas_areas_steam_eligibility_check CHECK (
            necessidade_especial IS NULL
            OR LOWER(TRIM(necessidade_especial)) <> 'áreas steam'
            OR (
                LOWER(TRIM(sexo)) = 'feminino'
                AND LOWER(TRIM(curso)) IN (
                    'engenharia informática',
                    'engenharia em recursos hídricos'
                )
            )
        )");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE candidaturas DROP CONSTRAINT IF EXISTS candidaturas_areas_steam_eligibility_check');
    }
};
