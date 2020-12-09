<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'login' => Str::random(10),
            'name' => Str::random(10),
            'surname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'address' => Str::random(10),
        ]);
    }
}
