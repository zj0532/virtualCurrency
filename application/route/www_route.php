<?php
use think\Route;
//底部导航
Route::get('/notice','www/foot_menu/notice');//公告中心
Route::get('/use','www/foot_menu/terms_of_use');//使用条款
Route::get('/privacy','www/foot_menu/privacy');//隐私条款
Route::get('/rate','www/foot_menu/rate');//费率说明
    Route::get('/account','www/foot_menu/account');//充值多久到账
Route::get('/transaction','www/foot_menu/transaction');//交易指南
Route::get('/common','www/foot_menu/common');//常见问题



?>
