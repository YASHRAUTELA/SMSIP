<?php

use Faker\Generator as Faker;
use Hash;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $role=[1,2,3];
    $password=Hash::make('yashwant');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password, // secret
        'role_id' => array_random($role),
        'status' => 0,
        'remember_token' => str_random(10),
    ];
});
