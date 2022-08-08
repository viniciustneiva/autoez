<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        DB::table('marca')->insert([
            ['name' => 'Fiat', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Chevrolet', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Ford', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Volkswagen', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Renault', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Peugeot', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Citröen', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'BMW', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Audi', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Mercedes', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Nissan', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Toyota', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Suzuki', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Mitsubishi', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Honda', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Volvo', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Hyundai', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Jeep', 'taxa' => $faker->randomFloat('3',0,0.1)],
            ['name' => 'Kia', 'taxa' => $faker->randomFloat('3',0,0.1)],
        ]);
    }
}
