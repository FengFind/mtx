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
Route::get('/', function (){
    return redirect('http://www.alinewstar.com/home.html');
});

Route::get('/test', 'TestController@test');

/*
 * 后台
 */

Route::get('/admin/alimtxweixin',function (){//登录页面
    return view('admin/login');
})->name('adminLogin');

Route::post('admin/login','Admin\LoginController@login');//提交登录

//Route::namespace('Admin')->prefix('admin')->group(function (){
Route::namespace('Admin')->prefix('admin')->middleware('checkAdmin')->group(function (){
    Route::post('upload/img','IndexController@uploadImg');
    Route::get('loginOut','LoginController@loginOut');//退出登录
    //主页
    Route::get('index','IndexController@index')->name('adminIndex');//后台主页：显示行业数据
    Route::post('industry/update','IndustryController@update');//行业数据

    Route::get('enterpriseUser/index',function (){
        return view('admin/enterpriseUser');
    });//企业注册用户页面
    Route::get('enterpriseUser/list','EnterpriseUserController@index');
    Route::post('enterpriseUser/Update/{id}','EnterpriseUserController@update');//企业用户修改

    Route::get('product/index',function (){
        return view('admin/productList');
    });//产品列表
    Route::get('product/core/index',function (){
        return view('admin/productCoreList');
    });//产品列表
    Route::get('product/list','ProductController@index');//产品列表
    Route::post('product/update/{id}','ProductController@update');//产品修改
    Route::post('product/save','ProductController@save');//产品修改
    Route::post('product/delete/{id}','ProductController@delete');//产品删除

    Route::get('roll/index',function (){
        return view('admin/rolldata');
    });//滚动信息页面
    Route::get('roll/list','RollController@index');//滚动信息：列表
    Route::post('roll/update/{id}','RollController@update');//滚动信息：修改
    Route::post('roll/save','RollController@save');//滚动信息：修改
    Route::post('roll/delete/{id}','RollController@delete');//滚动信息：删除
});

/*
 * 前台
 */

Route::get('/home/login',function (){//登录页面
    return view('home/login');
})->name('homeLogin');

Route::get('/home/register',function (){//注册页面
    return view('home/register');
});

Route::post('/home/register','Home\LoginController@register');//注册
Route::post('/home/login','Home\LoginController@login');//登录


Route::namespace('Home')->prefix('home')->middleware('checkHome')->group(function (){
    Route::get('index','IndexController@index')->name('homeIndex');//主页
//    Route::get('industry','IndustryController@index');//行业数据
//    Route::get('roll','RollController@index');//滚动信息
    Route::get('product/service','ProductController@service');//服务类产品
    Route::get('product/serviceDetails/{id}','ProductController@serviceDetails');//服务类产品详情
    Route::get('product/core','ProductController@core');//核心产品
});