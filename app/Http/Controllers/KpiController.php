<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tache;
use App\Models\Facture;
use App\Models\Mission;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }

    public function index()
    {

        $factureUtilise = Facture::whereNotNull('fact_avoir_id')->where('exercice_id', '=', date('Y'))->pluck('fact_avoir_id');

        /* $dataDel= Facture::where
 */
        $data =  Facture::selectRaw('
        YEAR(date_Facturation) AS y,SUM(montant) montant
    ')->whereNotIn('id', $factureUtilise)
            ->groupBy('y')
            ->orderBy('y', 'asc')
            ->get();
        $montants = [];
        $years = [];

        foreach ($data as $d) {
            $montants[] = $d->montant;
            $years[] = $d->y;
        }
        $x_max = 0;
        $xdata = [];
        foreach ($montants as $m) {
            if ($x_max < $m) {
                $x_max = $m;
            }
            $xdata[] = $m;
        }
        /*  */
        $missionEncours = Mission::whereStatus(0)->count();
        $missionAchevé = Mission::whereStatus(1)->count();
        $prestationsDevis = DB::select("SELECT p.designation,COUNT(*) AS nbr FROM devis d, prestations p
        WHERE p.id = d.prestation_id GROUP BY p.designation");
        $prestationDemande = [];
        $prestationDemandeeNbr = [];
        foreach ($prestationsDevis as $p) {
            $prestationDemande[] = $p->designation;
            $prestationDemandeeNbr[] = $p->nbr;
        }

        $prestationCA = DB::select("SELECT p.designation,SUM(m.total) AS montant FROM missions m,prestations p
        WHERE p.id = m.prestation_id GROUP BY p.designation");

        $prestationCALabel = [];
        $prestationCaMontant = [];
        $max_montant = 0;
        foreach ($prestationCA as $pCA) {
            if ($max_montant  < $pCA->montant) {
                $max_montant  = $pCA->montant;
            }
            $prestationCALabel[] = $pCA->designation;
            $prestationCaMontant[] = $pCA->montant;
        }
        $users = User::where('role_id', '>', 2)->get();

        return view('kpi.kpi', compact('users', 'xdata', 'years', 'x_max', 'missionEncours', 'missionAchevé', 'prestationDemande', 'prestationDemandeeNbr', "prestationCALabel", "prestationCaMontant", "max_montant"));
    }

    public function showUser(Request $request)
    {
        /*         if ($request->id == "...") {
            return redirect()->route('kpi.kpi');
        } */
        $tachesEncours = Tache::whereUserId($request->id)->whereStatus(0)->count();
        $tachesAchevé = Tache::whereUserId($request->id)->whereStatus(1)->count();


        /* $users = User::all(); */

        return response()->json([
            "tachesEncours" => $tachesEncours,
            "tachesAchevé" => $tachesAchevé,

        ]);
        /* return view('kpi.kpi', compact('users', 'tachesEncours', 'tachesAchevé')); */
    }
}