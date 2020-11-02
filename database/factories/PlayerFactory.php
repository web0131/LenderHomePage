<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Player::class, function (Faker $faker) {
    return [
        'player_name' => $faker->name,
        'team_id' => factory(Team::class)->create()->id
    ];
});
