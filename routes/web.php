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
Route::get('/designer-pdf/{id}', 'PDFController@designer');

Route::get('/', 'HomeController@index');
Route::get('/otp', 'Auth\RegisterController@otp');
Route::post('/otp', 'Auth\RegisterController@submit_otp');
Route::get('/all-products', 'HomeController@products');
Route::get('/all-products/category/{id}', 'HomeController@category');
Route::get('/product/{id}', 'HomeController@showprod');    
Route::get('/allRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
});                  
Route::get('/messages/{id}', 'ChatController@getMessage')->name('message');    
Route::post('message', 'ChatController@sentMessage');  

Route::group(['middleware' => ['auth','user']], function(){
    Route::get('/invoice-pdf/{id}', 'PDFController@invoice');
    Route::get('/my-orders', 'HomeController@myorder');    
    Route::get('/my-customize', 'HomeController@myCustomize');    
    Route::get('/add-cart/{id}', 'CartController@addToCart');    
    Route::get('/cart', 'CartController@index');    
    Route::get('/update/{id}', 'CartController@update');    
    Route::get('/remove/{id}', 'CartController@getRemove');    
    Route::get('/checkout', 'CartController@getcheckout');    
    Route::post('/review/comment', 'ReviewController@store'); 
    Route::delete('/review/delete/{id}', 'ReviewController@delete'); 
    Route::resource('orders', 'OrdersController');
    Route::resource('customize', 'CustomController');
    Route::get('/item/{id}', 'HomeController@getItems'); 
    Route::get('/task-item/{id}', 'HomeController@getTaskItem'); 
    Route::get('/showorder/{id}', 'HomeController@getOrder');       
    Route::get('/showcustom/{id}', 'HomeController@getCustomize');       
    Route::get('/chat', 'ChatController@index');    
    Route::get('/deposit/{id}', 'CustomController@deposit');    
    Route::get('/fullpay/{id}', 'CustomController@fullpay');    
    Route::put('/pay-deposit/{id}', 'CustomController@paydeposit');    
    Route::put('/full-pay/{id}', 'CustomController@payall');    
    Route::get('/cancel-product/{id}', 'OrdersController@decline'); 
    Route::get('/decline-task/{id}', 'CustomController@cancel');      
    Route::get('/decline-deposit/{id}', 'CustomController@declineDeposit');      
    Route::get('/designers', 'HomeController@designers');     
    Route::get('/designer/{id}', 'HomeController@designerProduct');
    Route::get('/my-profile', 'HomeController@profile');
    Route::get('/my-profile-edit/{id}', 'HomeController@editprofile');
    Route::put('/my-profile-update/{id}', 'HomeController@updateprofile');
 
});

Route::group(['middleware' => ['auth','designer']], function(){
    Route::get('/designer', 'DesignerController@index');
    Route::delete('/user-delete/{id}', 'DesignerController@deleteuser');
    Route::get('/profile', 'DesignerController@profile');
    Route::get('/profile-edit/{id}', 'DesignerController@editprofile');
    Route::put('/profile-update/{id}', 'DesignerController@updateprofile');
    Route::get('/orders', 'OrdersController@orders');
    Route::get('/order/{id}', 'OrdersController@getOrder');
    Route::put('/update-order/{id}', 'OrdersController@updateOrder');
    Route::resource('products', 'ProductController');  
    Route::get('/tasks', 'CustomController@index');
    Route::get('/tasks/{id}', 'CustomController@getTask'); 
    Route::put('/accept', 'CustomController@accept'); 
    Route::put('/decline', 'CustomController@decline'); 
    Route::get('/products/delete/{id}', 'ProductController@destroy');
    Route::get('/chatd', 'ChatController@dindex');    
    Route::get('/task-deliver/{id}', 'CustomController@deliver');    
    Route::get('/order-deliver/{id}', 'OrdersController@deliver');    

});

Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('/chata', 'ChatController@aindex');    
    Route::get('/admin', 'AdminController@index');
    Route::get('/users', 'AdminController@users');
    Route::get('/atasks', 'AdminController@customizeTask');
    Route::get('/atask/{id}', 'AdminController@getTask'); 
    Route::get('/users-edit/{id}', 'AdminController@edituser');
    Route::put('/user-update/{id}', 'AdminController@updateuser');
    Route::delete('/user-delete/{id}', 'AdminController@deleteuser');
    Route::get('/aorders', 'AdminController@orders');
    Route::get('/aorder/{id}', 'AdminController@getOrder');
    Route::get('/check/aorder/{id}', 'AdminController@getOrder');
    Route::get('/aprofile', 'AdminController@profile');
    Route::get('/aprofile-edit/{id}', 'AdminController@editprofile');
    Route::put('/aprofile-update/{id}', 'AdminController@updateprofile');
    Route::get('/prodlist', 'AdminController@prodlist');
    Route::get('/prodlist/{id}', 'AdminController@show');
    Route::get('/report', 'ReportController@index');
    Route::post('/check', 'ReportController@checkReport');
    Route::get('/sales-pdf/{id?}/{year?}/{month?}/{day?}', 'PDFController@salesReport');
    Route::get('/report/atask/{id}', 'AdminController@getTask'); 
    Route::get('/report/aorder/{id}', 'AdminController@getOrder');
    Route::get('/user-sales-pdf/{id}','PDFController@designerSalesReport');
    Route::resource('categories','CategoryController');
    Route::get('categories/delete/{id}','CategoryController@destroy');
    Route::resource('slider','SliderController');
});

Auth::routes();