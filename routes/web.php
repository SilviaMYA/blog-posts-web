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

/*
* The login page is the home
*/
Route::get('/', function () {
    return view('auth/login');
});

/**View to show the new blog post form*/
Route::get('/new_post', function () {
    return view('blogPosts.createNewPost');
});

/**render to the BlogPostCOntroller and execute storePost function */
Route::post('create_post','BlogPostController@storePost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');