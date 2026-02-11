<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec users
            $table->string('matricule')->unique(); // Ex: ENS-2024-001
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->enum('genre', ['M', 'F']);
            $table->string('nationalite');
            $table->string('telephone');
            $table->text('adresse');
            $table->string('photo')->nullable(); // Chemin de la photo
            
            // Informations professionnelles
            $table->string('diplome');
            $table->string('specialite');
            $table->integer('annees_experience')->nullable();
            $table->date('date_embauche');
            $table->enum('statut', ['actif', 'inactif', 'conge'])->default('actif');
            
            // Classe assignée
            $table->foreignId('classe_id')->nullable()->constrained('classes')->onDelete('set null');
            
            // Documents
            $table->string('cv')->nullable();
            $table->string('diplome_file')->nullable();
            $table->json('autres_documents')->nullable(); // Pour stocker plusieurs fichiers
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};