<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');
    
    $img = Image::make('img/1.png')->resize(300, 300);
    return $img->response();
});

//Route::get('/pc', function () {
//    return view('index');
//});

Route::get('/pc', "ItemController@index");

Route::get('pullitems/{major_type}/', "ItemController@pullitems")->where(["major_type" => "[0-9]+"]);

Route::get("item/{id}", "ItemController@click")->where(["id" => "[0-9]+"]);
