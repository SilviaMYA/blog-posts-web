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

        //query to get the current user's blog_posts from the database and keep them in $posts
        $user_posts = DB::table('blog_posts')
            ->where('user_id', $current_user->id)
            ->get();


        //a blogPost object to get access to the average function in BlogPostController
        $blogPosts = new BlogPostController();

        //rendering to the home view
        return view(
            'home',
            ['my_blog_posts' => $user_posts->reverse()->values()], //reverse() ---> to show newest to olderst posts
            ['average_posts' => $blogPosts->averageLengthWords($user_posts)]  //get average lenght of the blog posts
        );
    }
}
