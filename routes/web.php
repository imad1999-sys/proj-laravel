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

Route::get('/redirect/{service}','SocialController@redirect');

Route::get('/callback/{service}','SocialController@callback');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
    Route::group(['prefix' => 'offers'],function(){
        Route::get('create','CrudController@create');
        Route::post('store','CrudController@store')->name('offers.store');

        Route::get('edit/{offer_id}','CrudController@editOffers');
        Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');

        Route::get('all','CrudController@getAllOffers')->name('offers.all');
        Route::get('youtube','CrudController@getVideo')->middleware('auth');
        Route::get('delete/{offer_id}','CrudController@deleteOffer')->name('offers.delete');
    });
});


/// Begin Ajax Routes
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
    Route::group(['prefix' => 'ajax-offers'],function(){
        Route::get('create','OfferController@createOffer');
        Route::post('save','OfferController@saveOffer')-> name('ajax.offers.store');

        Route::get('all','OfferController@getAllOffers')->name('ajax.offers.all');
        Route::post('delete','OfferController@deleteOffer')->name('ajax.offers.delete');

        Route::get('edit/{offer_id}','OfferController@editOffers')->name('ajax.offers.edit');
        Route::post('update','OfferController@updateOffer')->name('ajax.offers.update');
    });
});
/// End Ajax Routes

/// Start Authentication
    Route::get('adult','Auth\CustomAuthController@adult')->middleware('CheckAge');
/// End Authentication
///
///   ######### Begin Relations Routes #########
  Route::get('has-one','Relation\RelationsController@hasOneRelation');
  Route::get('has-one-reverse','Relation\RelationsController@hasOneRelationReverse');
  Route::get('get-users-has-phone','Relation\RelationsController@getUsersHasPhone');
  Route::get('get-users-not-has-phone','Relation\RelationsController@getUsersNotHasPhone');

  ########## One To Many #########
Route::get('hospital-to-many','Relation\RelationsController@getHospitalDoctors');
Route::get('hospitals','Relation\RelationsController@getHospitals');
Route::get('doctors/{hospital_id}','Relation\RelationsController@getDoctors')->name('hospital.doctors');
Route::get('hospital_has_doctors','Relation\RelationsController@getHospitalsHasDoctors');
Route::get('hospitals_has_doctors_male','Relation\RelationsController@getHospitalsHasDoctorsMale');
Route::get('hospitals_not_have_doctors','Relation\RelationsController@getHospitalsNotHaveDoctor');
//    ######### End Relations Routes ##########

