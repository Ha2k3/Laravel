<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class categoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $fake = Faker::create();
        for ($i=0; $i < 100 ; $i++) { 
            DB::table('categories')->insert([
                'name' => $fake->name,
                'description' => $fake->text
            ]);
        }
    }
}