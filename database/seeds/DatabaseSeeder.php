<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $this->call(AnswersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
