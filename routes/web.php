<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Middleware group to apply AUTH to diferent routes...
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // Add  all routes for Categories
    Route::resource('categories', 'CategoriesController');
    // Add all routes for Tags
    Route::resource('tags', 'TagsController');
    // Add all routes for Posts
    Route::resource('posts', 'PostsController');
    // TRASH
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
    // RESTORE TRASH
    Route::put('restore-posts/{post}', 'PostsController@restore')->name('restore-posts');
});
Route::middleware(['auth'])->group(function(){
    Route::get('users', 'UsersController@index')->name('users.index');
});