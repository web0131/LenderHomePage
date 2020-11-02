<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Player;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) : Response
    {
        // Search Filter
        $this->validate($request, [
            'search' => 'string|nullable'
        ]);

        $search = $request->get('search');
        $teams = Team::where('team_name', 'LIKE', '%'.$search.'%')
                          ->get();
        // Create HTTP response, 200 ok.
        $response = new Response($teams, Response::HTTP_OK);
        // Return HTTP response.
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : Response
    {
        $this->validate($request, [
            'team' => 'required|string',
        ]);

        $team_name = $request->get('team');

        $team = new Team;
        $team -> team_name = $team_name;
        $team->save();

        $response = new Response("Successfully added!", Response::HTTP_OK);
        return $response;
    }

    /**
     * Get the players from specified team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function detail(int $id) : Response
    {
        $players = Player::where('team_id', $id)->get();
        $team = Team::find($id);
        
        $response = new Response(['team'=>$team, 'players'=>$players], Response::HTTP_OK);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) : Response
    {
        Team::find($id)->delete();
        
        $response = new Response("Successfully deleted!", Response::HTTP_OK);
        return $response;
    }
}
