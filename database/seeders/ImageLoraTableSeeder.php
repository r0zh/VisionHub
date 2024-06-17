<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ImageLoraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_lora')->insert(
            array(
                [
                    'id' => 1,
                    'created_at' => '2024-06-17 03:38:46',
                    'updated_at' => '2024-06-17 03:38:46',
                    'lora_id' => 1,
                    'image_id' => 6,
                    'weight' => 1.0,
                ],
                [
                    'id' => 2,
                    'created_at' => '2024-06-17 04:21:33',
                    'updated_at' => '2024-06-17 04:21:33',
                    'lora_id' => 3,
                    'image_id' => 12,
                    'weight' => 1.0,
                ],
            )
        );


    }
}