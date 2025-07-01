<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\ContractorDashboardController;
use App\Http\Controllers\OwnerProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequirementController;

Route::get('/', function () {
    return view('home');
});


// Show forms
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle forms
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('owner')->middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
    Route::get('/projects', [ProjectController::class, 'showAll'])->name('projects');
    Route::get('/add-project', [ProjectController::class, 'index'])->name('add-project');
    Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('edit-project');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('update-project');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('delete-project');
    Route::get('/help', [OwnerDashboardController::class, 'help'])->name('help');
    Route::post('/profile-update', [OwnerDashboardController::class, 'updateProfile'])->name('profile.update');
});


Route::prefix('contractor')->middleware(['auth', 'role:Contractor'])->group(function () {
    Route::get('/dashboard', [ContractorDashboardController::class, 'index'])->name('contractor.dashboard');
    Route::get('/requirements', [RequirementController::class, 'index'])->name('contractor.requirements');
    Route::get('/requirements/{project}', [RequirementController::class, 'show'])->name('contractor.requirements.show');
    Route::post('/requirements/{project}/apply', [RequirementController::class, 'apply'])->name('contractor.requirements.apply');
    Route::get('/mywork', [ContractorDashboardController::class, 'myWork'])->name('contractor.mywork');
    Route::get('/notifications', [ContractorDashboardController::class, 'notifications'])->name('contractor.notifications');
    Route::get('/help', [ContractorDashboardController::class, 'help'])->name('contractor.help');
    Route::get('/settings', [ContractorDashboardController::class, 'settings'])->name('contractor.settings');
});

