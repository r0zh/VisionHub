<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmbeddingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('embeddings')->insert([
            [
                'name' => 'FastNegative V2',
                'description' => null,
                'fileName' => 'FastNegativeV2.pt',
            ],
            [
                'name' => 'Realistic vision Negative Embedding',
                'description' => 'This embedding is a good for generating realistic images.',
                'fileName' => 'realisticvision-negative-embedding.pt',
            ],
        ]);
    }
}
