<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Paiement;
use App\Models\TypePaiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $paiements = Paiement::orderByDesc('date_paiement')->get();
        return view('paiements.paiementsList', compact('paiements'));
    }

    public function create()
    {
        $typePaiements = TypePaiement::all();
        $factures = Facture::whereTypeFactureId(1)->get();

        return view('paiements.paiementCreate', compact('typePaiements', 'factures'));
    }
    public function fetch(Request $request)
    {
        $montant = Facture::whereId($request->facture_id)->first()->montant;

        return response()->json($montant);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "montant" => "required",
            "num_piece_c" => "required|min:1",
            "date_paiement" => "required|date",
            "type_paiement_id" => "required",
            "facture_id" => "required",
        ]);

        Paiement::create($data);
        alert()->success('Paiement', "Paiement a bien été enregistrer");
        return redirect()->route('paiement.list')->with('message', "Paiement a bien été enregistrer");
    }

    public function edit($id)
    {
        $typePaiements = TypePaiement::all();
        $factures = Facture::whereTypeFactureId(1)->get();
        $paiement = Paiement::whereId($id)->first();

        return view('paiements.paiementEdit', compact('paiement', 'typePaiements', 'factures'));
    }

    public function update($id)
    {
        $data = request()->validate([
            "montant" => "required",
            "num_piece_c" => "required|min:1",
            "date_paiement" => "required|date",
            "type_paiement_id" => "required",
            "facture_id" => "required",
        ]);

        Paiement::whereId($id)->update($data);
        alert()->success('Paiement', 'Paiement a bien été mise à jour');
        return redirect()->route('paiement.list');
    }

    public function destroy($id)
    {
        Paiement::whereId($id)->delete();

        alert()->info('Paiement', 'Paiement a bien été supprimer');
        return redirect()->route('paiement.list')->withMessage('la Paiement a été supprimé');
    }

    public function creances()
    {
        $factureWavoir = Facture::whereNotNull('fact_avoir_id')->pluck('fact_avoir_id');
        $facturePaye = Paiement::pluck('facture_id');
        $facts = Facture::whereNotIn('id', $factureWavoir)->where('type_facture_id', 1)->whereNotIn('id', $facturePaye)->get();

        /*    $creances = DB::select("SELECT DISTINCT  num_missions, COUNT(f.id) nbr, SUM(montant) totalfacture, total totalmission , ( CASE WHEN ( total-SUM(montant)) IS NULL THEN total ELSE ( total-SUM(montant)) END ) dif,START,total*0.3 AS ApayePremiereTranche, DATE_ADD(start,INTERVAL + (durée/2) MONTH) AS deuxiemeTranche,total*0.3 AS ApayeDeuxiemeTranche, end AS derniéreTranche,total*0.4 AS ApayeDerniereTranche,durée
        FROM  (SELECT ms.*,durée  from missions ms  JOIN prestations AS p ON p.id=ms.prestation_id) AS m LEFT JOIN (SELECT * FROM factures WHERE type_facture_id=1 ) f ON m.id=f.mission_id
        GROUP BY num_missions
        HAVING COUNT(f.id)<3"); */

        return view("paiements.paiementCreance", compact("facts"));
    }

    public function PlanningPaiement()
    {
        $planningPaiements = DB::select("SELECT DISTINCT  num_missions, COUNT(f.id) nbr, SUM(montant) totalfacture, total totalmission , ( CASE WHEN ( total-SUM(montant)) IS NULL THEN total ELSE ( total-SUM(montant)) END ) dif,START,total*0.3 AS ApayePremiereTranche, DATE_ADD(start,INTERVAL + (durée/2) MONTH) AS deuxiemeTranche,total*0.3 AS ApayeDeuxiemeTranche, end AS derniéreTranche,total*0.4 AS ApayeDerniereTranche,durée
        FROM  (SELECT ms.*,durée  from missions ms  JOIN prestations AS p ON p.id=ms.prestation_id) AS m LEFT JOIN (SELECT * FROM factures f  WHERE  type_facture_id=1 and id NOT IN (SELECT fact_avoir_id FROM factures WHERE  fact_avoir_id IS not NULL) ) f ON m.id=f.mission_id
        GROUP BY num_missions
        HAVING COUNT(f.id)<3");

        return view("paiements.paiementPlanning", compact("planningPaiements"));
    }
}