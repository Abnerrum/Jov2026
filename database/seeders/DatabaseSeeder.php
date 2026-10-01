<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Usuario::firstOrCreate(
            ['email' => 'demo@jovify.com'],
            [
                'nomeCompleto' => 'Usuário Demo',
                'cpf' => '00000000000',
                'password' => Hash::make('demo1234'),
            ]
        );
    }
}
