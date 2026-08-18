<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            'Headphone unit', 'Replacement earcups', 'User manual',
            '3.5mm 5m audio cable', 'Travel bag',
            'Speaker unit', 'Speaker cloth panel',
            '3.5mm 10m audio cable', '10m optical cable', '7.5m optical cable',
            'Earphone unit', 'Multi-size earplugs', 'USB-C charging cable', 'Travel pouch',
        ];

        foreach ($contents as $name) {
            Content::create(['name' => $name]);
        }
    }
}