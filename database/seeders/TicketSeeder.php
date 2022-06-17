<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Ticket')->insert([
            'Movie' => Str::random(10),
            'Cost' => rand(1, 100),
            'TCap' => rand(1, 100),
            'CCap' => Null,
        ]);
    }
}
