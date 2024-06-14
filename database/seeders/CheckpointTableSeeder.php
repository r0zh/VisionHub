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
                'name' => 'PonyMixDPO',
                'description' => "Go-to model for generating anime/cartoon/drawings images.",
                'fileName' => 'autismmixSDXL_autismmixDPO.safetensors',
                'steps' => 25,
                'cfg' => 7,
                'sampler_name' => 'euler_ancestral',
                'scheduler' => 'karras',
            ],
            [
                'name' => 'RealisticVisionV4',
                'description' => 'This model is a good starting point for generating realistic images.',
                'fileName' => 'realvisxlV40_v40LightningBakedvae.safetensors',
                'steps' => 5,
                'cfg' => 1.0,
                "sampler_name" => "dpmpp_sde",
                'scheduler' => 'karras'
            ],
        ]);
    }
}
