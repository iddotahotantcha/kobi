@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <!-- Logo/Titre -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">
                            <i class="bi bi-mortarboard-fill"></i> KOBI School
                        </h2>
                        <p class="text-muted">Système de gestion des élèves</p>
                    </div>

                    <!-- Messages d'erreur -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Message de succès -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Formulaire de connexion -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="login" class="form-label">Email ou Nom d'utilisateur</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control @error('login') is-invalid @enderror" 
                                       id="login" name="login" value="{{ old('login') }}"
                                       placeholder="Votre email ou nom d'utilisateur" required autofocus>
                            </div>
                            @error('login')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password"
                                       placeholder="Votre mot de passe" required>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Se connecter
                            </button>
                        </div>
                        <div class="text-center mt-3">
    <small class="text-muted">
        Première connexion ? 
        <a href="{{ route('register') }}" class="text-decoration-none">Créer un compte directeur</a>
    </small>
</div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none small">Mot de passe oublié ?</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3 text-muted small">
                © 2024 KOBI School - Tous droits réservés
            </div>
        </div>
    </div>
</div>
@endsection