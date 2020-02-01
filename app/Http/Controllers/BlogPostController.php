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

        return redirect('home');
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
        DB::table('blog_posts')
            ->where('user_id', $current_user->id)
            ->where('post_id', $post_id)
            ->delete();

        return redirect('/');
    }



    /**
     * averageLengthWords
     * Calculates the average lenght of the blog posts belong to the current user
     * @param  mixed $arrayPosts is an array of words, contain all of current user's posts
     *
     * @return $average average lenght words
     */
    public static function averageLengthWords($arrayPosts)
    {

        //totalPost is the lenght of the arrayPost
        $totalPosts = count($arrayPosts);
        //calculate average if we have posts
        if ($totalPosts > 0) {

            $totalWords = 0;

            //get the number of word for each post and store them in $totalWords
            for ($i = 0; $i < count($arrayPosts); $i++) {
                $totalWords +=  str_word_count($arrayPosts[$i]);
            }
            $average = $totalWords / $totalPosts;
        } else {
            $average = 0;
        }

        return $average;
    }
}
