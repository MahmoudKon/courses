<?php

use App\CommentCourse;
use Illuminate\Database\Seeder;

class CommentsCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CommentCourse::class, 60)->create();
    }
}
