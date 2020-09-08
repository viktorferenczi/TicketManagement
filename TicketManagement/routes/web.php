<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
 * Customer
 */
Route::get('/', function () {
    return view('welcome');
});

/*
 * Admin verification
 */
Route::get('/adminpanel','AdminVerificationController@adminVerification')->name('adminVerification.index');
Route::post('/adminpanel/verification','AdminVerificationController@verification')->name('adminVerification.verification');

/*
 * Admin
 */
Route::get('/adminpanel/index', 'AdminController@index')->name('admin.index');

//Route::get('/customers');
//Route::get('/tickets');

//Route::get('/{customer}/tickets');
