<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Directeur KOBI',
            'email' => 'directeur@kobi.school',
            'username' => 'directeur',
            'password' => Hash::make('password123'), // Mot de passe par défaut
            'role' => 'admin',
            'is_active' => true,
            'must_change_password' => false,
            'email_verified_at' => now(),
        ]);
    }
}