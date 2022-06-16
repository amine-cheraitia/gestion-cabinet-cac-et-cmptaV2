<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mandat;
use App\Models\Mission;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PDF;

class MandatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }

    public function generate($id)
    {
        $mandat = Mandat::whereMissionId($id)->count();
        /* dd($mandat); */
        if ($mandat) {
            return redirect()->route('mission.show', $id)->with('errors', "Un mandat pour cette mission existe déja");
        }


        $num_mandat = IdGenerator::generate(['table' => 'mandats', 'field' => 'num_mandat', 'length' => 8, 'prefix' => 'MD' . date('y') . '-', 'reset_on_prefix_change' => true]);
        /* $total = number_format($request->total, 2, '.', ''); */
        /*     dd(Carbon::now()->format('m-d-Y')); */
        Mandat::create(/* request()->all() + */[
            "mission_id" => $id,
            "date_mandat" => Carbon::now()->format('Y-m-d'),
            'num_mandat' => $num_mandat,

        ]);

        return redirect()->route('mission.show', $id);
    }


    public function pdf($id)
    {
        $mandat = Mandat::whereMissionId($id)->first();
        $mission = Mission::whereId($id)->first();

        $data['num_mandat'] = $mandat->num_mandat;
        $data['raison_social'] = $mission->entreprise->raison_social;
        $data['adresse'] = $mission->entreprise->adresse;
        $data['date_mandat'] = $mandat->date_mandat;
        $data['prestation'] = $mission->prestation->designation;
        $data['start'] = $mission->start;
        $data['end'] = $mission->end;

        $pdf = PDF::loadView('mandats.pdf', $data);
        return $pdf->stream($mandat->date_mandat . ".pdf");
    }
}