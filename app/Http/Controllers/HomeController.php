<?php

namespace App\Http\Controllers;

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
            ->where('user_id' , $current_user->id)
            ->get();
            
        //rendering theese posts to the home view
        return view('home', ['my_blog_posts' => $user_posts]);
    }
}
