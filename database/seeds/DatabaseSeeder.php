<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsCourseTableSeeder::class);
        $this->call(CommentsVideoTableSeeder::class);
        $this->call(CommentsPostTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(SlideImagesTableSeeder::class);
    }//end of run

}//end of seeder
