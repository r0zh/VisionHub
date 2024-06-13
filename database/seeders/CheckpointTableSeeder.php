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
            ],
            [
                'name' => 'Realistic vision V6.0',
                'description' => 'This model is a good starting point for generating realistic images.',
                'fileName' => 'realisticVisionV60B1_v51HyperVAE.safetensors',
            ],
        ]);
    }
}
