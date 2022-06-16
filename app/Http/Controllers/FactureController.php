<?php

namespace App\Http\Controllers;


use PDF;
use NumberFormatter;
use App\Models\Facture;
use App\Models\Mission;
use App\Models\Exercice;
use App\Models\Paiement;
use App\Models\TypeFacture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;



class FactureController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }

    public function index()
    {
        $factures = Facture::orderByDesc('exercice_id')->with(['mission', 'factureAvoir'])->orderBy('num_fact')/* ->orderBy('type_facture_id', 'desc') */->get();
        /* $factures = Facture::with(['mission', 'factureAvoir'])->whereTypeFactureId(1)->orderBy('num_fact')->get(); */
        $exercices = Exercice::all();
        return view("factures.facturesList", compact("factures", 'exercices'));
    }

    public function showExercice($id)
    {
        if ($id == "...") {
            return redirect()->route('facture.list');
        }

        $factures = Facture::whereExerciceId($id)->orderBy('num_fact')->with(['mission', 'factureAvoir'])->get();

        $exercices = Exercice::all();
        return view('factures.facturesList', compact('factures', 'exercices'));
    }

    public function create()
    {
        $missions = Mission::all();
        $exercices = Exercice::all();
        /*         $typefactures = TypeFacture::all();
        $facturesavoir = Facture::all(); */

        return view("factures.factureCreate", compact("missions", "exercices"/* , "typefactures", "facturesavoir" */));
    }
    public function createAvoir()
    {
        $factureAnnulee = Facture::whereNotNull('fact_avoir_id')->pluck('fact_avoir_id');
        $factures = Facture::whereTypeFactureId(1)->whereNotIn('id', $factureAnnulee)->get();
        $exercices = Exercice::all();
        return view("factures.factureAvoirCreate", compact("factures", "exercices"/* , "typefactures", "facturesavoir" */));
    }

    public function store(Request $request)
    {

        /* dd($request); */
        if ($request->fact_avoir_id) {

            $request->validate([
                'fact_avoir_id' => 'required',
                'date_facturation' => 'required|date',
                'exercice_id' => 'required',
                'montant' => 'required',
            ]);
            $num_fact = IdGenerator::generate(['table' => 'factures', 'field' => 'num_fact', 'length' => 8, 'prefix' => 'FA' . substr($request->exercice_id, -2) /* date('y') */ . '-', 'reset_on_prefix_change' => true]);
            $montant = number_format($request->montant, 2, '.', '');
            $mission_id = Facture::whereId($request->fact_avoir_id)->first('mission_id')->mission_id;

            Facture::create([
                'num_fact' => $num_fact,
                "date_facturation" => $request->date_facturation,
                "montant" => $montant,
                "mission_id" => $mission_id,
                "exercice_id" => $request->exercice_id,
                'type_facture_id' => 2,
                'fact_avoir_id' => $request->fact_avoir_id
            ]);
            alert()->success('Facture d\'Avoir', 'Facture d\'Avoir crée avec succée');
            return redirect()->route('facture.list');
        }

        $request->validate([
            'mission_id' => 'required',
            'date_facturation' => 'required|date',
            'exercice_id' => 'required',
            'montant' => 'required',
        ]);
        $num_fact = IdGenerator::generate(['table' => 'factures', 'field' => 'num_fact', 'length' => 8, 'prefix' => 'FF' . substr($request->exercice_id, -2)/* date('y') */ . '-', 'reset_on_prefix_change' => true]);
        $montant = number_format($request->montant, 2, '.', '');

        Facture::create(/* request()->all() + */[
            'num_fact' => $num_fact,
            "date_facturation" => $request->date_facturation,
            "montant" => $montant,
            "mission_id" => $request->mission_id,
            "exercice_id" => $request->exercice_id,
            'type_facture_id' => 1
        ]);
        alert()->success('Facture', 'Facture crée avec succée');
        return redirect()->route('facture.list');
    }

    public function edit($id)
    {

        /*
        $devisUsed = Mission::whereNotNull('devis_id')->get();
        $devisUsed = $devisUsed->pluck('devis_id');
        $mission = Mission::whereId($id)->first();
        $devisUsed = collect(array_diff($devisUsed->toArray(), array($mission->devis_id))); // pour récupéré une collection avec les devis non utilisé + le devis utilisé dans la mission actuel
        */

        $facture = Facture::whereId($id)->first();
        if (($facture->type_facture_id) == 2) {
            $factureUtilise = Facture::whereNotNull('fact_avoir_id')->pluck('fact_avoir_id');

            $factureAnnulee = collect(array_diff($factureUtilise->toArray(), array($facture->fact_avoir_id))); // pour récupérer une collection des factures qui n'ont pas de facture d'avoir + la facture actuel
            /* dd(array($factureAnnulee)); */

            $factures = Facture::whereTypeFactureId(1)->whereNotIn('id', $factureAnnulee)->get();
            $exercices = Exercice::all();
            $factavoir = Facture::whereId($id)->first();
            return view("factures.factureAvoirEdit", compact("factures", "factavoir", "exercices"));
        } else {

            $missions = Mission::all();
            $exercices = Exercice::all();


            return view("factures.factureEdit", compact("facture", "missions", "exercices"));
        }
    }

    public function update(Request $request)
    {

        if ($request->fact_avoir_id) {

            $data = request()->validate([
                'fact_avoir_id' => 'required',
                'date_facturation' => 'required|date',
                'exercice_id' => 'required',
                'montant' => 'required',
            ]);
            $mission_id = Facture::whereId($request->fact_avoir_id)->first()->mission_id;

            Facture::whereId(request()->id)->update($data + [
                "mission_id" => $mission_id
            ]);
        } else {

            $data = request()->validate([
                'date_facturation' => 'required|date',
                'exercice_id' => 'required',
                'mission_id' => 'required',
                'montant' => 'required',
            ]);
            Facture::whereId(request()->id)->update($data);
        }

        alert()->success('Facture', 'Facture a bien été mise à jour');
        return redirect()->route('facture.list');
    }

    public function destroy($id)
    {

        if (Paiement::whereFactureId($id)->count()) {
            Alert::error("Suppression de la facture", "La Facture ne peut pas étre supprimé");
            return redirect()->route('facture.list')->with('errors', "la Facture ne peut pas étre supprimé");
        }
        if (Facture::whereFactAvoirId($id)->count()) {
            Alert::error('Suppression de la facture', "La Facture ne peut pas étre supprimé");
            return redirect()->route('facture.list')->with('errors', "la Facture ne peut pas étre supprimé");
        }

        /*         $paiement = Paiement::whereFactureId($id)->count();

        if ($paiement) {
            alert()->error('Facture', 'Un paiement est lié a la facture. Vous ne pouvez pas la supprimer');
        } */

        Facture::whereId($id)->delete();
        alert()->info('Facture', 'Facture a bien été supprimer');
        return redirect()->route('facture.list')->withMessage('La Facture a été supprimé');
    }

    public function calculPrix(Request $request)
    {
        $mission_id = $request->get('mission_id');
        $mission = Mission::whereId($mission_id)->first();
        $designation = $mission->prestation->designation;
        /*  */
        $factureUtilise = Facture::whereNotNull('fact_avoir_id')->pluck('fact_avoir_id');
        /*  */
        if ($request->edit) {
            $totalFacture = Facture::whereMissionId($mission_id)->whereTypeFactureId(1)->whereNotIn('id', $factureUtilise)->count() /* - 1 */;
        } else {
            $totalFacture = Facture::whereMissionId($mission_id)->whereTypeFactureId(1)->whereNotIn('id', $factureUtilise)->count();
        }
        $zyada = $totalFacture;
        /*         if (($totalFacture == 0) or ($totalFacture == 1) or ($totalFacture == -1)) {
            $tranche = $mission->total * 0.3;
        } elseif (($totalFacture > 1)) {
            $tranche = $mission->total * 0.4;
        } else {
            alert()->error('erreur', 'erreur');
        } */
        if ($totalFacture > 2) {
            $tranche = null;
            $zyada = $totalFacture;
            return response()->json([
                "total" => null,
                "designation" => null,
                "totalFacture" => null,
                "zyada" => $zyada,
            ]);
        } elseif (($totalFacture == 1) or ($totalFacture == 0)) {
            $tranche = $mission->total * 0.3;
        } else {
            $tranche = $mission->total * 0.4;
        }
        $total = number_format($tranche, 2, '.', '');

        /*         $reponse = $designation;
        $reponse = $total; */

        return response()->json([
            "total" => $total,
            "designation" => $designation,
            "totalFacture" => $totalFacture,
            "zyada" => $zyada,
        ]);
    }

    public function factureInfo(Request $request)
    {
        $id = $request->get('facture_ref');
        $facture = Facture::whereId($id)->with('mission')->first();
        $prestation = $facture->mission->prestation->designation;
        $montant = $facture->montant;
        $exercice_d = $facture->exercice_id;

        return response()->json([
            "prestation" => $prestation,
            "montant" => $montant,
            "exercice_d" => $exercice_d
        ]);
    }

    public function pdf($id)
    {
        $facture = Facture::findOrFail($id);

        $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);

        $data['num_fact'] = $facture->num_fact;
        $data['date_facturation'] = $facture->date_facturation;
        $data['total'] = $facture->montant;
        $data['montant_lettre'] = ucfirst($f->format($facture->montant));



        $data['prestation'] = $facture->mission->prestation->designation;
        $data['entreprise'] = [
            /*             'raison_social' => $devis->entreprise->raison_social,
            'num_registre_commerce' => $devis->entreprise->num_registre_commerce,
            'num_art_imposition' => $devis->entreprise->num_art_imposition,
            'num_id_fiscale' => $devis->entreprise->num_id_fiscale,
            'adresse' => $devis->entreprise->adresse,
            'email' => $devis->entreprise->email, */];
        $data['raison_social'] = $facture->mission->entreprise->raison_social;
        $data['num_registre_commerce'] = $facture->mission->entreprise->num_registre_commerce;
        $data['num_art_imposition'] = $facture->mission->entreprise->num_art_imposition;
        $data['num_id_fiscale'] = $facture->mission->entreprise->num_id_fiscale;
        $data['adresse'] = $facture->mission->entreprise->adresse;
        $data['email'] = $facture->mission->entreprise->email;

        if ($facture->fact_avoir_id) {
            $fact = Facture::whereId($facture->fact_avoir_id)->first();
            $data['ref'] = $fact->num_fact;
            $data['refDate'] = $fact->date_facturation;
            $pdf = PDF::loadView('factures.pdfAvoir', $data);
            return $pdf->stream($facture->num_fact . ".pdf");
        }

        $data['missionRef'] = $facture->mission->num_missions;
        $pdf = PDF::loadView('factures.pdf', $data);
        return $pdf->stream($facture->num_fact . ".pdf");


        /* return view('devis.pdf', compact('devis')); */
    }
}