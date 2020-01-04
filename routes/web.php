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

Route::view('/', 'home');
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
Route::get('/register', 'RegistrationController@show')->name('register')->middleware('guest');
Route::get('/login', 'LoginController@show')->name('login')->middleware('guest');

Route::post('/register', 'RegistrationController@register');
Route::post('/login', 'LoginController@authenticate');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', 'LoginController@logout');
    Route::get('/hotels', 'HotelController@index');

    Route::group(['prefix' => 'dashboard'], function() {
        Route::view('/', 'dashboard/dashboard');
        Route::get('reservations/create/{id}', 'ReservationController@create');
        Route::resource('reservations', 'ReservationController')->except('create');
    });
});

