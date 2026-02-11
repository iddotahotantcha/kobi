@extends('layouts.app')

@section('title', 'Paramètres')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="bi bi-mortarboard-fill"></i> KOBI School
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                       data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; cursor: pointer;">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0 sidebar">
            <div class="py-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('students.index') }}">
                            <i class="bi bi-people"></i> Élèves
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teachers.index') }}">
                            <i class="bi bi-person-badge"></i> Enseignants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classes.index') }}">
                            <i class="bi bi-building"></i> Classes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('matieres.index') }}">
                            <i class="bi bi-book"></i> Matières
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="{{ route('reports.index') }}">
        <i class="bi bi-file-earmark-text"></i> Rapports
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ route('settings.index') }}">
        <i class="bi bi-gear"></i> Paramètres
    </a>
</li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 px-md-4">
            <div class="py-4">
                <!-- Header -->
                <div class="mb-4">
                    <h2 class="mb-0"><i class="bi bi-gear"></i> Paramètres</h2>
                    <p class="text-muted">Configuration de l'application KOBI School</p>
                </div>

                <!-- Paramètres -->
                <div class="row g-4">
                    <!-- Informations de l'école -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-building"></i> Informations de l'école</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Nom de l'école</label>
                                        <input type="text" class="form-control" value="KOBI School" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Adresse</label>
                                        <input type="text" class="form-control" value="Cotonou, Bénin" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" value="+229 XX XX XX XX" disabled>
                                    </div>
                                    <button class="btn btn-primary" disabled>
                                        <i class="bi bi-save"></i> Enregistrer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Année scolaire -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="bi bi-calendar"></i> Année scolaire</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Année scolaire en cours</label>
                                        <select class="form-select" disabled>
                                            <option>2024-2025</option>
                                            <option>2025-2026</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Date de début</label>
                                        <input type="date" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Date de fin</label>
                                        <input type="date" class="form-control" disabled>
                                    </div>
                                    <button class="btn btn-success" disabled>
                                        <i class="bi bi-save"></i> Enregistrer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mon compte -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="bi bi-person"></i> Mon compte</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Nom :</strong> {{ auth()->user()->name }}</p>
                                <p><strong>Email :</strong> {{ auth()->user()->email }}</p>
                                <p><strong>Rôle :</strong> 
                                    <span class="badge bg-danger">Administrateur</span>
                                </p>
                                <hr>
                                <button class="btn btn-warning" disabled>
                                    <i class="bi bi-key"></i> Changer le mot de passe
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sauvegarde -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0"><i class="bi bi-database"></i> Sauvegarde</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Gérez les sauvegardes de la base de données</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-danger" disabled>
                                        <i class="bi bi-download"></i> Télécharger une sauvegarde
                                    </button>
                                    <button class="btn btn-outline-danger" disabled>
                                        <i class="bi bi-upload"></i> Restaurer une sauvegarde
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4">
                    <i class="bi bi-info-circle"></i> 
                    <strong>Fonctionnalité en développement :</strong> 
                    Les paramètres seront entièrement fonctionnels dans une prochaine version.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection