<?php
// PC
Route::name('homepage')->get('/', 'Web\IndexController@index');
Route::name('about')->get('/about', 'Web\IndexController@about');
Route::name('services')->get('/services', 'Web\IndexController@services');
//Route::get('/services/{id}', 'Web\ServiceController@show');

// WAP
Route::get('/wap', 'Wap\IndexController@index');
Route::get('/wap/about', 'Wap\IndexController@about');
Route::get('/wap/category', 'Wap\IndexController@category');
Route::name('services')->get('/wap/services', 'Wap\IndexController@services');
//Route::get('/wap/services/{id}', 'Wap\ServiceController@show');

// 匹配自定义路由
Route::get('/{name}', 'Web\ServiceController@show');
Route::get('/wap/{name}', 'Wap\ServiceController@show');