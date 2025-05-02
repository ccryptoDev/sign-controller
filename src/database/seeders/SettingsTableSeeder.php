<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'num_messages_to_keep', 'value' => '30', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'screen_pixels_high', 'value' => '32', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'screen_pixels_wide', 'value' => '56', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'font_pixels_high', 'value' => '10', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'font_pixels_wide', 'value' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'top_blank_rows', 'value' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'between_1st_2nd_row', 'value' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'between_2nd_3rd_row', 'value' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'blank_lines_bottom', 'value' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'seconds_to_show', 'value' => '5', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(['key' => $setting['key']], $setting);
        }
    }
}
