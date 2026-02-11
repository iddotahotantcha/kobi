@extends('layouts.app')

@section('title', 'Gestion des Classes')

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
                        <a class="nav-link active" href="{{ route('classes.index') }}">
                            <i class="bi bi-building"></i> Classes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('matieres.index') }}">
                            <i class="bi bi-book"></i> Matières
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-file-earmark-text"></i> Rapports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
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
                        <h2 class="mb-0"><i class="bi bi-building"></i> Gestion des Classes</h2>
                        <p class="text-muted">Liste de toutes les classes de l'école</p>
                    </div>
                    <div>
                        <a href="{{ route('classes.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Créer une classe
                        </a>
                    </div>
                </div>

                <!-- Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Statistiques rapides -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h3 class="text-primary mb-0">{{ $classes->total() }}</h3>
                                <small class="text-muted">Total Classes</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <h3 class="text-success mb-0">{{ $classes->sum('effectif') }}</h3>
                                <small class="text-muted">Total Élèves</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h3 class="text-warning mb-0">{{ $classes->sum('capacite') }}</h3>
                                <small class="text-muted">Capacité Totale</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grille des classes -->
                <div class="row g-4">
                    @forelse($classes as $classe)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="bi bi-building"></i> {{ $classe->nom }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-2">
                                        <strong><i class="bi bi-graph-up"></i> Niveau :</strong> 
                                        <span class="badge bg-info">{{ $classe->niveau }}</span>
                                    </p>
                                    <p class="mb-2">
                                        <strong><i class="bi bi-door-open"></i> Salle :</strong> 
                                        {{ $classe->salle }}
                                    </p>
                                    <p class="mb-2">
                                        <strong><i class="bi bi-people"></i> Effectif :</strong> 
                                        {{ $classe->effectif }} / {{ $classe->capacite }}
                                    </p>
                                    <div class="progress mb-2" style="height: 20px;">
                                        @php
                                            $percentage = $classe->capacite > 0 ? ($classe->effectif / $classe->capacite) * 100 : 0;
                                            $color = $percentage < 50 ? 'bg-success' : ($percentage < 80 ? 'bg-warning' : 'bg-danger');
                                        @endphp
                                        <div class="progress-bar {{ $color }}" role="progressbar" 
                                             style="width: {{ $percentage }}%">
                                            {{ round($percentage) }}%
                                        </div>
                                    </div>
                                    <p class="mb-2">
                                        <strong><i class="bi bi-person-badge"></i> Enseignants :</strong> 
                                        <span class="badge bg-secondary">{{ $classe->teachers_count }}</span>
                                    </p>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('classes.show', $classe) }}" class="btn btn-sm btn-outline-primary flex-fill">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                        <a href="{{ route('classes.edit', $classe) }}" class="btn btn-sm btn-outline-warning flex-fill">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </a>
                                        <form action="{{ route('classes.destroy', $classe) }}" method="POST" class="flex-fill" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted mt-3">Aucune classe créée</p>
                                    <a href="{{ route('classes.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Créer la première classe
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($classes->hasPages())
                    <div class="mt-4">
                        {{ $classes->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection