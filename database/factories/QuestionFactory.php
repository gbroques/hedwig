<?php

use App\Models\Question;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Question::class, function (Faker $faker) {
    return [
        'text' => $faker->text
    ];
});
