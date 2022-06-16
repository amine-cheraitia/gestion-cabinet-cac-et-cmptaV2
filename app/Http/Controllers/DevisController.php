<?php

namespace App\Http\Controllers;

use PDF;
use NumberFormatter;
use App\Models\Devis;
use App\Models\Mission;
use App\Models\Exercice;
use App\Models\Entreprise;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use RealRashid\SweetAlert\Facades\Alert;

class DevisController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }

    public function index()
    {
        $devis = Devis::orderByDesc('exercice_id')->with('entreprise')->get();
        $exercices = Exercice::all();
        return view('devis.devisList', compact('devis', 'exercices'));
    }

    public function showExercice($id)
    {
        if ($id == "...") {
            return redirect()->route('devis.list');
        }

        $devis = Devis::whereExerciceId($id)->with('entreprise')->get();

        $exercices = Exercice::all();
        return view('devis.devisList', compact('devis', 'exercices'));
    }

    public function create()
    {
        $entreprises = Entreprise::all();
        $exercices = Exercice::all();
        $prestations = Prestation::all();
        //teste

        //fin du teste
        return view('devis.devisCreate', compact('entreprises', 'exercices', "prestations"));
    }

    public function calculPrix(Request $request)
    {
        $entreprise_id = $request->get('entreprise_id');
        $prestation_id = $request->get('prestation_id');
        $tarifInitial = Prestation::whereId($prestation_id)->first();
        $indiceFiscal = Entreprise::whereId($entreprise_id)->with('RegimeFiscal')->first()->RegimeFiscal->indice_tarif;
        $indiceCategorie = Entreprise::whereId($entreprise_id)->with('categorie')->first()->categorie->indice_tarif;
        $montant = $indiceFiscal * $indiceCategorie * $tarifInitial->tarif_initial;
        //$total = number_format($montant, 2, ',', ' ');
        $total = number_format($montant, 2, '.', ''); //12345.67
        echo $total;
        //echo json_encode(DB::table('sub_categories')->where('category_id', $id)->get());

    }

    public function store(Request $request)
    {

        $request->validate([
            'date_devis' => 'required',
            'exercice_id' => 'required',
            'entreprise_id' => 'required',
            'prestation_id' => 'required',
            'total' => 'required',
        ]);

        $num_devis = IdGenerator::generate(['table' => 'devis', 'field' => 'num_devis', 'length' => 8, 'prefix' => 'DV' .  substr($request->exercice_id, -2) . '-', 'reset_on_prefix_change' => true]);

        $total = number_format($request->total, 2, '.', '');

        Devis::create(/* request()->all() + */[
            "exercice_id" => $request->exercice_id,
            "entreprise_id" => $request->entreprise_id,
            "prestation_id" => $request->prestation_id,
            "total" => $total,
            "date_devis" => $request->date_devis,
            'num_devis' => $num_devis,
        ]);
        alert()->success('Devis', "Le Devis a bien été créé");
        return redirect()->route('devis.list');
    }

    public function edit($id)
    {

        $devis = Devis::whereId($id)->first();
        $entreprises = Entreprise::all();
        $exercices = Exercice::all();
        $prestations = Prestation::all();

        return view('devis.devisEdit', compact('entreprises', 'devis', 'exercices', 'prestations'));
    }

    public function update($id)
    {

        $data = request()->validate([
            'date_devis' => 'required',
            'exercice_id' => 'required',
            'entreprise_id' => 'required',
            'prestation_id' => 'required',
            'total' => 'required',
        ]);
        Devis::whereId($id)->update($data);
        alert()->success('Devis', "les informations du devis se sont mis à jour");
        return redirect()->route('devis.list');
    }

    public function destroy($id)
    {
        if (Mission::whereDevisId($id)->count()) {
            Alert::error('Suppression du Devis', "le Devis ne peut pas être supprimé");
            return redirect()->route('devis.list')->with('errors', "le Devis ne peut pas être supprimé");
        }


        Devis::whereId($id)->delete();
        Alert::info('Suppression du Devis', "le Devis a bien été supprimé");
        return redirect()->route('devis.list')->withMessage('le Devis a été supprimé');;
    }

    public function pdf($id)
    {
        $devis = Devis::findOrFail($id);

        $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);


        $data['num_devis'] = $devis->num_devis;
        $data['date_devis'] = $devis->date_devis;
        $data['total'] = $devis->total;
        $data['montant_lettre'] = ucfirst($f->format($devis->total));



        $data['prestation'] = $devis->prestation->designation;
        $data['entreprise'] = [
            /*             'raison_social' => $devis->entreprise->raison_social,
            'num_registre_commerce' => $devis->entreprise->num_registre_commerce,
            'num_art_imposition' => $devis->entreprise->num_art_imposition,
            'num_id_fiscale' => $devis->entreprise->num_id_fiscale,
            'adresse' => $devis->entreprise->adresse,
            'email' => $devis->entreprise->email, */];
        $data['raison_social'] = $devis->entreprise->raison_social;
        $data['num_registre_commerce'] = $devis->entreprise->num_registre_commerce;
        $data['num_art_imposition'] = $devis->entreprise->num_art_imposition;
        $data['num_id_fiscale'] = $devis->entreprise->num_id_fiscale;
        $data['adresse'] = $devis->entreprise->adresse;
        $data['email'] = $devis->entreprise->email;

        $pdf = PDF::loadView('devis.pdf', $data);
        return $pdf->stream($devis->num_devis . ".pdf");


        /* return view('devis.pdf', compact('devis')); */
    }
}