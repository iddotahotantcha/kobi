<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    // Afficher la liste des classes
    public function index()
    {
        $classes = Classe::withCount('students', 'teachers')->paginate(12);
        return view('classes.index', compact('classes'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('classes.create');
    }

    // Enregistrer une nouvelle classe
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:classes',
            'niveau' => 'required|string|max:255',
            'salle' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1|max:100',
        ]);

        $validated['effectif'] = 0;

        Classe::create($validated);

        return redirect()->route('classes.index')->with('success', 'Classe créée avec succès !');
    }

    // Afficher une classe
    public function show(Classe $classe)
    {
        $classe->load(['students', 'teachers', 'matieres']);
        return view('classes.show', compact('classe'));
    }

    // Afficher le formulaire de modification
    public function edit(Classe $classe)
    {
        return view('classes.edit', compact('classe'));
    }

    // Mettre à jour une classe
    public function update(Request $request, Classe $classe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:classes,nom,' . $classe->id,
            'niveau' => 'required|string|max:255',
            'salle' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1|max:100',
        ]);

        $classe->update($validated);

        return redirect()->route('classes.index')->with('success', 'Classe modifiée avec succès !');
    }

    // Supprimer une classe
    public function destroy(Classe $classe)
    {
        // Vérifier s'il y a des élèves dans cette classe
        if ($classe->students()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette classe car elle contient des élèves.');
        }

        $classe->delete();

        return redirect()->route('classes.index')->with('success', 'Classe supprimée avec succès !');
    }
}