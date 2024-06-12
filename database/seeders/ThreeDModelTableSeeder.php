<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreeDModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('three_d_models')->insert([
            [
                'user_id' => 1,
                'name' => 'Banana chair',
                'description' => 'This is a 3D chair banana.',
                'path' => 'three_d_models/1_johndoe/zkACCAoP.obj',
                'thumbnail' => 'three_d_models/1_johndoe/zkACCAoP.png',
                'prompt' => 'a banana chair',
                'public' => true,
                'created_at' => now(),
            ],
        ]);
    }
}
