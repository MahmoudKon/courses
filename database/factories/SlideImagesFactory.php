<?php

use App\SlideImages;
use Faker\Generator as Faker;

$factory->define(SlideImages::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence($nbWords = 6, $variableNbWords = true) ,
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'image'       => rand(1,3) . '.jpg',
        'slides_id'   => 1,
    ];
});
