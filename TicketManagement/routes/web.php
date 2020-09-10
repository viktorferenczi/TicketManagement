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
 * Ticket(s)
 */
Route::get('/ticket','TicketController@index')->name('ticketSubmission.index');
Route::post('/ticket/create','TicketController@create')->name('ticketSubmission.index');

Route::get('/tickets','TicketController@list')->name('ticket.ticketList.index');




/*
 * Admin verification
 */
Route::get('/adminpanel','AdminVerificationController@index')->name('adminVerification.index');
Route::post('/adminpanel/verification','AdminVerificationController@create');

/*
 * Admin access
 */
Route::get('/adminpanel/index', 'AdminController@index')->name('admin.index');

Route::get('/customers','CustomerController@index')->name('customers.index');
//Route::get('/{customer}/ticketSubmission','')->name('customerTickets.index');

//Route::get('/ticketSubmission');

