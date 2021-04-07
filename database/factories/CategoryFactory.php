<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'ar' => ['name' => 'Category ' . $faker->words(2, true)],
        'en' => ['name' => 'Category ' . $faker->words(2, true)],
        'es' => ['name' => 'Category ' . $faker->words(2, true)],
    ];
});
