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
 * Ticket submission
 */
Route::get('/ticket','TicketSubmissionController@index')->name('ticket.ticketSubmission.index');
Route::post('/ticket/create','TicketSubmissionController@create')->name('ticket.ticketSubmission.index');


/*
 * Ticket(s)
 */
Route::get('/tickets','TicketController@index')->name('ticket.ticketList.index');




/*
 * Admin verification
 */
Route::get('/adminpanel','AdminVerificationController@index')->name('admin.adminVerification.index');
Route::post('/adminpanel/verification','AdminVerificationController@create');

/*
 * Admin access
 */
Route::get('/adminpanel/index', 'AdminController@index')->name('admin.index');

Route::get('/customers','CustomerController@index')->name('customers.index');
//Route::get('/{customer}/ticketSubmission','')->name('customerTickets.index');

//Route::get('/ticketSubmission');

