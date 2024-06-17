<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'id' => 1,
                'name' => 'Drawing Lora',
                'fileName' => 'sp1tXLP.safetensors',
                'description' => 'Lora model trained on monochrome drawings.',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Monet Lora',
                'fileName' => 'm0n3tXLP.safetensors',
                'description' => 'Lora model trained on Monet paintings.',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'name' => 'Detail Tweaker',
                'fileName' => 'StS_detail_slider_v1.safetensors',
                'description' => 'Control how much detail one image will have',
                'created_at' => '2024-06-17 04:08:48',
                'updated_at' => '2024-06-17 04:08:48',
            ]


        ]);
    }
}
