<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed akun admin dan operator.
     */
    public function run(): void
    {
        // Akun Admin
        User::create([
            'nama'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@boxplay.id',
            'password'  => Hash::make('password123'),
            'role'      => 'admin',
            'id_cabang' => null,
        ]);

        // Akun Operator contoh
        User::create([
            'nama'      => 'Operator Cabang 1',
            'username'  => 'operator1',
            'email'     => 'operator1@boxplay.id',
            'password'  => Hash::make('password123'),
            'role'      => 'operator',
            'id_cabang' => 1,
        ]);

        User::create([
            'nama'      => 'Operator Cabang 2',
            'username'  => 'operator2',
            'email'     => 'operator2@boxplay.id',
            'password'  => Hash::make('password123'),
            'role'      => 'operator',
            'id_cabang' => 2,
        ]);
    }
}
