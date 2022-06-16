<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Role;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.usersList', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::whereId($id)->first();
        $roles = Role::all();

        return view('users.userEdit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'prenom' => 'required|min:3',
            'email' => 'required|email',
            'role_id' => 'required|integer'
        ]);

        User::find($id)->update($data);
        alert()->success('Utilisateur', 'Utilisateur a bien été mise à jour');
        return redirect()->route('users.list');
    }


    public function destroy($id)
    {

        $commentaires = Tache::where('user_id', $id)->count();
        $taches = Tache::where('user_id', '=', $id)->count();

        if ($taches || $commentaires) {
            alert()->error('Utilisateur', 'Vous ne pouvez pas supprimer cette utilisateur');
            return redirect()->back();
        }
        alert()->info('Utilisateur', 'Utilisateur a bien été supprimer');
        User::whereId($id)->delete();
        return redirect()->route('users.list')->withMessage('Utilisateur a bien été supprimer');
    }
}