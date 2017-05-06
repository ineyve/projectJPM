<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'admin' => 0,
        'blocked' => 0,
        'print_evals' => 0,
        'print_counts' => 0,
        'department_id' => 1
    ];
});

$factory->define(App\Request::class, function (Faker\Generator $faker) {

    return [
        'owner_id' => 1,
        'status' => values(0,1),
        'admin' => 0,
        'blocked' => 0,
        'print_evals' => 0,
        'print_counts' => 0,
        'department_id' => 1
    ];
});
