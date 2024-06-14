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
                'name' => 'Drawing Lora',
                'description' => "Lora model trained on monochrome drawings.",
                'fileName' => 'sp1tXLP.safetensors',
            ],
            [
                'name' => 'Monet Lora',
                'description' => 'Lora model trained on Monet paintings.',
                'fileName' => 'm0n3tXLP.safetensors',
            ]

        ]);
    }
}
