<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    $status = $faker->randomElement(['single', 'in relation', 'married']);
    $role   = $faker->randomElement(['admin', 'user']);
    return [
        'name'      => $faker->name,
        'email'     => $faker->email,
        'address'   => $faker->address,
        'phone'     => $faker->phoneNumber,
        'password'  => bcrypt($faker->password),
        'birthday'  => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender'    => $gender,
        'status'    => $status,
        'role'      => $role,
        'image'     => rand(1, 18) . '.jpg',
    ];

    if($this->role == 'admin'){
        $this->attachRole('admin');
    }else{
        $this->attachRole('user');
    }
});
