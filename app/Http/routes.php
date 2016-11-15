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
    return view('welcome');
});

//对外接口路由
// Route::group(['middleware' => ['ysp.interface'],'prefix'=>'openapi','namespace'=>'YspInterface'], function () {
Route::group(['prefix'=>'openapi','namespace'=>'YspInterface'], function () {
	Route::any('test', ['as' => 'test', 'uses' => 'DemandController@test']);
	Route::any('cache1', ['as' => 'test', 'uses' => 'DemandController@cache1']);
	Route::any('cache2', ['as' => 'test', 'uses' => 'DemandController@cache2']);
	Route::post('storeDemand', ['as' => 'storedemand', 'uses' => 'DemandController@storeDemand']);
});
// API 相关
Route::group(['prefix' => 'api', 'namespace' => 'Api'], function(){
    Route::any('router', 'RouterController@index');  // API 入口
});