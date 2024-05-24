<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loras')->insert([
            [
                'name' => 'Zelda Breath of the Wild',
                'description' => null,
                'fileName' => 'zelda-breath-of-the-wild.safetensors',
            ],
            [
                'name' => 'Ghibli',
                'description' => 'Studio Ghibli',
                'fileName' => 'ghibli_style_offset.safetensors',
            ]

        ]);
    }
}
