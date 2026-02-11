<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matricule',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'genre',
        'nationalite',
        'telephone',
        'adresse',
        'photo',
        'diplome',
        'matiere_id', // CHANGÉ : de 'specialite' à 'matiere_id'
        'annees_experience',
        'date_embauche',
        'statut',
        'classe_id',
        'cv',
        'diplome_file',
        'autres_documents',
    ];

    protected $casts = [
        'autres_documents' => 'array',
        'date_naissance' => 'date',
        'date_embauche' => 'date',
    ];

    // Un enseignant appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un enseignant peut être assigné à une classe
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    // Un enseignant enseigne une matière
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    // Méthode pour obtenir le nom complet
    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }
}