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
        DB::table('marca')->insert([
            ['name' => 'Fiat'],
            ['name' => 'Chevrolet'],
            ['name' => 'Ford'],
            ['name' => 'Volkswagen'],
            ['name' => 'Renault'],
            ['name' => 'Peugeot'],
            ['name' => 'Citröen'],
            ['name' => 'BMW'],
            ['name' => 'Audi'],
            ['name' => 'Mercedes'],
            ['name' => 'Nissan'],
            ['name' => 'Toyota'],
            ['name' => 'Suzuki'],
            ['name' => 'Mitsubishi'],
            ['name' => 'Honda'],
            ['name' => 'Volvo'],
            ['name' => 'Hyundai'],
            ['name' => 'Jeep'],
            ['name' => 'Kia'],
        ]);
    }
}
