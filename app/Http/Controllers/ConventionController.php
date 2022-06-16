<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Mission;
use App\Models\Convention;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ConventionController extends Controller
{
    public function generate($id)
    {
        $mandat = Convention::whereMissionId($id)->count();
        if ($mandat) {
            return redirect()->route('mission.show', $id)->with('errors', "Une convention pour cette mission existe déja");
        }
        $num_convention = IdGenerator::generate(['table' => 'conventions', 'field' => 'num_convention', 'length' => 8, 'prefix' => 'CV' . date('y') . '-', 'reset_on_prefix_change' => true]);

        Convention::create([
            "mission_id" => $id,
            "date_convention" => Carbon::now()->format('Y-m-d'),
            'num_convention' => $num_convention,

        ]);

        return redirect()->route('mission.show', $id);
    }

    public function pdf($id)
    {
        $convention = Convention::whereMissionId($id)->first();
        $mission = Mission::whereId($id)->first();

        $data['num_convention'] = $convention->num_convention;
        $data['raison_social'] = $mission->entreprise->raison_social;
        $data['adresse'] = $mission->entreprise->adresse;
        $data['date_convention'] = $convention->date_convention;
        $data['prestation'] = $mission->prestation->designation;
        $data['start'] = $mission->start;
        $data['end'] = $mission->end;
        $data['montant'] = $mission->total;
        $data['rc'] = $mission->entreprise->num_registre_commerce;
        $data['art'] = $mission->entreprise->num_art_imposition;
        $data["nif"] = $mission->entreprise->num_id_fiscale;

        $pdf = PDF::loadView('convention.pdf', $data);
        return $pdf->stream($convention->num_devis . ".pdf");
    }
}