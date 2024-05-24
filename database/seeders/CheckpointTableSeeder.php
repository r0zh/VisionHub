<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckpointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('checkpoints')->insert([
            [
                'name' => 'Stable diffusion v1.5',
                'description' => null,
                'fileName' => 'sd-v1-5.safetensors',
            ],
            [
                'name' => 'Realistic vision V6.0 B1',
                'description' => 'This model is a good starting point for generating realistic images.',
                'fileName' => 'realisticVisionV60B1_v51HyperVAE.safetensors',
            ],
            [
                'name' => 'AnyLora',
                'description' => 'Go-to anime model to use along loras.',
                'fileName' => 'anyloraCheckpoint_bakedvaeBlessedFp16.safetensors'
            ]
        ]);
    }
}
