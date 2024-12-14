<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'Blogram',
            'logo_url' => 'cover7.png',
            'favicon_url' => 'favicon-32x32.png',
            'font_family' => 'sans-serif',
            'font_size' => 14,
        ]);
    }
}
