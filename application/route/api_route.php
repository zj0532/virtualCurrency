<?php
use think\Route;
Route::post('/api/update','api/foot_menu/post_update');//管理员首页
Route::post('/api/trade','api/foot_menu/post_trade');//管理员首页

Route::get('/db','api/db/db');//数据表结构

?>
