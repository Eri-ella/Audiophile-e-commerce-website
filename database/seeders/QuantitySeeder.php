<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rien à faire ici :
        // ProductSeeder crée déjà les lignes de la table quantities
        // via $p->contents()->attach([...])
    }
}