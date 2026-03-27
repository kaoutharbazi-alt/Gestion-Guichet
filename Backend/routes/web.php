<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\DemandeController;
use App\Models\Etudiant;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('etudiants', EtudiantController::class);
Route::post('/demandes', [DemandeController::class,'store']);
Route::get('/demandes/{numero_apogee}', [DemandeController::class,'index']);
//Route::get('/demandes', [DemandeController::class, 'index']);
//Route::post('/demandes', [DemandeController::class, 'store']);
Route::get('/attestation/{id}', [DemandeController::class, 'generatePdf']);
//Route::get('/demandes/{apogee}', function($apogee){
    //$etudiant = Etudiant::where('numero_apogee',$apogee)->first();
    //return $etudiant->demandes;
//});
Route::get('/etudiant/{numero_apogee}', [EtudiantController::class,'getByApogee']);