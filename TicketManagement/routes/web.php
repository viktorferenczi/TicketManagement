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
Route::get('/adminpanel','AdminController@adminVerification')->name('adminVerification.index');
Route::post('/adminpanel/verification','AdminController@verification')->name('adminVerification.verification');

/*
 * Admin
 */
Route::get('/adminpanel/index', 'AdminController@index')->name('admin.index');

//Route::get('/customers');
//Route::get('/tickets');

//Route::get('/{customer}/tickets');
