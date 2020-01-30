<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPosts extends Model
{
    //
    public $table = 'blog_posts';
    public $fillable = ['user_id', 'title', 'content'];

    /**
     * To get user
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
