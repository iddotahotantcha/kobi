<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Ex: CM2-A
            $table->string('niveau'); // Ex: CM2
            $table->string('salle')->nullable(); // Ex: Bâtiment B - Salle 12
            $table->integer('capacite')->default(30); // Nombre maximum d'élèves
            $table->integer('effectif')->default(0); // Nombre actuel d'élèves
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};