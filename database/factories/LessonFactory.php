<?php

use App\Models\Lesson;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'name' => 'Machine Learning Week 1',
        'slug' => 'machine-learning-week-1',
        'description' => 'Learn about the most effective machine learning techniques, and gain practice implementing them and getting them to work for yourself.',
        'youtube_playlist_id' => 'PLesiP49zG6smY2dky0yQdZ6zJYOGm2sVe',
        'course_id' => 1
    ];
});
