<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('users')->insert([[
            'role_id'  => 1,
            'name'     => 'John Doe',
            'email'    => 'johndoe@gmail.com',
            'password' => bcrypt('password'),
        ], [
            'role_id'  => 2,
            'name'     => 'Jane Doe',
            'email'    => 'janedoe@gmail.com',
            'password' => bcrypt('password'),
        ], [
            'role_id'  => 3,
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]
        ]);
    }
}
