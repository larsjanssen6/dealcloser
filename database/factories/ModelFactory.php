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
$factory->define(\Spatie\Permission\Models\Permission::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'guard_name'        => 'web'
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Spatie\Permission\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'guard_name'        => 'web'
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Dealcloser\Core\User\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'              => $faker->name,
        'last_name'         => $faker->lastName,
        'function'          => $faker->jobTitle,
        'email'             => $faker->unique()->safeEmail,
        'password'          => $password ?: $password = bcrypt('secret'),
        'remember_token'    => str_random(10),
        'confirmation_code' => str_random(10),
    ];
});

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Dealcloser\Core\Settings\Settings::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->company,
        'email'         => $faker->email,
        'phone'         => $faker->phoneNumber,
        'description'   => $faker->title,
        'address'       => $faker->address,
        'zip'           => $faker->postcode,
        'city'          => $faker->city,
        'kvk'           => $faker->numberBetween(1, 10),
        'btw'           => $faker->numberBetween(1, 10),
    ];
});
