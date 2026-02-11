<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // Afficher la liste des élèves
    public function index(Request $request)
{
    $query = Student::with('classe');

    // Filtres de recherche
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%")
              ->orWhere('matricule', 'like', "%{$search}%");
        });
    }

    if ($request->filled('classe')) {
        $query->whereHas('classe', function($q) use ($request) {
            $q->where('niveau', $request->classe);
        });
    }

    if ($request->filled('genre')) {
        $query->where('genre', $request->genre);
    }

    $students = $query->latest()->paginate(10);

    // Statistiques
    $totalStudents = Student::count();
    $totalBoys = Student::where('genre', 'M')->count();
    $totalGirls = Student::where('genre', 'F')->count();
    $totalClasses = Classe::count();

    return view('students.index', compact('students', 'totalStudents', 'totalBoys', 'totalGirls', 'totalClasses'));
}

    // Afficher le formulaire de création
    public function create()
    {
        $classes = Classe::all();
        return view('students.create', compact('classes'));
    }

    // Enregistrer un nouvel élève
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricule' => 'required|unique:students',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'genre' => 'required|in:M,F',
            'nationalite' => 'required|string|max:255',
            'adresse' => 'required|string',
            'classe_id' => 'required|exists:classes,id',
            'date_inscription' => 'required|date',
            'annee_scolaire' => 'required|string',
            'nom_parent' => 'required|string|max:255',
            'lien_parente' => 'required|string',
            'telephone_parent' => 'required|string',
            'email_parent' => 'nullable|email',
            'profession_parent' => 'nullable|string',
            'groupe_sanguin' => 'nullable|string',
            'allergies' => 'nullable|string',
            'observations' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload de la photo
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($validated);

        // Incrémenter l'effectif de la classe
        $classe = Classe::find($request->classe_id);
        $classe->increment('effectif');

        return redirect()->route('students.index')->with('success', 'Élève ajouté avec succès !');
    }

    // Afficher un élève
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Afficher le formulaire de modification
    public function edit(Student $student)
    {
        $classes = Classe::all();
        return view('students.edit', compact('student', 'classes'));
    }

    // Mettre à jour un élève
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'matricule' => 'required|unique:students,matricule,' . $student->id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'genre' => 'required|in:M,F',
            'nationalite' => 'required|string|max:255',
            'adresse' => 'required|string',
            'classe_id' => 'required|exists:classes,id',
            'date_inscription' => 'required|date',
            'annee_scolaire' => 'required|string',
            'nom_parent' => 'required|string|max:255',
            'lien_parente' => 'required|string',
            'telephone_parent' => 'required|string',
            'email_parent' => 'nullable|email',
            'profession_parent' => 'nullable|string',
            'groupe_sanguin' => 'nullable|string',
            'allergies' => 'nullable|string',
            'observations' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload de la nouvelle photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $validated['photo'] = $request->file('photo')->store('students', 'public');
        }

        // Gérer le changement de classe
        if ($student->classe_id != $request->classe_id) {
            // Décrémenter l'ancienne classe
            Classe::find($student->classe_id)->decrement('effectif');
            // Incrémenter la nouvelle classe
            Classe::find($request->classe_id)->increment('effectif');
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Élève modifié avec succès !');
    }

    // Supprimer un élève
    public function destroy(Student $student)
    {
        // Supprimer la photo
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        // Décrémenter l'effectif de la classe
        $student->classe->decrement('effectif');

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Élève supprimé avec succès !');
    }
}