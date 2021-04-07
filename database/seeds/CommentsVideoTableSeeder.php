<?php

use App\CommentVideo;
use Illuminate\Database\Seeder;

class CommentsVideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CommentVideo::class, 60)->create();
    }
}
