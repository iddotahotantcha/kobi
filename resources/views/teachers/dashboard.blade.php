@extends('layouts.app')

@section('title', 'Dashboard Enseignant')

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
                        <i class="bi bi-person-circle"></i> Prof. Dupont (Enseignant)
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
                        <a class="nav-link" href="{{ route('students.index') }}">
                            <i class="bi bi-people"></i> Mes Élèves
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classes.index') }}">
                            <i class="bi bi-building"></i> Ma Classe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person"></i> Mon Profil
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
                        <h2 class="mb-0">Dashboard Enseignant</h2>
<p class="text-muted">
    Bienvenue, {{ $teacher->full_name ?? 'Enseignant' }}
    @if($classInfo)
        - Classe: {{ $classInfo->nom }}
    @else
        - <span class="text-warning">Aucune classe assignée</span>
    @endif
</p>                    </div>
                    <div>
                        <span class="text-muted"><i class="bi bi-calendar"></i> {{ date('d/m/Y') }}</span>
                    </div>
                </div>

                <!-- Statistiques Cards -->
                <div class="row g-4 mb-4">
                    <!-- Mes Élèves -->
<div class="col-md-4">
    <div class="card text-white bg-primary">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Mes Élèves</h6>
                    <h2 class="mt-2 mb-0">{{ $totalStudents }}</h2>
                    @if($classInfo)
                        <small>Classe {{ $classInfo->nom }}</small>
                    @endif
                </div>
                <div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Présents aujourd'hui -->
<div class="col-md-4">
    <div class="card text-white bg-success">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Présents</h6>
                    <h2 class="mt-2 mb-0">{{ $presentToday }}</h2>
                    <small>Aujourd'hui</small>
                </div>
                <div>
                    <i class="bi bi-check-circle fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Absents aujourd'hui -->
<div class="col-md-4">
    <div class="card text-white bg-danger">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Absents</h6>
                    <h2 class="mt-2 mb-0">{{ $absentToday }}</h2>
                    <small>Aujourd'hui</small>
                </div>
                <div>
                    <i class="bi bi-x-circle fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>

                <!-- Actions rapides et Liste des élèves récents -->
                <div class="row g-4">
                    <!-- Actions rapides -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-lightning"></i> Actions rapides</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
    @if($classInfo)
        <a href="{{ route('students.create') }}" class="btn btn-primary text-start">
            <i class="bi bi-person-plus"></i> Ajouter un élève
        </a>
        <a href="{{ route('students.index') }}" class="btn btn-outline-primary text-start">
            <i class="bi bi-eye"></i> Voir tous les élèves
        </a>
    @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i>
            Aucune classe assignée. Contactez l'administration.
        </div>
    @endif
    <button class="btn btn-outline-success text-start" disabled>
        <i class="bi bi-check2-square"></i> Prendre les présences
    </button>
</div>
                            </div>
                        </div>

                        <!-- Info classe -->
                        <div class="card mt-3">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Ma Classe</h5>
                            </div>
                            <div class="card-body">
                                @if($classInfo)
    <p class="mb-2"><strong>Classe:</strong> {{ $classInfo->nom }}</p>
    <p class="mb-2"><strong>Niveau:</strong> {{ $classInfo->niveau }}</p>
    <p class="mb-2"><strong>Effectif:</strong> {{ $totalStudents }} / {{ $classInfo->capacite }} élèves</p>
    <p class="mb-0"><strong>Salle:</strong> {{ $classInfo->salle }}</p>
@else
    <p class="text-muted">Aucune classe assignée</p>
@endif
                            </div>
                        </div>
                    </div>

                    <!-- Liste des élèves récents -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-people"></i> Élèves récemment ajoutés</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">Voir tout</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Photo</th>
                                                <th>Nom complet</th>
                                                <th>Matricule</th>
                                                <th>Date d'ajout</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    @forelse($recentStudents as $student)
        <tr>
            <td>
                @if($student->photo)
                    <img src="{{ asset('storage/' . $student->photo) }}" 
                         alt="Photo" class="rounded-circle" width="40" height="40">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->full_name) }}&background=random" 
                         alt="Photo" class="rounded-circle" width="40" height="40">
                @endif
            </td>
            <td>{{ $student->full_name }}</td>
            <td><span class="badge bg-secondary">{{ $student->matricule }}</span></td>
            <td>{{ $student->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center py-4">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <p class="text-muted mt-2">Aucun élève dans votre classe</p>
            </td>
        </tr>
    @endforelse
</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection