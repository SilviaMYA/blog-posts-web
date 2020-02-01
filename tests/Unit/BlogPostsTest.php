<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\HomeController;

class BlogPostsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAverageWordsBlogPosts()
    {

        $blogPost = new BlogPostController();

        //test 1
        //no words
        $arrayPosts = [];
        $result = $blogPost->averageLengthWords($arrayPosts);
        $this->assertEquals(0, $result);


        //test 2
        //one post with only one word
        $arrayPosts = ["Hello"];
        $result = $blogPost->averageLengthWords($arrayPosts);
        $this->assertEquals(1, $result);

         //test 3
        //one post with many words
        $arrayPosts = ["Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua"];
        $result = $blogPost->averageLengthWords($arrayPosts);
        $this->assertEquals(19, $result);


        //test 4
        //4 posts with more words
        $arrayPosts = [
            "Lorem ipsum dolor sit amet, consectetur adipiscing",
            "elit. Fusce non justo condimentum, pulvinar velit in, malesuada purus.",
            "Morbi augue nulla, dignissim tincidunt suscipit id, aliquam maximus metus. Pellentesque gravida accumsan",
            "pretium. Nulla facilisi. Maecenas velit mauris, euismod sed mauris vitae, scelerisque rutrum velit."
        ];
        $result = $blogPost->averageLengthWords($arrayPosts);
        $this->assertEquals(10.75, $result);
    }
}
