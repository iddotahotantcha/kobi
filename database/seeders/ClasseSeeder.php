<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classe;

class ClasseSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['nom' => 'CP1-A', 'niveau' => 'CP1', 'salle' => 'Bâtiment A - Salle 1', 'capacite' => 30],
            ['nom' => 'CP1-B', 'niveau' => 'CP1', 'salle' => 'Bâtiment A - Salle 2', 'capacite' => 30],
            ['nom' => 'CP2-A', 'niveau' => 'CP2', 'salle' => 'Bâtiment A - Salle 3', 'capacite' => 30],
            ['nom' => 'CP2-B', 'niveau' => 'CP2', 'salle' => 'Bâtiment A - Salle 4', 'capacite' => 30],
            ['nom' => 'CE1-A', 'niveau' => 'CE1', 'salle' => 'Bâtiment B - Salle 5', 'capacite' => 30],
            ['nom' => 'CE1-B', 'niveau' => 'CE1', 'salle' => 'Bâtiment B - Salle 6', 'capacite' => 30],
            ['nom' => 'CE2-A', 'niveau' => 'CE2', 'salle' => 'Bâtiment B - Salle 7', 'capacite' => 30],
            ['nom' => 'CE2-B', 'niveau' => 'CE2', 'salle' => 'Bâtiment B - Salle 8', 'capacite' => 30],
            ['nom' => 'CM1-A', 'niveau' => 'CM1', 'salle' => 'Bâtiment C - Salle 9', 'capacite' => 30],
            ['nom' => 'CM1-B', 'niveau' => 'CM1', 'salle' => 'Bâtiment C - Salle 10', 'capacite' => 30],
            ['nom' => 'CM2-A', 'niveau' => 'CM2', 'salle' => 'Bâtiment C - Salle 11', 'capacite' => 30],
            ['nom' => 'CM2-B', 'niveau' => 'CM2', 'salle' => 'Bâtiment C - Salle 12', 'capacite' => 30],
        ];

        foreach ($classes as $classe) {
            Classe::create($classe);
        }
    }
}