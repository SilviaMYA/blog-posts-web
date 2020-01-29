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
        $user = auth()->user(); //get current user using Helper

        //query to get the current user's blog_posts from the database and keep them in $posts
        $user_posts = DB::table('blog_posts')
            ->where('user_email' , $user->email)
            ->get();

        //pass theese post to the home view
        return view('home', ['my_blog_posts' => $user_posts]);
    }
}
