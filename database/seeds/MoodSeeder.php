<?php

use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moods')->insert([
            ['name' => 'Good'],
            ['name' => 'Bad'],
            ['name' => 'This is from db'],
        ]);
    }
}
