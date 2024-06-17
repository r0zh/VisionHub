<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resource_requests')->insert([
            [
                'request_type' => 'checkpoint',
                'resolved_by' => null,
                'resource_description' => 'Zavy Chroma XL is a general model.',
                'resource_name' => 'Zavy Chroma XL',
                'resource_url' => 'https://civitai.com/models/119229/zavychromaxl',
                'sender_id' => 1,
                'status' => 'pending',
                'created_at' => '2024-06-17 03:13:38',
                'updated_at' => '2024-06-17 03:13:38',
            ],
            [
                'request_type' => 'lora',
                'resolved_by' => 2,
                'resource_description' => 'Lora to tweak how much detail there is in an image',
                'resource_name' => 'Detail Tweaker',
                'resource_url' => 'https://civitai.com/models/122359/detail-tweaker-xl',
                'sender_id' => 1,
                'status' => 'approved',
                'created_at' => '2024-06-17 04:01:43',
                'updated_at' => '2024-06-17 04:05:41',
            ]
        ]);
    }
}