<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* ROTTA UTENTI NON LOGGATI */
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

/* CREO GRUPPO DI ROTTE PER AUTENTICATI */
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function(){
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    
    /* CESTINO DELLE SKILLS */
    Route::get('/skills/trash', [SkillController::class, 'trash'])->name('skills.trash');

    /* RIPRISTINA SKILL */
    Route::patch('/skills/{skill}/restore', [SkillController::class, 'restore'])->name('skills.restore');
    
    /* CESTINO DELLE PROGETTI */
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');

    /* RIPRISTINA PROGETTO */
    Route::patch('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');

    /* OPERAZIONI CRUD */
    Route::resource('/skills', SkillController::class);
    Route::resource('/projects', ProjectController::class);

});

/* ROTTE PROFILO ADMIN */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';