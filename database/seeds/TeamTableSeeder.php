<?php

use Illuminate\Database\Seeder;

use App\Models\Team;
use App\Models\Player;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Team::class, 2)->create()->each(function($u) {
            $u->players()->save(factory(Player::class)->make());
        });
    }
}
