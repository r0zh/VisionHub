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
                'resource_name' => 'Zavy Chroma XL',
                'resource_url' => 'https://civitai.com/models/119229/zavychromaxl',
                'resource_description' => 'Zavy Chroma XL is a general model.',
                'sender_id' => 1,
                'status' => 'pending',
                'resolved_by' => null,
            ],

        ]);
    }
}