<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Redirect to Login if user no logged in
 */
Route::get('/', array('before' => 'auth', 'uses' => 'HomeController@index'));

/**
* Route to render login page
*/
Route::get('/login', function () {
    return view('auth/login');
});


/**
* Route to render home page
*/
Route::get('/home', 'HomeController@index')->name('home');


/**
 * Route to show view to create the new blog post form
*/
Route::get('/new-post', function () {
    return view('blogPosts.createNewPost');
});


/**
 * render to the BlogPostController and execute storePost function
*/
Route::post('create-post', 'BlogPostController@storePost');


/**
 * render to the BlogPostController and execute deletePost function
*/
Route::get('delete-post/{post_id}', 'BlogPostController@deletePost');


Auth::routes();
