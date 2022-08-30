<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Aluguel;
use App\Models\Veiculo;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TipoFuncionarioSeeder::class,
            UserSeeder::class,
            MarcaSeeder::class,
            EstadosSeeder::class,
        ]);

        User::factory()->count(1)->create();
        Cliente::factory()->count(1)->create();
        Veiculo::factory()->count(1)->create();
        Aluguel::factory()->count(1)->create();
    }
}
