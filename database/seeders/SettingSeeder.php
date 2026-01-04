<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'PULSA',
            'site_tagline' => 'Publik Suara Aspirasi',
            'site_description' => 'Media Digital Aspirasi & Jurnalisme Warga',
            'contact_email' => 'pulsa@email.com',
            'contact_whatsapp' => '08123456789',
            'contact_instagram' => '@pulsa.id',
            'about_text' => 'Publik Suara Aspirasi (PULSA) merupakan media digital aspirasi dan jurnalisme warga yang dikembangkan sebagai wadah partisipasi publik dalam menyampaikan pendapat dan gagasan.',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
