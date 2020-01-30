<?php

namespace App\Http\Controllers;

use App\BlogPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   //DB facade to begin a query


class BlogPostController extends Controller
{
    /**
     * storePost
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


    /**
     * deletePost
     * an user can delete their post in the database
     * @param  mixed $request
     * @param  mixed $idPost is the post to delete
     *
     * @return void
     */
    public function deletePost($post_id)
    {
       
      //get current user using Helper
      $current_user = auth()->user();

      //query to delete the post we have as parameter ands created by current_user 
      $post = DB::table('blog_posts')
          ->where('user_id' , $current_user->id)
          ->where('post_id' , $post_id)
          ->delete();

          return redirect('/');
    }
}
