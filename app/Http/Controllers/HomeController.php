<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BlogPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   //DB facade to begin a query

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get current user using Helper
        $current_user = auth()->user();

        //query to get the current user's blog_posts from the database and keep them in $user_posts
        $userPosts = DB::table('blog_posts')
            ->where('user_id', $current_user->id)
            ->get();


        //a blogPost object to get access to the averageLengthWords function in BlogPostController
        $blogPosts = new BlogPostController();

        //
        $arrayWords = $this->storePostsToArrayWords($userPosts);

        //rendering to the home view 
        return view(
            'home',
            ['my_blog_posts' => $userPosts->reverse()->values()], //reverse() ---> to show newest to olderst posts
            ['average_posts' => $blogPosts->averageLengthWords($arrayWords)]  //get average length of the blog posts
        );
    }


    /**
     * storePostsToArrayWords
     * Push post's content into an array 
     * @param  mixed $posts contain all of current user's posts
     *
     * @return void
     */
    private function storePostsToArrayWords($posts)
    {
        $arrayWords = array();

        //for all of posts,
        //push only the content field in the new $arrayWords
        for ($i = 0; $i < count($posts); $i++) {
                array_push($arrayWords, $posts[$i]->content);
        }

        return $arrayWords;
    }
 
}
