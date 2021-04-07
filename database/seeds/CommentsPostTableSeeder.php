<?php

use App\CommentPost;
use Illuminate\Database\Seeder;

class CommentsPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CommentPost::class, 70)->create();
    }
}
