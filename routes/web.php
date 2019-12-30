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



Route::get('/login','AuthController@login');
Route::post('/login','AuthController@postLogin');
Route::get('/register','AuthController@register');
Route::post('/register','AuthController@postRegister');
Route::get('/logout','AuthController@logout');

Route::group(['middleware' => 'login'], function () {
    Route::get('/','HomeController@index');

    Route::get('/users','UserController@user');

    Route::get('/forum-account','ForumController@forum');

    Route::get('/forum-account','ForumController@forum');

    Route::post('/addForum','ForumController@addForum');

    Route::post('/addAccount','ForumController@addAccount');

    Route::get('/deleteForum/{id}','ForumController@deleteForum');

    Route::get('/deleteAccount/{id}','ForumController@deleteAccount');

    Route::get('/editAccount/{id}','ForumController@editAccount');
    Route::post('/editAccount/{id}','ForumController@postEditAccount');

    Route::get('/editForum/{id}','ForumController@editForum');
    Route::post('/editForum/{id}','ForumController@postEditForum');

    Route::get('/forum-extract','ForumController@forumExtract');
    Route::post('/postForumExtract','ForumController@postForumExtract');

    Route::get('/delForumOfUser/{id}','ForumController@delForumOfUser');

    Route::post('/updateStatusAccount','ForumController@updateStatusAccount');

    Route::get('/filter-account-by-forum/{id_forum}','ForumController@filterAccountByForum');
});















