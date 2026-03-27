<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Etudiant;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; 
class DemandeApiController extends Controller
{
    // 🔹 Liste demandes
    public function index()
    {
         $demandes = Demande::with('etudiant')->latest()->get();
        return response()->json($demandes);
    }

    //🔹 Voir une demande
    public function show($id)
    {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['message' => 'Demande non trouvée'], 404);
        }
        return response()->json($demande);
    }
    public function store(Request $request)
        {
            $request->validate([
                'numero_apogee' => 'required',
                'type_document' => 'required'
            ]);
            $etudiant = Etudiant::where('numero_apogee',$request->numero_apogee)->first();
            if(!$etudiant){
                return response()->json([
                    "message"=>"Etudiant non trouvé"
                ],404);
            }
            $annee = Carbon::now()->year;
            $count = Demande::where('etudiant_id',$etudiant->id)
                ->where('type_document',$request->type_document)
                ->whereYear('created_at',$annee)
                ->count();
            if($count >= 2){
                return response()->json([
                    "message"=>"Vous avez atteint la limite de 2 demandes pour ce document cette année"
                ],403);
            }
            $demande = Demande::create([
                'etudiant_id' => $etudiant->id,
                'type_document' => $request->type_document,
                'etat' => 'En cours'
            ]);
            return response()->json([
                "message"=>"Demande envoyée",
                "data"=>$demande
            ]);
        }
    public function demandesEtudiant($numero)
    {
        $etudiant = Etudiant::where('numero_apogee',$numero)->first();
        if(!$etudiant){
            return response()->json(['message'=>'Etudiant non trouvé'],404);
        }
        $demandes = Demande::where('etudiant_id',$etudiant->id)->get();
        return response()->json($demandes);
    }
    public function getDemandesEtudiant($numero_apogee)
    {
        $etudiant = Etudiant::where('numero_apogee',$numero_apogee)->first();
        if(!$etudiant){
            return response()->json([
                "message"=>"Etudiant non trouvé"
            ],404);
        }
        $demandes = Demande::where('etudiant_id',$etudiant->id)->get();
        return response()->json($demandes);
    }
    // 🔹 Mettre à jour une demande
    public function updateEtat(Request $request, $id)
    {
        try {
            $demande = Demande::findOrFail($id);
            $demande->etat = $request->input('etat');
            $demande->save();
            return response()->json([
                "message" => "Etat modifié",
                "data" => $demande
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ],500);
        }
    }
    // 🔹 Supprimer une demande
    public function destroy($id)
    {
        $demande = Demande::find($id);
        if (!$demande) {
            return response()->json(['message' => 'Demande non trouvée'], 404);
        }
        $demande->delete();

        return response()->json(['message' => 'Demande supprimée']);
    }
    public function generatePDF($id)
    {
        $demande = Demande::with('etudiant')->find($id);
        if(!$demande){
            return response()->json(['message'=>'Demande non trouvée'],404);
        }
        if($demande->etat !== "Délivré"){
            $demande->etat = "Signé";
            $demande->save();
        }
        $view = '';
        switch($demande->type_document){
            case "Attestation poursuit":
                $view = "attestations.poursuit";
            break;

            case "Attestation poursuivi":
                $view = "attestations.poursuivi";
            break;

            case "Attestation de réussite":
                $view = "attestations.reussite";
            break;

            case "Attestation inscrites":
                $view = "attestations.inscrites";
            break;

            case "Attestation a été inscrites":
                $view = "attestations.ete_inscrites";
            break;

            case "Attestation des vacances":
                $view = "attestations.vacances";
            break;

            default:
                $view = "attestations.reussite";
            break;
        }
        $pdf = Pdf::loadView($view, [
            'demande' => $demande,
            'etudiant' => $demande->etudiant
        ]);
        return $pdf->download('attestation_'.$demande->id.'.pdf');
    }
    public function delivrer($id)
    {
        $demande = Demande::findOrFail($id);
        if(!$demande){
            return response()->json(['message'=>'Demande non trouvée'],404);
        }
        $demande->etat = "Délivré";
        $demande->save();
        return response()->json([
            "message"=>"délivré",
            "data"=>$demande
        ]);
    }
}