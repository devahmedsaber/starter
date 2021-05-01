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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('redirect/{service}', 'SocialController@redirect');

Route::get('callback/{service}', 'SocialController@callback');

Route::get('fillable', 'CrudController@getOffers');

Route::get('dashboard', function (){
    return "Not Adult";
})->name('dashboard');



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['prefix' => 'offers'], function (){
            Route::get('create', 'CrudController@create')->name('offers.create');
            Route::post('store', 'CrudController@store')->name('offers.store');
            Route::get('edit/{offer_id}', 'CrudController@editOffer');
            Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
            Route::get('delete/{offer_id}', 'CrudController@delete')->name('offers.delete');
            Route::get('all', 'CrudController@getAllOffers')->name('offers.all');
        });

        Route::get('youtube', 'CrudController@getVideo')->middleware('auth');

});

################ Begin Ajax Routes #################
Route::group(['prefix' => 'ajaxoffers'], function (){
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');

    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');

    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@update')->name('ajax.offers.update');
});
################ End Ajax Routes #################

################ Start Middlewares Routes #################

Route::group(['namespace' => 'Auth', 'middleware' => 'CheckAge'], function (){
    Route::get('adaults', 'CustomAuthController@adault')->name('adault');
});

Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admins', 'Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');

################ End Middlewares Routes #################

###################### Start Relations Routes #########################
## One To One Relations
Route::get('hasOne', 'RelationsController@hasOneRelation');
Route::get('hasOneReverse', 'RelationsController@hasOneRelationReverse');
Route::get('getUserHasPhones', 'RelationsController@getUserHasPhones');
Route::get('getUserDoesntHavePhones', 'RelationsController@getUserDoesntHavePhones');
Route::get('getUserHasPhonesWithCond', 'RelationsController@getUserHasPhonesWithCond');
## One To Many Relations
Route::get('hospital-has-many', 'RelationsController@getHospitalDoctors');
Route::get('hospitals', 'RelationsController@hospitals')->name('hospitals.all');
Route::get('hospital/{hospital_id}', 'RelationsController@deleteHospital')->name('hospital.delete');
Route::get('doctors/{hospital_id}', 'RelationsController@doctors')->name('hospital.doctors');
Route::get('hospitalsHasDoctors', 'RelationsController@hospitalsHasDoctors');
Route::get('hospitalsHasMaleDoctors', 'RelationsController@hospitalsHasMaleDoctors');
Route::get('hospitalsNotHasDoctors', 'RelationsController@hospitalsNotHasDoctors');
## Many To Many Relations
Route::get('doctors-services', 'RelationsController@getDoctorServices');
Route::get('services-doctors', 'RelationsController@getServicesWithDoctor');
###################### End Relations Routes #########################












//Route::group(['prefix' => 'offers'], function (){
//    Route::get('create', 'CrudController@create');
//    Route::post('store', 'CrudController@store')->name('offers.store');
//});
