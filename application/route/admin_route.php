<?php
use think\Route;
Route::get('/admcncp/','admin/foot_menu/get_index');//管理员首页
Route::get('/admcncp/login','admin/login/get_login');//登陆页面


Route::post('/admcncp/login','admin/login/post_login');//登陆逻辑
Route::post('/admcncp/quit','admin/login/post_quit');//登陆逻辑

//用户路由
Route::get('/admcncp/index_add','admin/foot_menu/get_index_add');//管理员 添加
Route::post('/admcncp/index_add','admin/foot_menu/post_index_add');//管理员 添加
Route::get('/admcncp/indexEdit/:id','admin/foot_menu/get_index_edit');//管理员 编辑
Route::post('/admcncp/indexEdit/:id','admin/foot_menu/post_index_edit');//管理员 编辑




//顺风车
Route::get('/admcncp/free_ride/','admin/freeRide/get_free_ride_list');
Route::get('admcncp/free_rideAdd','admin/freeRide/get_free_ride_add');
Route::post('admcncp/free_rideAdd','admin/freeRide/post_free_ride_add');
Route::get('admcncp/free_rideEdit/:id/:page','admin/freeRide/get_free_ride_edit');
Route::post('admcncp/free_rideEdit/:id/:page','admin/freeRide/post_free_ride_edit');
Route::get('admcncp/free_rideDel/:id/:page','admin/freeRide/get_free_ride_del');


//联系我们
Route::get('admcncp/lxwm/:page','admin/foot_menu/get_lxwm_list');
Route::get('admcncp/lxwmEdit/:id/:page','admin/foot_menu/get_lxwm_edit');
Route::post('admcncp/lxwmEdit/:id/:page','admin/foot_menu/post_lxwm_edit');

//油费
Route::get('admcncp/oilFee','admin/oilFee/get_oilFee_list');
Route::get('admcncp/oilFeeAdd','admin/oil_fee/get_oilFee_add');
Route::post('admcncp/oilFeeAdd','admin/oil_fee/post_oilFee_add');
Route::get('admcncp/oilFeeEdit/:id','admin/oil_fee/get_oilFee_edit');
Route::post('admcncp/oilFeeEdit/:id','admin/oil_fee/post_oilFee_edit');
Route::get('admcncp/oilFeeDel/:id','admin/oil_fee/get_oilFee_del');

//消费
Route::get('admcncp/shopping','admin/shopping/get_shopping_list');
Route::get('admcncp/shoppingAdd','admin/shopping/get_shopping_add');
Route::post('admcncp/shoppingAdd','admin/shopping/post_shopping_add');
Route::get('admcncp/shoppingEdit/:id','admin/shopping/get_shopping_edit');
Route::post('admcncp/shoppingEdit/:id','admin/shopping/post_shopping_edit');
Route::get('admcncp/shoppingDel/:id','admin/shopping/get_shopping_del');

//易耗过期
Route::get('admcncp/etc','admin/etc/get_etc_list');
Route::get('admcncp/etcAdd','admin/etc/get_etc_add');
Route::post('admcncp/etcAdd','admin/etc/post_etc_add');
Route::get('admcncp/etcEdit/:id','admin/etc/get_etc_edit');
Route::post('admcncp/etcEdit/:id','admin/etc/post_etc_edit');
Route::get('admcncp/etcDel/:id','admin/etc/get_etc_del');

//加油表
Route::get('admcncp/come','admin/come/get_come_list');
Route::get('admcncp/comeAdd','admin/come/get_come_add');
Route::post('admcncp/comeAdd','admin/come/post_come_add');
Route::get('admcncp/comeEdit/:id','admin/come/get_come_edit');
Route::post('admcncp/comeEdit/:id','admin/come/post_come_edit');
Route::get('admcncp/comeDel/:id','admin/come/get_come_del');
?>
