<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StyleLoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('style_lora')->insert([
            [
                'lora_id' => 1,
                'style_id' => 1,
            ],
            [
                'lora_id' => 2,
                'style_id' => 1,
            ]

        ]);
    }
}
