@extends('layouts.app')

@section('title', 'Dashboard Administrateur')

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
                        <i class="bi bi-person-circle"></i> Directeur (Admin)
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
</li>                    </ul>
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
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/students">
                            <i class="bi bi-people"></i> Élèves
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/teachers">
                            <i class="bi bi-person-badge"></i> Enseignants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/classes">
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-0">Dashboard</h2>
                        <p class="text-muted">Bienvenue, Directeur</p>
                    </div>
                    <div>
                        <span class="text-muted"><i class="bi bi-calendar"></i> {{ date('d/m/Y') }}</span>
                    </div>
                </div>

                <!-- Statistiques Cards -->
                <div class="row g-4 mb-4">
                    <!-- Total Élèves -->
<div class="col-md-3">
    <div class="card text-white bg-primary">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Total Élèves</h6>
                    <h2 class="mt-2 mb-0">{{ $totalStudents }}</h2>
                </div>
                <div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Total Enseignants -->
<div class="col-md-3">
    <div class="card text-white bg-success">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Enseignants</h6>
                    <h2 class="mt-2 mb-0">{{ $totalTeachers }}</h2>
                </div>
                <div>
                    <i class="bi bi-person-badge fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Total Classes -->
<div class="col-md-3">
    <div class="card text-white bg-warning">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Classes</h6>
                    <h2 class="mt-2 mb-0">{{ $totalClasses }}</h2>
                </div>
                <div>
                    <i class="bi bi-building fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Taux de présence -->
<div class="col-md-3">
    <div class="card text-white bg-info">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Présence</h6>
                    <h2 class="mt-2 mb-0">{{ $presenceRate }}%</h2>
                </div>
                <div>
                    <i class="bi bi-check-circle fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>

                <!-- Actions rapides et Activités récentes -->
                <div class="row g-4">
                    <!-- Actions rapides -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-lightning"></i> Actions rapides</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
    <a href="{{ route('students.create') }}" class="btn btn-outline-primary text-start">
        <i class="bi bi-person-plus"></i> Ajouter un élève
    </a>
    <a href="{{ route('teachers.create') }}" class="btn btn-outline-success text-start">
        <i class="bi bi-person-badge"></i> Ajouter un enseignant
    </a>
    <button class="btn btn-outline-warning text-start" disabled>
        <i class="bi bi-building"></i> Créer une classe
    </button>
    <button class="btn btn-outline-info text-start" disabled>
        <i class="bi bi-file-earmark-text"></i> Générer un rapport
    </button>
</div>
                            </div>
                        </div>
                    </div>

                    <!-- Activités récentes -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Activités récentes</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
    @forelse($recentActivities as $student)
        <li class="mb-3">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <span class="badge bg-success rounded-circle p-2">
                        <i class="bi bi-person-plus"></i>
                    </span>
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="mb-0">Nouvel élève : <strong>{{ $student->full_name }}</strong></p>
                    <small class="text-muted">{{ $student->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </li>
    @empty
        <li class="text-center text-muted">
            <i class="bi bi-inbox"></i>
            <p class="mb-0">Aucune activité récente</p>
        </li>
    @endforelse
</ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection