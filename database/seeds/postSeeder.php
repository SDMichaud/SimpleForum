<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('threads')->insert([
            'author' => 'Anonymous',
            'subject' => 'This is only a test',
            'content' => "I'm testing to see if this site works properly",
        ]);
        DB::table('threads')->insert([
            'author' => 'Scott',
            'subject' => 'This site sucks...',
            'content' => "All work and no play makes Jack a dull boy. All work and no play makes Jack a dull boy. All work and no play makes Jack a dull boy. All work and no play makes Jack a dull boy. All work and no play makes Jack a dull boy. All work and no play makes Jack a dull boy. ",
        ]);
        
    }
}
