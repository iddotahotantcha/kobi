<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'niveau',
        'salle',
        'capacite',
        'effectif',
    ];

    // Une classe a plusieurs élèves
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Une classe peut avoir un enseignant (ou plusieurs si vous voulez)
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    // Une classe a plusieurs matières (avec coefficient)
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'classe_matiere')
                    ->withPivot('coefficient')
                    ->withTimestamps();
    }
}