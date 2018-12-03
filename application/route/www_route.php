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


//关于我们
Route::get('/cn/ibk','www/Ibk/company_introduction_cn');//ibk 公司介绍
Route::get('/cn/framework_cn','www/Ibk/framework_cn');//组织架构
Route::get('/cn/member_list_cn','www/ibk/member_list_cn');//重要成员列表
Route::get('/cn/member_info_cn','www/ibk/member_info_cn');//重要成员详情
Route::get('/cn/business_cn','www/Ibk/business_cn');//主营业务



Route::get('/cn/contentus','www/contentus/lian_xwm');//联系我们
Route::post('/contentus','www/contentus/post_contentus');//联系我们提交




?>
