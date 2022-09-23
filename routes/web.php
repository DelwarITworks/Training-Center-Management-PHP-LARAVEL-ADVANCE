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

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin','auth']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	//category routes=============
	Route::get('category','Category\CategoryController@index')->name('category');
	Route::post('save/category','Category\CategoryController@saveCategory')->name('save.category');
	Route::get('change/category/{id}','Category\CategoryController@changeCategory')->name('change.category');
	Route::post('update/category/{id}','Category\CategoryController@updateCategory')->name('update.category');
	Route::get('delete/category/{id}','Category\CategoryController@deleteCategory')->name('delete.category');
	
	//brand routes==============
	Route::get('brand','Brand\BrandController@index')->name('brand');
	Route::post('save/brand','Brand\BrandController@store')->name('save.brand');
	
	//sub-category==============
	Route::get('sub-category','Category\CategoryController@subCate')->name('subcategory');
	Route::post('save/subcategory','Category\CategoryController@saveSubcategory')->name('save.subcategory');
	
	//cupon
	Route::get('cupons','Cupon\CuponController@cupons')->name('cupons');
	Route::post('save/cupon','Cupon\CuponController@saveCupon')->name('save.cupon');
	Route::get('delete/cupon/{id}','Cupon\CuponController@deleteCupon')->name('delete.cupon');

	//products
	Route::get('add/product','ProductController@index')->name('add.product');
	Route::get('get/subcategory/{category_id}','ProductController@GetSubcat');
	Route::post('new/product','ProductController@newProduct')->name('new.product');
	Route::get('all/product','ProductController@allProduct')->name('all.product');
	Route::get('show/product/{id}','ProductController@showProduct')->name('show.product');
	Route::get('deactive/product/{id}','ProductController@deactiveProduct')->name('deactive.product');
	Route::get('active/product/{id}','ProductController@activeProduct')->name('active.product');
	Route::get('delete/product/{id}','ProductController@deleteProduct')->name('delete.product');
	Route::get('udpate/product/{id}','ProductController@updateProduct')->name('change.product');
	Route::post('update/without-image/{id}','ProductController@updateWithoutImage')->name('update.withoutimage');
	Route::post('update/with-image/{id}','ProductController@updateWithImage')->name('update.withimage');

	//Post routes
	Route::get('post/category','PostController@index')->name('post.category');
	Route::post('save/post/category','PostController@newPost')->name('savepost.category');
	Route::get('change/post-category/{id}','PostController@changePostCat')->name('change.postcategory');
	Route::post('update/post-category/{id}','PostController@updatePostCat')->name('update.postcategory');
	Route::get('post/all','PostController@AllPost')->name('all.post');
	Route::get('post/create','PostController@CreatePost')->name('create.post');
	Route::post('post/new','PostController@SavePost')->name('new.post');
	
});
	
Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User','middleware'=>['user','auth']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
