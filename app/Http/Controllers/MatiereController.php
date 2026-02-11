<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    // Afficher la liste des matières
    public function index()
    {
        $matieres = Matiere::withCount('teachers', 'classes')->paginate(15);
        return view('matieres.index', compact('matieres'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('matieres.create');
    }

    // Enregistrer une nouvelle matière
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:matieres',
            'code' => 'required|string|max:10|unique:matieres',
            'description' => 'nullable|string',
        ]);

        Matiere::create($validated);

        return redirect()->route('matieres.index')->with('success', 'Matière créée avec succès !');
    }

    // Afficher une matière
    public function show(Matiere $matiere)
    {
        $matiere->load(['teachers', 'classes']);
        return view('matieres.show', compact('matiere'));
    }

    // Afficher le formulaire de modification
    public function edit(Matiere $matiere)
    {
        return view('matieres.edit', compact('matiere'));
    }

    // Mettre à jour une matière
    public function update(Request $request, Matiere $matiere)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:matieres,nom,' . $matiere->id,
            'code' => 'required|string|max:10|unique:matieres,code,' . $matiere->id,
            'description' => 'nullable|string',
        ]);

        $matiere->update($validated);

        return redirect()->route('matieres.index')->with('success', 'Matière modifiée avec succès !');
    }

    // Supprimer une matière
    public function destroy(Matiere $matiere)
    {
        // Vérifier s'il y a des enseignants qui enseignent cette matière
        if ($matiere->teachers()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette matière car elle est assignée à des enseignants.');
        }

        $matiere->delete();

        return redirect()->route('matieres.index')->with('success', 'Matière supprimée avec succès !');
    }
}