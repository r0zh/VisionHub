<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tags')->insert([
            [
                'id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => null,
                'name' => 'Modern',
            ],
            [
                'id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => null,
                'name' => 'Futurist',
            ],
            [
                'id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => null,
                'name' => 'Manga',
            ],
            [
                'id' => 4,
                'created_at' => '2024-06-17 02:58:47',
                'updated_at' => '2024-06-17 02:58:47',
                'name' => 'car',
            ],
            [
                'id' => 5,
                'created_at' => '2024-06-17 03:00:14',
                'updated_at' => '2024-06-17 03:00:14',
                'name' => 'animal',
            ],
            [
                'id' => 6,
                'created_at' => '2024-06-17 03:13:35',
                'updated_at' => '2024-06-17 03:13:35',
                'name' => 'cristals',
            ],
            [
                'id' => 7,
                'created_at' => '2024-06-17 03:14:37',
                'updated_at' => '2024-06-17 03:14:37',
                'name' => 'technology',
            ],
            [
                'id' => 8,
                'created_at' => '2024-06-17 03:45:54',
                'updated_at' => '2024-06-17 03:45:54',
                'name' => 'Nature',
            ],
            [
                'id' => 9,
                'created_at' => '2024-06-17 03:56:55',
                'updated_at' => '2024-06-17 03:56:55',
                'name' => 'fantasy',
            ],
        ]);

    }
}
