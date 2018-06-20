<?php
Route::get('/', function () {
   return 'Api works';
});

// 视频管理
Route::get('videos', 'Api\VideoController@index');
Route::post('videos/create', 'Api\VideoController@store');
