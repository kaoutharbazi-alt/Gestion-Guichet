<?php
namespace App\Http\Controllers;
use App\Models\Demande;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Etudiant;
class DemandeController extends Controller
{
    public function index($apogee)
    {
        //return Demande::with('etudiant')->get();
        $demandes = Demande::where('numero_apogee',$apogee)->get();

        return response()->json($demandes);
    }
    //public function store(Request $request)
    //{
       // $etudiant = Etudiant::where('numero_apogee',$request->numero_apogee)->first();
        //Demande::create([
           // 'etudiant_id'=>$etudiant->id,
            //'type_document'=>$request->type_document,
            //'etat'=>'En cours de traitement'
        //]);
        //return response()->json(["message"=>"Demande créée"]);
    //}
    public function store(Request $request)
{
    $demande = Demande::create([
        'numero_apogee' => $request->numero_apogee,
        'type_document' => $request->type_document,
        'etat' => 'En cours de traitement'
    ]);

    return response()->json($demande);
}
public function getByApogee($numero_apogee)
{
    $etudiant = Etudiant::where('numero_apogee', $numero_apogee)->first();

    if (!$etudiant) {
        return response()->json([
            "message" => "Etudiant non trouvé"
        ],404);
    }

    return response()->json($etudiant);
}
public function show($apogee)
{
    $etudiant = Etudiant::where('numero_apogee',$apogee)->first();

    if(!$etudiant){
        return response()->json(['message'=>'not found'],404);
    }

    return response()->json($etudiant);
}

    public function terminer($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->etat = "Validé";
        $demande->save();
        return "Demande Validée";
    }
    public function signer($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->etat = "Signé";
        $demande->signature_electronique = "signature.png";
        $demande->save();
        return "Document signé";
    }
    public function delivrer($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->etat = "Délivré";
        $demande->save();
        return "Document délivré";
    }
    public function update(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);
        $demande->etat = $request->etat;
        $demande->save();
        return "Etat modifié";
    }
    public function generatePdf($id)
    {
        $demande = Demande::with('etudiant')->findOrFail($id);
        if($demande->etat != "Signé"){
            return "Le document n'est pas encore signé";
        }
        $etudiant = $demande->etudiant;
        $pdf = Pdf::loadView('attestation', compact('etudiant'));
        return $pdf->download('attestation.pdf');
    }
}