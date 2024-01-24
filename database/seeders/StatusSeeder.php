<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'backlog'],
            ['name' => 'hold'],
            ['name' => 'in_progress'],
            ['name' => 'staging'],
            ['name' => 'testing'],
            ['name' => 'prod'],
            ['name' => 'done']
        ];

        DB::table('statuses')->insert($statuses);
    }
}
