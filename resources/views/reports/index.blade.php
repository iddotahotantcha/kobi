@extends('layouts.app')

@section('title', 'Rapports')

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
    <a class="nav-link active" href="{{ route('reports.index') }}">
        <i class="bi bi-file-earmark-text"></i> Rapports
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('settings.index') }}">
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
                    <h2 class="mb-0"><i class="bi bi-file-earmark-text"></i> Rapports et Statistiques</h2>
                    <p class="text-muted">Génération de rapports pour l'école KOBI</p>
                </div>

                <!-- Statistiques générales -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body text-center">
                                <h2>{{ \App\Models\Student::count() }}</h2>
                                <p class="mb-0">Élèves</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success">
                            <div class="card-body text-center">
                                <h2>{{ \App\Models\Teacher::count() }}</h2>
                                <p class="mb-0">Enseignants</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body text-center">
                                <h2>{{ \App\Models\Classe::count() }}</h2>
                                <p class="mb-0">Classes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info">
                            <div class="card-body text-center">
                                <h2>{{ \App\Models\Matiere::count() }}</h2>
                                <p class="mb-0">Matières</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Types de rapports -->
                <div class="row g-4">
                    <!-- Rapport Élèves -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-people"></i> Rapports Élèves</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Générez des rapports détaillés sur les élèves</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary" disabled>
                                        <i class="bi bi-file-pdf"></i> Liste complète des élèves (PDF)
                                    </button>
                                    <button class="btn btn-outline-primary" disabled>
                                        <i class="bi bi-file-excel"></i> Export Excel
                                    </button>
                                    <button class="btn btn-outline-primary" disabled>
                                        <i class="bi bi-graph-up"></i> Statistiques par classe
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rapport Enseignants -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Rapports Enseignants</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Générez des rapports sur le personnel enseignant</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-success" disabled>
                                        <i class="bi bi-file-pdf"></i> Liste des enseignants (PDF)
                                    </button>
                                    <button class="btn btn-outline-success" disabled>
                                        <i class="bi bi-file-excel"></i> Export Excel
                                    </button>
                                    <button class="btn btn-outline-success" disabled>
                                        <i class="bi bi-graph-up"></i> Répartition par matière
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rapport Classes -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="bi bi-building"></i> Rapports Classes</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Rapports sur les classes et leur effectif</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-warning" disabled>
                                        <i class="bi bi-file-pdf"></i> État des classes (PDF)
                                    </button>
                                    <button class="btn btn-outline-warning" disabled>
                                        <i class="bi bi-graph-up"></i> Taux de remplissage
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rapport Général -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="bi bi-file-text"></i> Rapport Général</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Rapport complet de l'école</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-info" disabled>
                                        <i class="bi bi-file-pdf"></i> Rapport annuel (PDF)
                                    </button>
                                    <button class="btn btn-outline-info" disabled>
                                        <i class="bi bi-graph-up"></i> Statistiques globales
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4">
                    <i class="bi bi-info-circle"></i> 
                    <strong>Fonctionnalité en développement :</strong> 
                    Les rapports PDF et Excel seront disponibles dans une prochaine version.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection