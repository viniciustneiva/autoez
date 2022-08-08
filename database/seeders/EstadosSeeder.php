<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        DB::table('estados')->insert([
            ['name' => 'AC'],
            ['name' => 'AL'],
            ['name' => 'AP'],
            ['name' => 'AM'],
            ['name' => 'BA'],
            ['name' => 'CE'],
            ['name' => 'DF'],
            ['name' => 'ES'],
            ['name' => 'GO'],
            ['name' => 'MA'],
            ['name' => 'MT'],
            ['name' => 'MS'],
            ['name' => 'MG'],
            ['name' => 'PA'],
            ['name' => 'PB'],
            ['name' => 'PR'],
            ['name' => 'PE'],
            ['name' => 'PI'],
            ['name' => 'RJ'],
            ['name' => 'RN'],
            ['name' => 'RS'],
            ['name' => 'RO'],
            ['name' => 'RR'],
            ['name' => 'SC'],
            ['name' => 'SP'],
            ['name' => 'SE'],
            ['name' => 'TO'],
        ]);
    }
}
