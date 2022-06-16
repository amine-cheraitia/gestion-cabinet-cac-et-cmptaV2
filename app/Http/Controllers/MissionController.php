<?php

namespace App\Http\Controllers;

use App\Models\Convention;
use Carbon\Carbon;
use App\Models\Devis;
use App\Models\Facture;
use App\Models\Mission;
use App\Models\Entreprise;
use App\Models\Mandat;
use App\Models\Prestation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }


    public function index()
    {
        $missions = Mission::orderByDesc('title')->with(['entreprise', 'prestation'])->get();

        /* dd($missions); */
        return view('missions.missionList', compact('missions'));
    }

    public function show($id)
    {

        $mission = Mission::whereId($id)->with(["entreprise", "prestation", "mandat", "convention"])->first();

        return view('missions.missionShow', compact('mission'));
    }

    public function create()
    {
        $devisUsed = Mission::whereNotNull('devis_id')->get();

        $entreprises = Entreprise::all();
        $devis = Devis::whereNotIn("id", $devisUsed->pluck('devis_id'))->get(); ///wherenotin
        $prestations = Prestation::all();

        return view('missions.missionCreate', compact('entreprises', 'devis', 'prestations'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'color' => 'required',
            'textColor' => 'required',
            'prestation_id' => 'required',
            'entreprise_id' => 'required',
            "total" => 'required'
        ]);


        $num_missions = IdGenerator::generate(['table' => 'missions', 'field' => 'num_missions', 'length' => 7, 'prefix' => 'M' . date('y') . '-', 'reset_on_prefix_change' => true]);
        $entreprise = Entreprise::whereId($request->entreprise_id)->first();
        $code = Prestation::whereId($request->prestation_id)->first();
        $title = $num_missions . "-" . $entreprise->raison_social . "-" . $code->code_prestation;


        $start = Carbon::parse(request()->start)->format('Y-m-d H:i:s');
        $end = Carbon::parse(request()->end)->format('Y-m-d H:i:s');

        Mission::create([
            "devis_id" => $request->devis_id,
            "entreprise_id" => $request->entreprise_id,
            "prestation_id" => $request->prestation_id,
            "color" => $request->color,
            "textColor" => $request->textColor,
            "allDay" => 1,
            "status" => 0,
            "start" => $start,
            "end" => $end,
            "title" => $title,
            'num_missions' => $num_missions,
            "total" => $request->total,
        ]);

        alert()->success('Mission', 'Mission crée avec succée');
        return redirect()->route('mission.list');
    }

    public function devisContent(Request $request)
    {
        $devis_id = $request->get('devis_id');

        $devis = Devis::whereId($devis_id)->first(['id', 'entreprise_id', 'prestation_id', 'total']);

        $total = number_format($devis->total, 2, '.', '');

        return response()->json([
            'total' => $total,
            'entreprise_id' => $devis->entreprise_id,
            'prestation_id' => $devis->prestation_id,
            'devis_id' => $devis->id
        ]);
        //$total = number_format($montant, 2, ',', ' ');
        /* $total = number_format($montant, 2, '.', ''); //12345.67
        echo $total; */
    }

    public function edit($id)
    {
        $devisUsed = Mission::whereNotNull('devis_id')->get();
        $devisUsed = $devisUsed->pluck('devis_id');

        $mission = Mission::whereId($id)->first();
        $devisUsed = collect(array_diff($devisUsed->toArray(), array($mission->devis_id))); // pour récupéré une collection avec les devis non utilisé + le devis utilisé dans la mission actuel

        $entreprises = Entreprise::all();
        $devis = Devis::whereNotIn("id", $devisUsed)->get(); ///récupérer les devis non utilisé + le devis utilisé si il y a
        $prestations = Prestation::all();

        return view('missions.missionEdit', compact('mission', 'entreprises', 'devis', 'prestations'));
    }

    public function update($id)
    {

        $data = request()->validate([
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'color' => 'required',
            'textColor' => 'required',
            'prestation_id' => 'required',
            'entreprise_id' => 'required',
            "total" => 'required',
            "status" => 'required|integer',
        ]);
        //title
        $num_missions = Mission::whereId($id)->first('num_missions');

        $entreprise = Entreprise::whereId(request()->entreprise_id)->first();
        $code = Prestation::whereId(request()->prestation_id)->first();
        $title = $num_missions->num_missions . "-" . $entreprise->raison_social . "-" . $code->code_prestation;


        $start = Carbon::parse(request()->start)->format('Y-m-d H:i:s');
        $end = Carbon::parse(request()->end)->format('Y-m-d H:i:s');

        Mission::whereId($id)->update([
            "start" => $start,
            "end" => $end,
            "color" => request()->color,
            "textColor" => request()->textColor,
            "prestation_id" => request()->prestation_id,
            "entreprise_id" => request()->entreprise_id,
            "total" => request()->total,
            "status" => request()->status,
            "title" => $title,

        ]);
        alert()->success('Mission', 'Mission a bien été mise à jour');
        return redirect()->route('mission.list');
    }

    public function destroy($id)
    {
        if (Facture::where('mission_id', $id)->count()) {
            Alert::error('Suppression de la mission', "la mission ne peut pas étre supprimé");
            return redirect()->route('mission.list')->with('errors', "la mission ne peut pas étre supprimé");
        }
        Mandat::whereMissionId($id)->delete();
        Convention::whereMissionId($id)->delete();
        Mission::whereId($id)->delete();
        alert()->info('Mission', 'Mission a bien été supprimer');
        return redirect()->route('mission.list')->withMessage('la mission a été supprimé');
    }

    public function planning()
    {

        $event = Mission::Latest()->get();
        return response()->json(
            $event
        );
    }

    public function planningLayout()
    {
        $devisUsed = Mission::whereNotNull('devis_id')->get();
        $entreprises = Entreprise::all();
        $devis = Devis::whereNotIn("id", $devisUsed->pluck('devis_id'))->get(); ///wherenotin
        $prestations = Prestation::all();
        return view('missions.missionPlanning', compact('prestations', 'devis', 'entreprises'));
    }


    public function storeViaPlanning(Request $request)
    {

        try {
            $request->validate([
                'start' => 'required|date|before:end',
                'end' => 'required|date|after:start',
                'color' => 'required',
                'textColor' => 'required',
                'prestation_id' => 'required',
                'entreprise_id' => 'required',
                "total" => 'required'
            ]);

            if (empty($request->id)) {
                $num_missions = IdGenerator::generate(['table' => 'missions', 'field' => 'num_missions', 'length' => 7, 'prefix' => 'M' . date('y') . '-', 'reset_on_prefix_change' => true]);
                $entreprise = Entreprise::whereId($request->entreprise_id)->first();
                $code = Prestation::whereId($request->prestation_id)->first();
                $title = $num_missions . "-" . $entreprise->raison_social . "-" . $code->code_prestation;

                Mission::create([
                    "devis_id" => $request->devis_id,
                    "entreprise_id" => $request->entreprise_id,
                    "prestation_id" => $request->prestation_id,
                    "color" => $request->color,
                    "textColor" => $request->textColor,
                    "allDay" => 1,
                    "status" => 0,
                    "start" => $request->start,
                    "end" => $request->end,
                    "title" => $title,
                    'num_missions' => $num_missions,
                    "total" => $request->total,
                ]);
                alert()->success('Mission', "La mission a bien été crée");
            } else {

                $num_missions = Mission::whereId($request->id)->first('num_missions');
                $entreprise = Entreprise::whereId($request->entreprise_id)->first();

                $code = Prestation::whereId($request->prestation_id)->first();
                $title = $num_missions->num_missions . "-" . $entreprise->raison_social . "-" . $code->code_prestation;

                Mission::whereId($request->id)->update([
                    "devis_id" => $request->devis_id,
                    "entreprise_id" => $request->entreprise_id,
                    "prestation_id" => $request->prestation_id,
                    "color" => $request->color,
                    "textColor" => $request->textColor,
                    "start" => $request->start,
                    "end" => $request->end,
                    "total" => $request->total,
                    "title" => $title,

                ]);

                alert()->success('Mise à jour', 'La mission a bien été modifié');
            }
        } catch (\Throwable $th) {
            alert()->error('error', "Veuillez vérifier les données que vous avez introduit " . $th->getMessage());
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function deleteViaPlanning($id)
    {
        if (Facture::where('mission_id', $id)->count()) {
            Alert::error('Suppression de la mission', "la mission ne peut pas étre supprimé");
            return redirect()->back();
        }
        Mandat::whereMissionId($id)->delete();
        Convention::whereMissionId($id)->delete();
        Mission::whereId($id)->delete();
        alert()->success('Mission', 'Mission a bien été supprimer');
        return redirect()->back();
    }
}