<?php

use App\Models\Answer;
use App\Models\Question;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Answer::class, function (Faker $faker) {
    $questionId = factory(Question::class)->create()->id;
    return [
      'text' => $faker->text,
      'question_id' => $questionId
    ];
});
