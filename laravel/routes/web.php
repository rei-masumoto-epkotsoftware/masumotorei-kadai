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

Route::get('/shop/clear_cart','shopController@clear_cart');
Route::get('/shop/kazu_change','shopController@kazu_change');
Route::post('/shop/kazu_change','shopController@kazu_change');
Route::get('/shop/member_login','shopController@member_login');
Route::post('/shop/member_login_check','shopController@member_login_check');
Route::get('/shop/member_logout','shopController@member_logout');
Route::get('/shop/shop_cartin','shopController@shop_cartin');
Route::get('/shop/shop_cartlook','shopController@shop_cartlook');
Route::get('/shop/shop_form','shopController@shop_form');
Route::post('/shop/shop_form_check','shopController@shop_form_check');
Route::get('/shop/shop_form_done','shopController@shop_form_done');
Route::post('/shop/shop_form_done','shopController@shop_form_done');
Route::get('/shop/shop_kantan_check','shopController@shop_kantan_check');
Route::get('/shop/shop_kantan_done','shopController@shop_kantan_done');
Route::post('/shop/shop_kantan_done','shopController@shop_kantan_done');
Route::get('/shop/shop_list','shopController@shop_list');
Route::get('/shop/shop_product','shopController@shop_product');