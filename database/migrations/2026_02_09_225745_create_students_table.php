<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique(); // Ex: KOB-2024-001
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->enum('genre', ['M', 'F']);
            $table->string('nationalite');
            $table->text('adresse');
            $table->string('photo')->nullable();
            
            // Informations scolaires
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->date('date_inscription');
            $table->string('annee_scolaire'); // Ex: 2024-2025
            
            // Informations du parent/tuteur
            $table->string('nom_parent');
            $table->string('lien_parente'); // Pere, Mere, Tuteur, Autre
            $table->string('telephone_parent');
            $table->string('email_parent')->nullable();
            $table->string('profession_parent')->nullable();
            
            // Informations médicales
            $table->string('groupe_sanguin')->nullable();
            $table->text('allergies')->nullable();
            $table->text('observations')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};