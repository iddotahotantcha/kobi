<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\MatiereController;

// Page d'accueil
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/teacher/dashboard');
        }
    }
    return redirect('/login');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes admin (avec middleware 'admin')
Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        $totalStudents = \App\Models\Student::count();
        $totalTeachers = \App\Models\Teacher::count();
        $totalClasses = \App\Models\Classe::count();
        
        // Calculer le taux de présence (simulation - 92% par défaut)
        $presenceRate = 92;
        
        // Activités récentes (derniers élèves ajoutés)
        $recentActivities = \App\Models\Student::latest()->take(3)->get();
        
        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalClasses',
            'presenceRate',
            'recentActivities'
        ));
    })->name('admin.dashboard');

    // Routes CRUD pour les élèves
    Route::resource('students', StudentController::class);

    // Routes CRUD pour les enseignants
    Route::resource('teachers', TeacherController::class);
    
    // Route pour renvoyer les identifiants
    Route::post('/teachers/{teacher}/resend-credentials', [TeacherController::class, 'resendCredentials'])
        ->name('teachers.resend-credentials');

    // Routes CRUD pour les classes
    Route::resource('classes', ClasseController::class)->parameter('classes', 'classe');

    // Routes CRUD pour les matières
    Route::resource('matieres', MatiereController::class);

    // Routes pour Rapports et Paramètres
Route::get('/reports', function () {
    return view('reports.index');
})->name('reports.index');

Route::get('/settings', function () {
    return view('settings.index');
})->name('settings.index');
});

// Routes enseignant
Route::middleware(['auth'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        if (!auth()->user()->isTeacher()) {
            abort(403, 'Accès non autorisé');
        }
        
        $teacher = auth()->user()->teacher;
        
        // Si l'enseignant a une classe assignée
        if ($teacher && $teacher->classe) {
            $totalStudents = $teacher->classe->students()->count();
            $recentStudents = $teacher->classe->students()->latest()->take(3)->get();
            $classInfo = $teacher->classe;
        } else {
            $totalStudents = 0;
            $recentStudents = collect();
            $classInfo = null;
        }
        
        // Simulation des présences
        $presentToday = (int)($totalStudents * 0.93); // 93% de présence
        $absentToday = $totalStudents - $presentToday;
        
        return view('teachers.dashboard', compact(
            'teacher',
            'totalStudents',
            'presentToday',
            'absentToday',
            'recentStudents',
            'classInfo'
        ));
    })->name('teacher.dashboard');
});