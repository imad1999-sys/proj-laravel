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
        Route::get('youtube','CrudController@getVideo');
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

