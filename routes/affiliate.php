<?php

/*
|--------------------------------------------------------------------------
| Affiliate Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/affiliate', 'AffiliateController@index')->name('affiliate.index');
    Route::post('/affiliate/affiliate_option_store', 'AffiliateController@affiliate_option_store')->name('affiliate.store');
    //add : k :7-6-2020
    Route::get('/affiliate/store_Admin_affiliate_user/{userId}', 'AffiliateController@store_Admin_affiliate_user')->name('affiliate.admin_store');
    //add : k :13-6-2020
    Route::get('/affiliate/get_commision_logs/{userId}', 'CommisionLogController@get_commision_logs')->name('affiliate.get_commision_logs');
    //add : K 15-06-2020
    Route::get('/affiliate/tree_view/{id}', 'AffiliateController@treeview')->name('affiliate.tree_view');
    //add : k :11-6-2020
    Route::get('/affiliate/get_user_for_affiliate', 'AffiliateController@get_user_for_affiliate')->name('affiliate.get_user_for_affiliate');
    Route::get('/affiliate/configs', 'AffiliateController@configs')->name('affiliate.configs');
    Route::post('/affiliate/configs/store', 'AffiliateController@config_store')->name('affiliate.configs.store');

    Route::get('/affiliate/users', 'AffiliateController@users')->name('affiliate.users');
    //add : k :11-6-2020
    Route::get('/affiliate/subusers/{userId}', 'AffiliateController@sub_users')->name('affiliate.subusers');
    Route::get('/affiliate/verification/{id}', 'AffiliateController@show_verification_request')->name('affiliate_users.show_verification_request');

    Route::get('/affiliate/approve/{id}', 'AffiliateController@approve_user')->name('affiliate_user.approve');
	Route::get('/affiliate/reject/{id}', 'AffiliateController@reject_user')->name('affiliate_user.reject');
        

    Route::post('/affiliate/approved', 'AffiliateController@updateApproved')->name('affiliate_user.approved');

    Route::post('/affiliate/payment_modal', 'AffiliateController@payment_modal')->name('affiliate_user.payment_modal');
    Route::post('/affiliate/pay/store', 'AffiliateController@payment_store')->name('affiliate_user.payment_store');

    Route::get('/affiliate/payments/show/{id}', 'AffiliateController@payment_history')->name('affiliate_user.payment_history');
});

//FrontEnd
Route::get('/affiliate', 'AffiliateController@apply_for_affiliate')->name('affiliate.apply');
Route::post('/affiliate/store', 'AffiliateController@store_affiliate_user')->name('affiliate.store_affiliate_user');
Route::get('/affiliate/user', 'AffiliateController@user_index')->name('affiliate.user.index');
Route::get('/affiliate/commision_list', 'AffiliateController@commision_list')->name('affiliate.commision_list');

Route::get('/affiliate/payment/settings', 'AffiliateController@payment_settings')->name('affiliate.payment_settings');
Route::post('/affiliate/payment/settings/store', 'AffiliateController@payment_settings_store')->name('affiliate.payment_settings_store');
