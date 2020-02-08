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

$factory->define(\App\Comment::class, function (Faker\Generator $faker) {
    $title = $faker->title;
    return [
        'user_id' => rand(1, 50),
        'post_id' => rand(1, 50),
        'comment' => $faker->paragraph(1, true),
    ];
});
