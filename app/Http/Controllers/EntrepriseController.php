<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Categorie;
use App\Models\Entreprise;
use App\Models\Mission;
use App\Models\RegimeFiscal;
use App\Models\TypeActivite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EntrepriseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }


    public function index()
    {
        $entreprises = Entreprise::with('RegimeFiscal')->get();
        //$entreprises->with('RegimeFiscal')->get();
        ($entreprises);
        return view('clients.clientsList', compact('entreprises'));
    }

    public function create()
    {
        $typeActivite = TypeActivite::all();
        $regimeFiscal = RegimeFiscal::all();
        $categorie = Categorie::all();
        return view('clients.clientCreate', compact('categorie', 'regimeFiscal', 'typeActivite'));
    }

    public function store(Request $request)
    {
        //To do regex num tel
        $rules = array('required', 'regex:/(0)([0-9]){8,9}/');
        $request->validate([
            'raison_social' => 'required',
            'num_registre_commerce' => 'required',
            'num_art_imposition' => 'required',
            'num_id_fiscale' => 'required',
            'adresse' => 'required',
            'num_tel' => $rules/* 'required|regex:/(0)[0-9]{9|8}/' */,
            'email' => 'required|email|',
            'fiscal_id' => 'required',
            'activite_id' => 'required',
            'categorie_id' => 'required',
        ]);
        Entreprise::create(request()->all());

        alert()->success('Entreprise', "L'entreprise a bien été enregistré");
        return redirect()->route('client.list');
        /*         return "ok";
        $entreprises = Entreprise::with('RegimeFiscal')->get();
        //$entreprises->with('RegimeFiscal')->get();
        /* ($entreprises);
        return view('clients.clientCreate', compact('entreprises')); */
    }

    public function show($id)
    {
        $entreprise = Entreprise::whereId($id)->with(['activiteType', 'categorie', 'RegimeFiscal'])->get();

        /*return view('client.create');
        return "ok";
        $entreprises = Entreprise::with('RegimeFiscal')->get();
        //$entreprises->with('RegimeFiscal')->get();
        ($entreprises);*/
        return view('clients.clientCreate', compact('entreprises'));
    }

    public function edit($id)
    {

        $entreprise = Entreprise::whereId($id)->first();
        $typeActivite = TypeActivite::all();
        $regimeFiscal = RegimeFiscal::all();
        $categorie = Categorie::all();


        return view('clients.clientEdit', compact('entreprise', 'categorie', 'regimeFiscal', 'typeActivite'));
    }

    public function update($id)
    {
        $rules = array('required', 'regex:/(0)([0-9]){8,9}/');
        $data = request()->validate([
            'raison_social' => 'required',
            'num_registre_commerce' => 'required',
            'num_art_imposition' => 'required',
            'num_id_fiscale' => 'required',
            'adresse' => 'required',
            'num_tel' =>  $rules,
            'email' => 'required|email|',
            'fiscal_id' => 'required',
            'activite_id' => 'required',
            'categorie_id' => 'required',
        ]);

        Entreprise::whereId($id)->update($data);
        alert()->success('Entreprise', "les informations de l'entreprise se sont mis à jour");
        return redirect()->route('client.list');
    }
    public function destroy($id)
    {

        if (Devis::where('entreprise_id', $id)->count()) {
            Alert::error('Suppression d\'entreprise', "l'Entreprise ne peut pas étre supprimé");
            return redirect()->route('client.list')->with('errors', "l'Entreprise ne peut pas étre supprimé");
        }
        if (Mission::where('entreprise_id', $id)->count()) {
            Alert::error('Suppression d\'entreprise', "l'Entreprise ne peut pas étre supprimé");
            return redirect()->route('client.list')->with('errors', "l'Entreprise ne peut pas étre supprimé");
        }


        Alert::info('Suppression d\'entreprise', 'L\'Entreprise a bien été supprimer');
        Entreprise::whereId($id)->delete();
        return redirect()->route('client.list')->withMessage('l\'Entreprise a été supprimé');
    }
}