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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test/u','TestController@u');


Route::get('/goods/detail/{goods_id}','GoodsController@detail');    //商品详情
Route::get('/goods/getPrice','GoodsController@getPrice');       //获取商品价格信息

Route::get('log','Login\LogController@log');       //登录展示
Route::post('login','Login\LogController@login');       //登录curl
Route::post('apilog','Login\LogApiController@apilog');       //API登录
