<?php

use Illuminate\Database\Seeder;
use App\Models\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::truncate();
        factory(Answer::class, 50)->create();
    }
}
