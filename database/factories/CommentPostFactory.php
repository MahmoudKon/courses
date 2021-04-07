<?php

use App\CommentPost;
use Faker\Generator as Faker;

$factory->define(CommentPost::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'user_id' => rand(1, 15),
        'post_id' => rand(1, 25),
    ];
});
