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

Route::get('/','RabbitController@GoRabbitMap');

Route::get('/RabbitMap','RabbitController@GoRabbitMap');

Route::get('/Twitter','RabbitController@index');

Route::get('/CheckRad','RabbitController@distance');

Route::get('vendor/add','RabbitController@index');

Route::get('formatDate/{date}','RabbitController@ToDateFormat');

Route::get('twitterUserTimeLine', 'RabbitController@twitterUserTimeLine');
Route::post('tweet', ['as'=>'post.tweet','uses'=>'RabbitController@tweet']);