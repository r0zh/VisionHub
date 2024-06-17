<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageEmbeddingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_embedding')->insert([
            [
                'id' => 1,
                'embedding_id' => 2,
                'image_id' => 4,
                'weight' => 1.0,
                'prompt_target' => 'negative',
                'created_at' => '2024-06-17 03:13:38',
                'updated_at' => '2024-06-17 03:13:38',
            ],
            [
                'id' => 2,
                'embedding_id' => 1,
                'image_id' => 7,
                'weight' => 1.0,
                'prompt_target' => 'negative',
                'created_at' => '2024-06-17 03:42:52',
                'updated_at' => '2024-06-17 03:42:52',
            ],
            [
                'id' => 3,
                'embedding_id' => 1,
                'image_id' => 8,
                'weight' => 1.0,
                'prompt_target' => 'negative',
                'created_at' => '2024-06-17 03:45:57',
                'updated_at' => '2024-06-17 03:45:57',
            ],
            [
                'id' => 4,
                'embedding_id' => 2,
                'image_id' => 12,
                'weight' => 1.0,
                'prompt_target' => 'positive',
                'created_at' => '2024-06-17 04:21:33',
                'updated_at' => '2024-06-17 04:21:33',
            ],
        ]);
    }
}