<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //DB::table('languages')->truncate();
        Language::create([
            'name' => "ru"
        ]);
        Language::create([
            'name' => "en"
        ]);
    }
}
