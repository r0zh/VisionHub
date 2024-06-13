<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StyleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('styles')->insert([
            [
                'name' => 'Realistic',
                'checkpoint_id' => 2,
            ],
            [
                'name' => 'Futurist',
                'checkpoint_id' => 1,
            ],
            [
                'name' => 'Anime',
                'checkpoint_id' => 1,
            ]
        ]);
    }
}
