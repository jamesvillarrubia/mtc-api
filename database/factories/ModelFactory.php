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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
	$text = $faker->paragraph(3);
	$html = '<p>'.$text.'</p>';

    return [
        'text' => $text,
        'html' => $html,
        'title'=> $faker->sentence(4),
        'time'=> $faker->time('H:i:s','24:59:59')

    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
	$text = $faker->paragraph(2);
    return [
        'text' => $text,
    ];
});

$factory->define(App\ShortAnswer::class, function (Faker\Generator $faker) {
	$text = $faker->paragraph(2);
    return [
        'text' => $text,
        'rating' => $faker->numberBetween(700,1300),
    ];
});
