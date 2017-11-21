<?php

use App\Models\Question;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Question::class, function (Faker $faker) {
    return [
        'text' => $faker->text,
        'youtube_playlist_item_id' => 'UExlc2lQNDl6RzZzbVkyZGt5MHlRZFo2ekpZT0dtMnNWZS41NkI0NEY2RDEwNTU3Q0M2',
        'lesson_id' => 1
    ];
});
