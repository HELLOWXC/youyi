<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
//建立一个资源路由
Route::resource('v1/admin','v1/admin');
//登录路由
Route::get('v1/login/openid','v1/Login/openid');
//注册路由
Route::post('v1/login/register','v1/Login/register');
//更改头像路由
Route::post('v1/login/changeAvatar','v1/Login/changeAvatar');
//加入购物车路由
Route::get('v1/cart/addToCart','v1/Cart/addToCart');
//购物车列表
Route::get('v1/cart/cartList','v1/Cart/CartList');
//商品资源路由
Route::resource('v1/goods','v1/Goods');
return [

];


