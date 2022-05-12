<?php
use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'AppController'], function () {

/*
    |--------------------------------------------------------------------------
    | THIS SECTION FOR USER ROUTES
    |--------------------------------------------------------------------------
*/
//user login url
Route::post('userlogin', 'UserController@userlogin');

//user login with social url
Route::post('social_login', 'UserController@social_login');

//add support ticket url
Route::post('add_support_ticket', 'UserController@add_support_ticket');

//user support ticket list url
Route::post('get_all_ticket', 'UserController@get_all_ticket');

//user reply support ticket url
Route::post('reply_ticket', 'UserController@reply_ticket');

//user reply support ticket list url
Route::post('get_reply_support_ticket', 'UserController@get_reply_support_ticket');

//user registration mobile verification url
Route::post('mobile_verification', 'UserController@mobile_verification');

//user registration forget_otp_verification verification url
Route::post('forget_otp_verification', 'UserController@forget_otp_verification');

//user registration reset password verification url
Route::post('forget_password', 'UserController@forget_password');

//user registration url
Route::post('userregistration', 'UserController@userregistration');

//user update info url
Route::post('userinfoupdate', 'UserController@userinfoupdate');

//update password url
Route::post('/updatepassword', 'UserController@updatepassword');

//affiliate user url
Route::post('affiliateuserdata', 'UserController@affiliateUserData'); 

//update user info url
Route::post('/updatecustomerinfo', 'UserController@updatecustomerinfo');

// forget password otp url
Route::post('/processsendotp', 'UserController@processsendotp');

// forgot password url
Route::post('/processforgotpassword', 'UserController@processforgotpassword');

// user purchase history url
Route::post('/purchasehistory', 'OrderController@purchasehistory');

// user purchase history detail url
Route::post('/purchase_history_details', 'OrderController@purchase_history_details');

// user refund request 
Route::post('/refund_request', 'OrderController@refund_request');

// user canceled order 
Route::post('/canceled_order', 'OrderController@canceled_order');

// user refund request list
Route::post('/refund_list', 'OrderController@refund_list');

// user refund request image upload
Route::post('/upload_refund_image', 'OrderController@upload_refund_image');

//add wishlist url
Route::post('/addwishlist', 'ProductController@addwishlist');

//get wishlist url
Route::post('/getwishlist', 'ProductController@getwishlist');

//remove wishlist url
Route::post('/removewishlist', 'ProductController@removewishlist');

//user wallet history url
Route::post('/wallethistory', 'UserController@wallethistory');

//add to order
Route::post('/addtoorder', 'OrderController@addtoorder');

//add to tracking
Route::post('/tracking', 'OrderController@tracking');

//add address from user
Route::post('/addshippingaddress', 'UserController@addshippingaddress');

//get all user address
Route::post('/getalladdress', 'UserController@getalladdress');

//remove user address
Route::post('/removeaddress', 'UserController@removeaddress');

//set default user address
Route::post('/updatedefaultaddress', 'UserController@updatedefaultaddress');


/*
    |--------------------------------------------------------------------------
    | THIS SECTION FOR PRODUCTS ROUTES
    |--------------------------------------------------------------------------
*/

//get banners url
Route::get('/getbanners', 'ProductController@getbanners');

//get mobile banners url
Route::get('/getmobilebanners', 'ProductController@getmobilebanners');

//get mobile banners 1 url
Route::get('/getmobilebanners_two', 'ProductController@getmobilebanners_two');

//get mobile banners 2 url
Route::get('/getmobilebanners_three', 'ProductController@getmobilebanners_three');

//getAllProducts
Route::post('/getallproducts', 'ProductController@getallproducts');

//getAllcategory
Route::get('/get_all_category', 'ProductController@get_all_category');

//get variation product 
Route::post('/checkvartiation', 'ProductController@checkvartiation');

//get seller url
Route::get('/getallseller', 'UserController@getallseller');

//affiliate user payment config add / update
Route::post('/affiliatepaymentconfig', 'UserController@affiliatepaymentconfig');

//affiliate user payment history
Route::post('/affiliatepaymenthistory', 'UserController@affiliatepaymenthistory');

//check affiliate 
Route::post('/checkaffiliate', 'UserController@checkaffiliate');

//get brand url
Route::get('/getallbrands', 'ProductController@getallbrands');

//get category url 
Route::get('getcategories', 'CategoriesController@getcategories');

//get country url
Route::get('getcountries', 'LocationController@getcountries');

//get payment method
Route::get('getpaymentmethod', 'OrderController@getpaymentmethod');

//get all attribute
Route::get('getattributes', 'ProductController@getattributes');

//get all color
Route::get('getcolor', 'ProductController@getcolor');

//get all pages
Route::get('getallpages', 'ProductController@getallpages');

});
