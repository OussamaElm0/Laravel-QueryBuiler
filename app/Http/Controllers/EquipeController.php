<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //1)
        return DB::select('select * from equipes');
    }
    public function equipeFr()
    {
        //2)
        return DB::select('select * from equipes where pays = ?', ["France"]);
    }
    public function creerIt()
    {
        //3)
        DB::insert('insert into equipes (name, pays, abv, league, classement) values ("Juventus", "Italy", "JUV", "Serie A", "2")');
        return DB::select("select * from equipes");
    }
    public function modifierPaysJuventus()
    {
        DB::statement('UPDATE equipes SET pays = "Espagnole" WHERE name = "Juventus"');
        return DB::select("SELECT * FROM equipes");
    }
    public function supprimerJuv()
    {
        //5)
        DB::delete('delete from equipes where name = ?', ["Juventus"]);
        return DB::select("select * from equipes");
    }
    public function equipesEtJoueurs()
    {
        //6)
        $equipes = DB::table('equipes')
        ->join('joueurs', 'equipes.id', '=', 'joueurs.equipe_id')
        ->select('equipes.*', 'joueurs.*')
        ->get();

        return $equipes;
    }
    public function equipesEsp()
    {
        //7)
        return DB::table('equipes')->where('pays', 'Espagne')->get();
    }
    public function JoueursSup() 
    {
        //8)
        return DB::table('joueurs')->where("age", ">=", 30)->get();
    }
    public function joueursMarqueMilieuArg()
    {
        //9)
        return DB::table('joueurs')
            ->where('but_equipe', '>=', 15)
            ->where('post', 'Milieu')
            ->where('nationalité', 'Argentine')
            ->get();
    }
    
    public function butesParEquipe()
    {
        // 10)
        return DB::table('equipes')
            ->join('joueurs', 'equipes.id', '=', 'joueurs.equipe_id')
            ->select('equipes.name', DB::raw('SUM(joueurs.but_equipe) as total_buts'))
            ->groupBy('equipes.name')
            ->get();
    }
    public function butesParEquipeEtPays()
    {
        //11)
        return
            DB::table('equipes')
            ->join('joueurs', 'equipes.id', '=', 'joueurs.equipe_id')
            ->select('equipes.pays', 'equipes.name', DB::raw('SUM(joueurs.but_equipe) as total_buts'))
            ->groupBy('equipes.pays', 'equipes.name')
            ->get();
    }
    public function butesParEquipeEtDefenseur()
    {
        // 12)
        return DB::table('equipes')
            ->join('joueurs', 'equipes.id', '=', 'joueurs.equipe_id')
            ->where('joueurs.post', '=', 'Defenseur')
            ->select('equipes.name', DB::raw('SUM(joueurs.but_equipe) as total_buts'))
            ->groupBy('equipes.name')
            ->get();
    }
    public function topScorersParEquipe()
    {
        //13)
        $teams = DB::table('equipes')->get();

        foreach ($teams as $team) {
            $topScorers = DB::table('joueurs')
                ->where('equipe_id', $team->id)
                ->orderBy('but_equipe', 'desc')
                ->limit(3)
                ->get();

            $team->topScorers = $topScorers;
        }

        return $teams;
    }
    public function topSoccer() 
    {
        //14)
        return DB::table('joueurs')
            ->orderBy('but_equipe', 'desc')
            ->limit(3)
            ->get();   ;
    }
    public function joueursParEquipeParAge()
    {
        //15)
        $equipes = DB::table('equipes')->get();

        foreach ($equipes as $equipe) {
            $joueurs = DB::table('joueurs')
                ->where('equipe_id', $equipe->id)
                ->orderBy('age', 'asc')
                ->get();

            $equipe->joueurs = $joueurs;
        }

        return $equipes;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table("equipes")->insert([
            "name" => $request->name,
            "pays" => $request->pays,
            "abv" => $request->abv,
            "league" => $request->league,
            "classement" => $request->classement
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return DB::table("equipes")->where("id", $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
