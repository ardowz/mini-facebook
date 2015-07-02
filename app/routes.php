<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'welcome', 'uses' => 'HomeController@welcome'));

Route::get('/signup', array('as' => 'signup', 'uses' => 'UserController@signup'));
Route::post('/signupAction', array('as' => 'signupAction', 'uses' => 'UserController@signupAction'));

Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/loginAction', array('as' => 'loginAction', 'uses' => 'UserController@loginAction'));

Route::group(array('before' => 'auth'), function() {  
  
    Route::get('/home/{friend_user_id?}', array('as' => 'home', 'uses' => 'HomeController@home'));
    
    Route::post('/newPost', array('as' => 'newPost', 'uses' => 'PostController@newAction'));
  
    Route::post('/findUser', array('as' => 'findUser', 'uses' => 'FriendController@friends'));
    Route::post('/addFriendAction', array('as' => 'addFriendAction', 'uses' => 'FriendController@addFriendAction'));
    Route::get('/friends', array('as' => 'friends', 'uses' => 'FriendController@friends'));
});