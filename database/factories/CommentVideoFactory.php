<?php

use App\CommentVideo;
use Faker\Generator as Faker;

$factory->define(CommentVideo::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'user_id' => rand(1, 15),
        'video_id' => rand(1, 60),
    ];
});
