<?php

use App\SlideImages;
use Illuminate\Database\Seeder;

class SlideImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SlideImages::class, 3)->create();
    }
}
