<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        // Vérifier s'il existe déjà un administrateur
        $adminExists = User::where('role', 'admin')->exists();

        if ($adminExists) {
            return redirect('/login')->with('error', 'Un compte administrateur existe déjà.');
        }

        return view('auth.register');
    }

    // Enregistrer le compte directeur
    public function register(Request $request)
    {
        // Vérifier s'il existe déjà un administrateur
        $adminExists = User::where('role', 'admin')->exists();

        if ($adminExists) {
            return redirect('/login')->with('error', 'Un compte administrateur existe déjà.');
        }

        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Le nom complet est requis.',
            'email.required' => "L'email est requis.",
            'email.email' => "L'email doit être valide.",
            'email.unique' => 'Cet email est déjà utilisé.',
            'username.required' => "Le nom d'utilisateur est requis.",
            'username.unique' => "Ce nom d'utilisateur est déjà pris.",
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        // Créer le compte administrateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        // Connecter automatiquement l'utilisateur
        Auth::login($user);

        return redirect('/admin/dashboard')->with('success', 'Compte directeur créé avec succès !');
    }
}