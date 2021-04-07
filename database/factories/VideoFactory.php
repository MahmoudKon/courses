<?php

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence($nbWords = 10, $variableNbWords = true) ,
        'description' => $faker->text($maxNbChars = 10000),
        'category_id' => rand(1, 10),
        'course_id'   => rand(1, 30),
        'tags'        => $faker->word . ',' . $faker->word,
        'video'       => rand(1, 8) . '.mp4',
    ];
});
