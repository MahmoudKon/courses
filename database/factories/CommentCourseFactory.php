<?php

use App\CommentCourse;
use Faker\Generator as Faker;

$factory->define(CommentCourse::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'user_id' => rand(1, 15),
        'course_id' => rand(1, 25),
    ];
});
