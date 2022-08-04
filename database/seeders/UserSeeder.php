<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'teste@autoez.com.br',
            'cpf' => '78042654090',
            'password' => bcrypt('12345678'),
            'tipo' => 1,
            'rua' => 'Avenida Principal',
            'numero' => '1523',
            'complemento' => 'Bloco 7',
            'bairro' => 'Centro',
            'cidade' => 'Lavras',
            'estado' => 'MG',
            'cep' => '37202870',
            'data_nascimento' => '1999-10-14',
            'telefone' => "35987654321",
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
