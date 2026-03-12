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

        // IMPORTANT: Change these passwords immediately after first login.
        // Never use these defaults in production — update via the command:
        //   php artisan tinker
        //   \App\Models\User::where('email','admin@ispbie.ao')->update(['password'=>bcrypt('NEW_STRONG_PASSWORD')])
        User::factory()->create([
            'name' => 'Administrador Principal',
            'email' => 'admin@ispbie.ao',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Editor de Conteúdo',
            'email' => 'editor@ispbie.ao',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Gestor Acadêmico',
            'email' => 'academico@ispbie.ao',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}
