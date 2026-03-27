<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;
class EtudiantApiController extends Controller
{
    // 🔹 Liste étudiants
    public function index()
    {
        $etudiants = Etudiant::all();
        return response()->json($etudiants);
    }
    // 🔹 Voir un étudiant
    public function show($id)
    {
        $etudiant = Etudiant::find($id);
        if (!$etudiant) {
            return response()->json(['message' => 'Etudiant non trouvé'], 404);
        }
        return response()->json($etudiant);
    }
    public function showApp($numero_apogee)
    {
        $etudiant = \App\Models\Etudiant::where('numero_apogee', $numero_apogee)->first();
        if (!$etudiant) {
            return response()->json([
                "message" => "Etudiant non trouvé"
            ],404);
        }
        return response()->json($etudiant);
    }
}