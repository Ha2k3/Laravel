<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => Str::random(10),
                'description' => "quản lí tất cả các sản phẩm",
            ],
            [
                'name' => Str::random(10),
                'description' => "test data"
            ]
        ]);
    }
}