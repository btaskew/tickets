<?php

/** @var Factory $factory */

use App\Group;
use App\StaffUser;
use App\Ticket;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->define(StaffUser::class, function () {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'group_id' => function () {
            return factory(Group::class)->create()->id;
        },
    ];
});

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
