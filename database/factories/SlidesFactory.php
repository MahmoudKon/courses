<?php

use App\Slides;
use Faker\Generator as Faker;

$factory->define(Slides::class, function (Faker $faker) {
    return [
        'name' => "home",
    ];
});
