<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseDisciplinesSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            // Enfermagem
            ['course_name' => 'Curso de Enfermagem', 'discipline' => 'Biologia', 'weight_percent' => 35],
            ['course_name' => 'Curso de Enfermagem', 'discipline' => 'Química', 'weight_percent' => 25],
            ['course_name' => 'Curso de Enfermagem', 'discipline' => 'Matemática', 'weight_percent' => 30],
            ['course_name' => 'Curso de Enfermagem', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 10],

            // Contabilidade e Administração
            ['course_name' => 'Curso de Contabilidade E Administração', 'discipline' => 'Matemática', 'weight_percent' => 60],
            ['course_name' => 'Curso de Contabilidade E Administração', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 40],

            // Psicologia
            ['course_name' => 'Curso de Psicologia', 'discipline' => 'Psicologia Geral', 'weight_percent' => 60],
            ['course_name' => 'Curso de Psicologia', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 40],

            // Comunicação Social
            ['course_name' => 'Curso de Comunicação Social', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 60],
            ['course_name' => 'Curso de Comunicação Social', 'discipline' => 'Cultura Geral', 'weight_percent' => 40],

            // Engenharia Informática
            ['course_name' => 'Curso de Engenharia Informática', 'discipline' => 'Matemática', 'weight_percent' => 40],
            ['course_name' => 'Curso de Engenharia Informática', 'discipline' => 'Física', 'weight_percent' => 30],
            ['course_name' => 'Curso de Engenharia Informática', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 30],

            // Engenharia em Recursos Hídricos (canonical + variants)
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Matemática', 'weight_percent' => 30],
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Física', 'weight_percent' => 30],
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Química', 'weight_percent' => 20],
            ['course_name' => 'Engenharia em Recursos Hídricos', 'discipline' => 'Língua Portuguesa', 'weight_percent' => 20],
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
