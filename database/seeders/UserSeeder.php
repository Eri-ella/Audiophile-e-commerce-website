<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        User::factory()->admin()->create([
            'name' => 'Admin Audiophile',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'), 
        ]);

        User::factory()->count(10)->create();
    }
}
