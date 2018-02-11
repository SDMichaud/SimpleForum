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
            'subject' => 'This is only a test',
        ]);
        DB::table('threads')->insert([
            'author' => 'Scott',
            'subject' => 'This site sucks...',
        ]);
        
    }
}
