<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Player;

class PlayerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : Response
    {
        $this->validate($request, [
            'player' => 'required|string',
            'team_id' => 'required|integer'
        ]);

        $player_name = $request->get('player');
        $team_id = $request->get('team_id');

        $player = new Player;
        $player->player_name = $player_name;
        $player->team_id = $team_id; 
        $player->save();

        $response = new Response("Successfully added!", Response::HTTP_OK);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) : Response
    {
        $this->validate($request, [
            'player' => 'required|string',
        ]);

        $player = $request->get('player');

        Player::where('id', $id)
              ->update(['player_name' => $player]);

        $response = new Response("Successfully updated!", Response::HTTP_OK);
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
        Player::find($id)->delete();
        
        $response = new Response("Successfully deleted!", Response::HTTP_OK);
        return $response;
    }
}
