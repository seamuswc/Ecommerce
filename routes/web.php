<?php

//use App\Http\Middleware\stockcancel;

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
Route::get('/pending', 'AdminController@pending');
Route::get('/shipped', 'AdminController@shipped');
Route::get('/manage', 'AdminController@manage');

Route::post('/create', 'AdminController@create');
Route::get('/create', 'AdminController@goHome');

Route::get('/stock', 'AdminController@stock');
Route::get('/sent/{id}', 'AdminController@sent');

Route::get('/delete', 'AdminController@delete');
Route::get('/productDelete/{id}', 'AdminController@productDelete');

Route::get('/settings', 'SettingsController@index');
Route::post('/settings/updateBasicInfo', 'SettingsController@updateBasicInfo');
Route::post('/settings/updateGeminiKeys', 'SettingsController@updateGeminiKeys');
Route::post('/settings/updateNexmoKeys', 'SettingsController@updateNexmoKeys');

Route::post('/country/store', 'CountryController@store');
Route::delete('/country/delete/{id}', 'CountryController@delete');

Route::post('/carrier/store', 'CarrierController@store');
Route::delete('/carrier/delete/{id}', 'CarrierController@delete');


Route::middleware(['NotRegistered'])->group(function(){
  Route::get('/bluelogin', 'Auth\loginController@loginform')->name('loginform'); //login form
  Route::post('/bluelogin', 'Auth\loginController@login')->name('login'); //login in attempt
  Route::get('/logout', 'Auth\loginController@logout');
  Route::get('/', 'IndexController@index'); //Homepage
  Route::post('/payment', 'ShippingFormController@validateShippingForm'); //Checks Shipping Form
  Route::post('/checkpayment', 'PaymentController@check'); //PAYMENT CHECK
  Route::get('/payment/confirmed', 'PaymentController@confirmed');
});

Route::post('/register', 'Auth\registerController@register');
Route::get('/register', 'Auth\registerController@registerform')->middleware(['Registered']);

