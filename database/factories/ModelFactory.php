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
        'admin' => $faker->numberBetween(0,1),
        'blocked' => $faker->numberBetween(0,1),
        'print_evals' => $faker->numberBetween(0,100),
        'print_counts' => $faker->numberBetween(0,100),
        'department_id' => $faker->numberBetween(1,5),
    ];
});

$factory->define(App\Request::class, function (Faker\Generator $faker) {

    return [
        'description' => $faker->sentence(4),
        'owner_id' => $faker->numberBetween(2,20),
        'status' => $faker->numberBetween(-1,3),
        'open_date' => $faker->dateTimeThisMonth,
        'quantity' => $faker->numberBetween(1,100),
        'colored' => $faker->numberBetween(0,1),
        'stapled' => $faker->numberBetween(0,1),
        'satisfaction_grade' => $faker->numberBetween(1,5),
        'paper_size' => $faker->numberBetween(3,5),
        'paper_type' => $faker->numberBetween(0,1),
        'file' => $faker->name
    ];
});

$factory->define(App\Department::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company
    ];
});

$factory->define(App\Printer::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company
    ];
});