<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {

    Route::group(['prefix' => 'ajax'], function () {
        Route::get('my-games-toggle/{id}', ['as' => 'match.my-games.toggle', 'uses' => 'MatchController@myGamesToggle']);
    });

    Route::group(['prefix' => 'leagues'], function () {
        Route::get('/', ['as' => 'leagues.home', 'uses' => 'LeagueController@all']);
        Route::get('create', ['as' => 'leagues.create', 'uses' => 'LeagueController@create']);
        Route::post('create', ['as' => 'leagues.create.post', 'uses' => 'LeagueController@postCreate']);
        Route::get('update/{id}', ['as' => 'leagues.update', 'uses' => 'LeagueController@update']);
        Route::post('update/{id}', ['as' => 'leagues.update.post', 'uses' => 'LeagueController@postUpdate']);
        Route::get('delete/{id}', ['as' => 'leagues.delete', 'uses' => 'LeagueController@delete']);
    });

    Route::group(['prefix' => 'matches'], function () {
        Route::get('/', ['as' => 'matches.home', 'uses' => 'MatchController@all']);
        Route::get('create', ['as' => 'matches.create', 'uses' => 'MatchController@create']);
        Route::post('create', ['as' => 'matches.create.post', 'uses' => 'MatchController@postCreate']);
        Route::get('update/{id}', ['as' => 'matches.update', 'uses' => 'MatchController@update']);
        Route::post('update/{id}', ['as' => 'matches.update.post', 'uses' => 'MatchController@postUpdate']);
        Route::get('duplicate/{id}', ['as' => 'matches.duplicate', 'uses' => 'MatchController@duplicate']);
        Route::post('duplicate/{id}', ['as' => 'matches.duplicate.post', 'uses' => 'MatchController@postDuplicate']);
        Route::get('delete/{id}', ['as' => 'matches.delete', 'uses' => 'MatchController@delete']);
    });

    Route::get('/', ['as' => 'search', 'uses' => 'HomeController@search']);
    Route::post('/', ['as' => 'search.post', 'uses' => 'HomeController@postSearch']);
    Route::get('my-games', ['as' => 'my-games', 'uses' => 'HomeController@myGames']);
//    Route::get('search', ['as' => 'search', 'uses' => 'HomeController@search']);
//    Route::post('search', ['as' => 'search.post', 'uses' => 'HomeController@postSearch']);
});
