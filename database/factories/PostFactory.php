<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence($nbWords = 10, $variableNbWords = true) ,
        'description' => $faker->text($maxNbChars = 10000),
        'image'       => rand(1, 25) . '.jpg',
        'tags'        => $faker->word . ',' . $faker->word,
        'user_id'     => rand(1,5),
        'category_id' => rand(1, 10),
    ];
});
