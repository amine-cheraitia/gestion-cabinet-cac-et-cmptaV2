<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\Commentaire;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdminAdt']);
    }

    public function store(Tache $tache)
    {

        request()->validate([
            'description' => 'required|min:3'
        ]);

        $tache->commentaires()->create(request()->all() + [
            'user_id' => auth()->user()->id,
            'date_commentaire' => Carbon::now()
        ]);
        alert()->success('Commentaire', 'Commentaire ajouté avec succée');
        return redirect()->route('tache.show', $tache->id);
    }

    public function update(Tache $tache)
    {

        request()->validate([
            'description' => 'required|min:3'
        ]);

        Commentaire::whereId(request()->id)->update([
            "description" => request()->description
        ]);

        /* Commentaire::whereId($id)->delete(); */
        alert()->info('Commentaire', 'Commentaire a bien été enregistré');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Commentaire::whereId($id)->delete();
        alert()->info('Commentaire', 'Commentaire a bien été supprimer');
        return redirect()->back();
    }
}