<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

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
