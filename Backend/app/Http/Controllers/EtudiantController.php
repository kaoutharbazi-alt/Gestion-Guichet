<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Etudiant;
class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return $etudiants;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    Etudiant::create([
        'numero_apogee' => $request->numero_apogee,
        'cne' => $request->cne,
        'cni' => $request->cni,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'date_naissance' => $request->date_naissance,
        'lieu_naissance' => $request->lieu_naissance,
        'filiere' => $request->filiere,
        'cycle' => $request->cycle,
        'niveau' => $request->niveau,
    ]);
    return "Etudiant ajouté";
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}