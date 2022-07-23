<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TipoFuncionarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_funcionario')->insert([
            ['name' => 'Gerente'],
            ['name' => 'Funcionario']
        ]);
    }
}
