<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'description',
    ];

    // Une matière peut être enseignée par plusieurs enseignants
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    // Une matière peut être attribuée à plusieurs classes (avec coefficient)
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_matiere')
                    ->withPivot('coefficient')
                    ->withTimestamps();
    }
}