<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Afficher la page de connexion
    public function showLoginForm()
    {
        return view('login');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Veuillez entrer votre email ou nom d\'utilisateur',
            'password.required' => 'Veuillez entrer votre mot de passe',
        ]);

        // Déterminer si c'est un email ou un username
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $request->login,
            'password' => $request->password,
        ];

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Vérifier si le compte est actif
            if (!Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'login' => 'Votre compte est désactivé. Contactez l\'administration.',
                ]);
            }

            // Rediriger selon le rôle
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/teacher/dashboard');
            }
        }

        return back()->withErrors([
            'login' => 'Identifiants incorrects.',
        ])->onlyInput('login');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}