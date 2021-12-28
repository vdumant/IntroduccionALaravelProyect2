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

use App\Post;
use App\User;

Route::get('/', function () {
    return view('post');
});

// clase Routes
Route::resource('pages', 'PageController'); // 7 rutas

// Route::resource('users', 'UserController')->middleware('auth', 'subscribed'); // 7 rutas

Route::post('post', 'PostController@store')->name('posts.store');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//clase eloquent
Route::get('eloquent', function () {
    $posts = Post::all();

    foreach ($posts as $post) {
        echo "$post->id $post->title <br>";
    }
});

Route::get('posts', function () {
    $posts = Post::all();

    foreach ($posts as $post) {
        echo "
        $post->id 
        <strong>{$post->user->get_name}</strong>
        $post->get_title <br>";
    }
});

Route::get('users', function () {
    $users = User::all();

    foreach ($users as $user) {
        echo "
        $user->id 
        <strong>{$user->get_name}</strong>
        {$user->posts->count()} posts<br>";
    }
});

Route::get('collections', function () {
    $users = User::all();

    // dd($users);
    dd($users->load('posts'));
});

Route::get('serialization', function () {
    $users = User::all();


    // dd($users->toArray());
    $user = $users->find(1);
    dd($user->toJson());
});
