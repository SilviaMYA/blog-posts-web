<?php

namespace App\Http\Controllers;

use App\BlogPosts;
use Illuminate\Http\Request;
use DateTime;

class BlogPostController extends Controller
{
    /**
     * Function to add a new post to the database.
     * 
     * @return \Illuminate\Http\Response
     */
    public function storePost(Request $request)
    {
      
        // validate data from form
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
      
        // insert post to the database using BlogPosts model
        $post =  new BlogPosts();

        // Getting data from BlogPosts form fields
        $post->title = $request->title;
        $post->content = $request->content;

        //get the author of the post, that is the current user
        $current_user = auth()->user();

        //get user associate from BlogPost model
        $post->user()->associate($current_user);

        //save post in the database
        $post->save();

        //return redirect('home');
        return redirect()->route('home');
    }
}
