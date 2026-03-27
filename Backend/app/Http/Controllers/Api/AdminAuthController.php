<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class AdminAuthController extends Controller
{
    // 🔹 Login Admin
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $admin = User::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
        }
        return response()->json([
            'message' => 'Connexion réussie',
            'admin' => $admin
        ]);
    }
    // 🔹 Dashboard
    public function dashboard()
    {
        $totalEtudiants = \App\Models\Etudiant::count();
        $totalDemandes = \App\Models\Demande::count();
        return response()->json([
            'total_etudiants' => $totalEtudiants,
            'total_demandes' => $totalDemandes
        ]);
    }
}