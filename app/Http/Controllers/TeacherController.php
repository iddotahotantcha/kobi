<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    // Afficher la liste des enseignants
    public function index(Request $request)
{
    $query = Teacher::with(['user', 'classe', 'matiere']);

    // Filtres de recherche
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%")
              ->orWhere('telephone', 'like', "%{$search}%")
              ->orWhere('matricule', 'like', "%{$search}%")
              ->orWhereHas('user', function($q2) use ($search) {
                  $q2->where('email', 'like', "%{$search}%");
              });
        });
    }

    if ($request->filled('classe')) {
        $query->whereHas('classe', function($q) use ($request) {
            $q->where('niveau', $request->classe);
        });
    }

    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }

    $teachers = $query->latest()->paginate(10);

    // Statistiques
    $totalTeachers = Teacher::count();
    $activeTeachers = Teacher::where('statut', 'actif')->count();
    $assignedClasses = Teacher::whereNotNull('classe_id')->distinct('classe_id')->count();
    $unassignedTeachers = Teacher::whereNull('classe_id')->count();

    return view('teachers.index', compact('teachers', 'totalTeachers', 'activeTeachers', 'assignedClasses', 'unassignedTeachers'));
}

    // Afficher le formulaire de création
    public function create()
{
    $classes = Classe::all();
    $matieres = \App\Models\Matiere::all();
    return view('teachers.create', compact('classes', 'matieres'));
}

    // Enregistrer un nouvel enseignant
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricule' => 'required|unique:teachers',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'genre' => 'required|in:M,F',
            'nationalite' => 'required|string|max:255',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'adresse' => 'required|string',
            'diplome' => 'required|string',
            'matiere_id' => 'required|exists:matieres,id',
            'annees_experience' => 'nullable|integer',
            'date_embauche' => 'required|date',
            'statut' => 'required|in:actif,inactif,conge',
            'classe_id' => 'nullable|exists:classes,id',
            'role' => 'required|in:admin,editeur',
            'username' => 'required|string|unique:users,username',
            'password_temp' => 'required|string|min:8',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|mimes:pdf|max:5120',
            'diplome_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'autres_docs' => 'nullable',
        ]);

        // 1. Créer l'utilisateur
        $user = User::create([
            'name' => $validated['prenom'] . ' ' . $validated['nom'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password_temp']),
            'role' => $validated['role'],
            'is_active' => true,
            'must_change_password' => true,
        ]);

        // 2. Upload de la photo
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        // 3. Upload du CV
        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('teachers/cv', 'public');
        }

        // 4. Upload du diplôme
        if ($request->hasFile('diplome_file')) {
            $validated['diplome_file'] = $request->file('diplome_file')->store('teachers/diplomes', 'public');
        }

        // 5. Upload des autres documents
        if ($request->hasFile('autres_docs')) {
            $autresDocs = [];
            foreach ($request->file('autres_docs') as $doc) {
                $autresDocs[] = $doc->store('teachers/docs', 'public');
            }
            $validated['autres_documents'] = $autresDocs;
        }

        // 6. Créer le profil enseignant
        $validated['user_id'] = $user->id;
        $teacher = Teacher::create($validated);

        // 7. Envoyer l'email avec les identifiants (simulation pour l'instant)
        // TODO: Implémenter l'envoi d'email réel
        
        return redirect()->route('teachers.index')->with('success', 'Enseignant ajouté avec succès ! Email envoyé avec les identifiants.');
    }

    // Afficher un enseignant
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    // Afficher le formulaire de modification
    public function edit(Teacher $teacher)
{
    $classes = Classe::all();
    $matieres = \App\Models\Matiere::all();
    return view('teachers.edit', compact('teacher', 'classes', 'matieres'));
}

    // Mettre à jour un enseignant
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'matricule' => 'required|unique:teachers,matricule,' . $teacher->id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'genre' => 'required|in:M,F',
            'nationalite' => 'required|string|max:255',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'adresse' => 'required|string',
            'diplome' => 'required|string',
            'matiere_id' => 'required|exists:matieres,id',
            'annees_experience' => 'nullable|integer',
            'date_embauche' => 'required|date',
            'statut' => 'required|in:actif,inactif,conge',
            'classe_id' => 'nullable|exists:classes,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|mimes:pdf|max:5120',
            'diplome_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Upload de la nouvelle photo
        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        // Upload du nouveau CV
        if ($request->hasFile('cv')) {
            if ($teacher->cv) {
                Storage::disk('public')->delete($teacher->cv);
            }
            $validated['cv'] = $request->file('cv')->store('teachers/cv', 'public');
        }

        // Upload du nouveau diplôme
        if ($request->hasFile('diplome_file')) {
            if ($teacher->diplome_file) {
                Storage::disk('public')->delete($teacher->diplome_file);
            }
            $validated['diplome_file'] = $request->file('diplome_file')->store('teachers/diplomes', 'public');
        }

        $teacher->update($validated);

        // Mettre à jour l'utilisateur associé
        $teacher->user->update([
            'name' => $validated['prenom'] . ' ' . $validated['nom'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('teachers.index')->with('success', 'Enseignant modifié avec succès !');
    }

    // Supprimer un enseignant
    public function destroy(Teacher $teacher)
    {
        // Supprimer les fichiers
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }
        if ($teacher->cv) {
            Storage::disk('public')->delete($teacher->cv);
        }
        if ($teacher->diplome_file) {
            Storage::disk('public')->delete($teacher->diplome_file);
        }
        if ($teacher->autres_documents) {
            foreach ($teacher->autres_documents as $doc) {
                Storage::disk('public')->delete($doc);
            }
        }

        // Supprimer l'utilisateur (cascade supprimera l'enseignant)
        $teacher->user->delete();

        return redirect()->route('teachers.index')->with('success', 'Enseignant supprimé avec succès !');
    }

    // Renvoyer les identifiants par email
    public function resendCredentials(Teacher $teacher)
    {
        // TODO: Implémenter l'envoi d'email
        return back()->with('success', 'Email envoyé avec succès à ' . $teacher->user->email);
    }
}