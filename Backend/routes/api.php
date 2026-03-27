<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\DemandeApiController;
use App\Http\Controllers\Api\EtudiantApiController;
// 🔹 Login Admin
Route::post('/admin/login', [AdminAuthController::class, 'login']);
// Dashboard
Route::get('/dashboard', [AdminAuthController::class, 'dashboard']);
// Gestion des demandes
Route::get('/demandes', [DemandeApiController::class, 'index']);
//Route::put('/demandes/update-etat/{id}', [DemandeApiController::class, 'updateEtat']);
Route::put('/demandes/update-etat/{id}', [DemandeApiController::class, 'updateEtat']);
Route::get('/demandes/{id}', [DemandeApiController::class, 'show']);
Route::delete('/demandes/{id}', [DemandeApiController::class, 'destroy']);
Route::post('/demandes', [DemandeApiController::class, 'store']);
Route::put('/demandes/delivrer/{id}', [DemandeApiController::class,'delivrer']);
// Générer PDF
Route::get('/demandes/pdf/{id}', [DemandeApiController::class, 'generatePDF']);
// Gestion des étudiants
Route::get('/etudiants', [EtudiantApiController::class, 'index']);
Route::get('/etudiants/{numero_apogee}', [EtudiantApiController::class, 'showApp']);
Route::get('/etudiant/demandes/{numero_apogee}', [DemandeApiController::class, 'getDemandesEtudiant']);