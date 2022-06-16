<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Mission;
use App\Models\Tache;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use RealRashid\SweetAlert\Facades\Alert;

class TacheController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckAdmin')->except('show', 'index', 'updateStatut', 'planningLayout', 'planning');
        $this->middleware('CheckCmpAdt')->only('show', 'index', 'updateStatut', 'planningLayout', 'planning');
    }


    public function index()
    {

        if (auth()->user()->role_id == 5) {
            $taches = Tache::orderByDesc('num_tache')->with(['mission', 'user'])->get();
        } else {
            $taches = Tache::orderByDesc('num_tache')->whereUserId(auth()->user()->id)->with(['mission', 'user'])->get();
        }
        return view('taches.tachesList', compact('taches'));
    }

    public function show($id)
    {
        $tache = Tache::whereId($id)->with(['user', 'mission', 'commentaires'])->first();

        return view('taches.tacheShow', compact('tache'));
    }

    public function create()
    {
        $users = User::orderBy('role_id', 'asc')->get();
        $missions = Mission::all();


        return view('taches.tacheCreate', compact('users', 'missions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'color' => 'required',
            'textColor' => 'required',
            'mission_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $num_tache = IdGenerator::generate(['table' => 'taches', 'field' => 'num_tache', 'length' => 7, 'prefix' => 'T' . date('y') . '-', 'reset_on_prefix_change' => true]);
        $user = User::whereId($request->user_id)->first();
        $titleMission = Mission::whereId($request->mission_id)->with('entreprise', 'prestation')->first();
        $title = $num_tache . "-" . $user->name . "-" . $titleMission->entreprise->raison_social . "-" . $titleMission->prestation->code_prestation;
        $start = Carbon::parse(request()->start)->format('Y-m-d H:i:s');
        $end = Carbon::parse(request()->end)->format('Y-m-d H:i:s');

        Tache::create([
            'designation' => $request->designation,
            'title' => $title,
            'start' => $start,
            'end' => $end,
            'allDay' => 0,
            'color' => $request->color,
            'textColor' => $request->textColor,
            'status' => 0,
            'mission_id' => $request->mission_id,
            'user_id' => $request->user_id,
            'num_tache' => $num_tache,
        ]);

        alert()->success('Tâche', 'Tâche ajouté avec succée');
        return redirect()->route('tache.list');
    }

    public function edit($id)
    {
        $users = User::orderBy('role_id', 'asc')->get();
        $missions = Mission::all();
        $tache = Tache::whereId($id)->first();

        return view('taches.tacheEdit', compact('tache', 'missions', 'users'));
    }

    public function update($id)
    {
        /* dd(request()->start . " + " . Carbon::parse(request()->start)->format('Y-m-d H:i:s')); */
        $data = request()->validate([
            'designation' => 'required',
            'start' => 'required|before:end',
            'end' => 'required|after:start',
            'color' => 'required',
            'textColor' => 'required',
            'mission_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        //title
        $num_tache = Tache::whereId($id)->first('num_tache');
        $user = User::whereId(request()->user_id)->first();
        $titleMission = Mission::whereId(request()->mission_id)->with('entreprise', 'prestation')->first();
        $title = $num_tache->num_tache . "-" . $user->name . "-" . $titleMission->entreprise->raison_social . "-" . $titleMission->prestation->code_prestation;

        $start = Carbon::parse(request()->start)->format('Y-m-d H:i:s');
        $end = Carbon::parse(request()->end)->format('Y-m-d H:i:s');


        Tache::whereId($id)->update([
            "title" => $title,
            'designation' => request()->designation,

            'start' => $start,
            'end' => $end,
            'allDay' => 0,
            'color' => request()->color,
            'textColor' => request()->textColor,
            'status' => request()->status,
            'mission_id' => request()->mission_id,
            'user_id' => request()->user_id,

        ]);

        alert()->success('Tâche', 'Tâche a bien été mise à jour');
        return redirect()->route('tache.list');
    }

    public function updateStatut($id)
    {
        $data = request()->validate([

            'status' => 'required|integer'
        ]);



        Tache::whereId($id)->update($data);

        alert()->success('Tâche', 'Tâche a bien été mise à jour');
        return redirect()->route('tache.show', $id);
    }

    public function destroy($id)
    {
        if (Commentaire::where('tache_id', $id)->count()) {
            Alert::error('Suppression de la tâche', "la tâche ne peut pas étre supprimé");
            return redirect()->route('tache.list')->with('errors', "la tâche ne peut pas étre supprimé");
        }

        Tache::whereId($id)->delete();

        alert()->info('Tâche', 'Tâche a bien été supprimer');
        return redirect()->route('tache.list')->withMessage('la tache a été supprimé');;
    }

    public function planning()
    {

        if (auth()->user()->role_id == 5) {
            /* $taches = Tache::with(['mission', 'user'])->get(); */
            $event = Tache::Latest()->get();
        } else {
            $event = Tache::whereUserId(auth()->user()->id)->with(['mission', 'user'])->Latest()->get();
        }

        /* $event = Tache::Latest()->get(); */
        return response()->json(
            $event
        );
    }

    public function planningLayout()
    {
        $users = User::all();
        $missions = Mission::all();

        return view('taches.tachePlanning', compact('users', 'missions'));
    }

    public function storeViaPlanning(Request $request)
    {


        try {
            $request->validate([
                'start' => 'required|date|before:end',
                'end' => 'required|date|after:start',
                'color' => 'required',
                'textColor' => 'required',
                'designation' => 'required',
                'mission_id' => 'required|integer',
                'user_id' => 'required|integer',

            ]);

            if (empty($request->id)) {
                $num_tache = IdGenerator::generate(['table' => 'taches', 'field' => 'num_tache', 'length' => 7, 'prefix' => 'T' . date('y') . '-', 'reset_on_prefix_change' => true]);
                $user = User::whereId($request->user_id)->first();
                $titleMission = Mission::whereId($request->mission_id)->with('entreprise', 'prestation')->first();
                $title = $num_tache . "-" . $user->name . "-" . $titleMission->entreprise->raison_social . "-" . $titleMission->prestation->code_prestation;
                $start = Carbon::parse(request()->start)->format('Y-m-d H:i:s');
                $end = Carbon::parse(request()->end)->format('Y-m-d H:i:s');


                Tache::create([
                    'designation' => $request->designation,
                    'title' => $title,
                    'start' => request()->start,
                    'end' => request()->end,
                    'allDay' => 0,
                    'color' => $request->color,
                    'textColor' => $request->textColor,
                    'status' => 0,
                    'mission_id' => $request->mission_id,
                    'user_id' => $request->user_id,
                    'num_tache' => $num_tache,
                ]);
                alert()->success('Tâche', "La Tâche a bien été crée");
            } else {

                $num_tache = Tache::whereId($request->id)->first('num_tache');
                $user = User::whereId(request()->user_id)->first();
                $titleMission = Mission::whereId(request()->mission_id)->with('entreprise', 'prestation')->first();
                $title = $num_tache->num_tache . "-" . $user->name . "-" . $titleMission->entreprise->raison_social . "-" . $titleMission->prestation->code_prestation;

                $start = Carbon::parse(request()->start)->format('Y-m-d H:i:s');
                $end = Carbon::parse(request()->end)->format('Y-m-d H:i:s');


                //my

                Tache::whereId($request->id)->update([
                    "title" => $title,
                    'designation' => request()->designation,

                    'start' => request()->start,
                    'end' => request()->end,
                    'allDay' => 0,
                    'color' => request()->color,
                    'textColor' => request()->textColor,
                    'mission_id' => request()->mission_id,
                    'user_id' => request()->user_id,

                ]);

                alert()->success('Tâche', 'Tâche a bien été mise à jour');

                alert()->success('Mise à jour', 'La Tâche a bien été modifié');
            }
        } catch (\Throwable $th) {
            alert()->error('error', "Veuillez vérifier les données que vous avez introduit " . $th->getMessage());
            return redirect()->back();
        }
        return redirect()->back();
    }



    public function deleteViaPlanning($id)
    {
        Tache::whereId($id)->delete();
        alert()->success('Tâche', 'Tâche a bien été supprimer');
        return redirect()->back();
    }
}