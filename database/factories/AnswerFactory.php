<?php

use Faker\Generator as Faker;
use App\Models\Answer;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Answer::class, function (Faker $faker) {
    return [
      'text' => $faker->text
    ];
});
