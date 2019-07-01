<?php



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/product/view', 'ProductController@addproductview');
Route::post('/add/product/insert', 'ProductController@addproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('/edit/product/insert', 'ProductController@editproductinsert');
Route::get('/restore/product/{product_id}', 'ProductController@restoreproduct');
Route::get('/forcedelete/product/{product_id}', 'ProductController@forcedeleteproduct');




//frontend routs
Route::get('contact','FrontendController@contact');

Route::get('about','FrontendController@about');

Route::get('/','FrontendController@root');

Auth::routes();
Route::get('/product/details/{product_id}', 'ProductController@productdetails');