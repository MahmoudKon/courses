<?php

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $status = $faker->randomElement(['active', 'unactive']);
    return [
        'title'       => $faker->sentence($nbWords = 10, $variableNbWords = true) ,
        'description' => $faker->text($maxNbChars = 10000),
        'tags'          => $faker->word . ',' . $faker->word,
        'status'        => $status,
        'user_id'       => rand(1,5),
        'category_id'   => rand(1, 10),
        'image'         => rand(1,25) . '.jpg',
    ];
});
