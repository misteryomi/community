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

$factory->define(\App\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1, 3),
        'title' => $faker->sentence(6, true),
        'details' => $faker->text(1000),
        'slug' => $faker->slug,
        'community_id' => rand(1, 3),
    ];
});
