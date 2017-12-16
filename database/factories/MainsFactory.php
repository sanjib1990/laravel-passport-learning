<?php

use App\Models\Main;
use Faker\Generator as Faker;

$factory->define(Main::class, function (Faker $faker) {
    return [
        'main'  => $faker->unique()->name
    ];
});
