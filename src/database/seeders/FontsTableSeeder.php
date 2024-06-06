<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FontsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path to the SQL file
        $path = database_path('seeders/tbl_fonts.sql');
        
        // Read the SQL file
        $sql = File::get($path);

        // Execute the SQL script
        DB::unprepared($sql);
    }
}
