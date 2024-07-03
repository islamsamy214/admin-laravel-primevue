<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seo;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seo::updateOrCreate([
            'id' => 1,
            'title' => [
                'en' => 'Tabeeb Gara7',
                'ar' => 'طبيب جراح'
            ],
            'description' => [
                'en' => 'Tabeeb Gara7',
                'ar' => 'طبيب جراح'
            ],
            'keywords' => 'tabeeb, gara7',
            'image' => ''
        ]);
    }
}
