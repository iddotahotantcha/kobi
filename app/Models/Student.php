<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'genre',
        'nationalite',
        'adresse',
        'photo',
        'classe_id',
        'date_inscription',
        'annee_scolaire',
        'nom_parent',
        'lien_parente',
        'telephone_parent',
        'email_parent',
        'profession_parent',
        'groupe_sanguin',
        'allergies',
        'observations',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_inscription' => 'date',
    ];

    // Un élève appartient à une classe
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    // Méthode pour obtenir le nom complet
    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }
}