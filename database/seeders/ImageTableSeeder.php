<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class ImageTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('image')->insert([
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/5347_9501947412_98a2c7d9ca_c_512_512_nofilter.jpg',
                'seed'           => 1234567,
                'positivePrompt' => 'cat, beautiful, cute.',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/65535_52856652098_92e0ee7cc2_c_512_512_nofilter.jpg',
                'seed'           => 123456,
                'positivePrompt' => 'plant, green',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/65535_52703934851_8c909d130a_c_512_512_nofilter.jpg',
                'seed'           => 1234567,
                'positivePrompt' => 'abstract, art.',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => Carbon::yesterday(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/3019_2668873606_e343579bcb_c_512_512_nofilter.jpg',
                'seed'           => 1234567,
                'positivePrompt' => 'cat, silly, cute.',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/65535_52900904214_0381a2a49b_z_512_512_nofilter.jpg',
                'seed'           => 123456,
                'positivePrompt' => 'two cats, flowers, white, blue eyes',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => Carbon::yesterday(),

            ],
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/65535_53052627466_c5e437b4ab_c_512_768_nofilter.jpg',
                'seed'           => 1234567,
                'positivePrompt' => 'bird',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/65535_52740248362_91bb36acce_h_512_768_nofilter.jpg',
                'seed'           => 123456,
                'positivePrompt' => 'sun, landscape',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => Carbon::yesterday(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'images/1_johndoe/65535_53535554439_e9b8c9af46_c_512_768_nofilter.jpg',
                'seed'           => 1234567,
                'positivePrompt' => 'abstract, interior',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'private_images/1_johndoe/65535_52940735624_4d0052fd1e_c_512_768_nofilter.jpg',
                'seed'           => 123456,
                'positivePrompt' => 'pengiun, ice, cold, cute',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => false,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 1,
                'path'           => 'private_images/1_johndoe/65535_53001912562_3decc04d9d_h_512_768_nofilter.jpg',
                'seed'           => 1234567,
                'positivePrompt' => 'heart, metalic, green',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => false,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 2,
                'path'           => 'images/2_janedoe/512x768.png',
                'seed'           => 1234567,
                'positivePrompt' => 'placeholder',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
            [
                'user_id'        => 2,
                'path'           => 'images/2_janedoe/512x512.png',
                'seed'           => 123456,
                'positivePrompt' => 'placeholder',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => Carbon::yesterday(),
            ],
            [
                'user_id'        => 2,
                'path'           => 'images/2_janedoe/65535_52640991406_8754d28c89_b_768_768_nofilter.jpg',
                'seed'           => 123456,
                'positivePrompt' => 'space, galaxy.',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => true,
                'style'          => 'realistic',
                'created_at'     => Carbon::yesterday(),
            ],
            [
                'user_id'        => 2,
                'path'           => 'private_images/2_janedoe/65535_52974542495_8e8301bae7_h_512_768_nofilter.jpg',
                'seed'           => 1234567,
                'positivePrompt' => 'conference, people.',
                'negativePrompt' => 'This is a negative prompt.',
                'public'         => false,
                'style'          => 'realistic',
                'created_at'     => now(),
            ],
        ]);
    }
}
