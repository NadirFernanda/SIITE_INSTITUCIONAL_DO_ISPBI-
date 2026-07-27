<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseDisciplinesSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            // canonical form (existing model list uses lowercase 'em' and accent)
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Matemática', 'weight_percent' => 30],
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Física', 'weight_percent' => 30],
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Química', 'weight_percent' => 20],
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 20],
            // also seed the variant the requester wrote to be safe
            ['course_name' => 'Engenharia Em Recursos Hidrícos', 'discipline' => 'Matemática', 'weight_percent' => 30],
            ['course_name' => 'Engenharia Em Recursos Hidrícos', 'discipline' => 'Física', 'weight_percent' => 30],
            ['course_name' => 'Engenharia Em Recursos Hidrícos', 'discipline' => 'Química', 'weight_percent' => 20],
            ['course_name' => 'Engenharia Em Recursos Hidrícos', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 20],
        ];

        foreach ($rows as $r) {
            DB::table('course_disciplines')->updateOrInsert([
                'course_name' => $r['course_name'],
                'discipline' => $r['discipline'],
            ], ['weight_percent' => $r['weight_percent']]);
        }
    }
}
