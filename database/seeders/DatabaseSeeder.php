<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'role' => 'client',
            'password' => null,
        ]);

        User::factory()->create([
            'name' => 'Alice Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('MotDePasseSecurise123'),
        ]);
    }
}
