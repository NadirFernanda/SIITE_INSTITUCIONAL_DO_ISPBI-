<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrador Principal',
            'email' => 'admin@ispbie.ao',
            'password' => bcrypt('12345678'),
        ]);

        User::factory()->create([
            'name' => 'Editor de Conteúdo',
            'email' => 'editor@ispbie.ao',
            'password' => bcrypt('12345678'),
        ]);

        User::factory()->create([
            'name' => 'Gestor Acadêmico',
            'email' => 'academico@ispbie.ao',
            'password' => bcrypt('12345678'),
        ]);
    }
}
