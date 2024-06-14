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
                'description' => "Embedding with common negative prompts. This embedding should be used in your NEGATIVE prompt.",
                'fileName' => 'FastNegativeV2',
            ],
            [
                'name' => 'EasyNegative',
                'description' => 'Embedding with common negative prompts. This embedding should be used in your NEGATIVE prompt.',
                'fileName' => 'easynegative',
            ],
            [
                'name' => 'PlanIt',
                'description' => "Embedding that is good for generating images of plans/blueprints.",
                "fileName" => "PlanIt",
            ]
        ]);
    }
}
