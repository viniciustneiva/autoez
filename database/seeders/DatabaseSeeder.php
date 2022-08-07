<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);

        User::factory()->count(10)->create();
        Cliente::factory()->count(10)->create();

    }
}
