<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;
use App\Models\Articles;


class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('articles')->insert([
            'name' => Str::random(25),
            'text' => Str::random(25),
            'created_by' => Str::random(25).'UserName',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
