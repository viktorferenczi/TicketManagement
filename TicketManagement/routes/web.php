<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes(); //mentor access

Route::get('/', function () {
    return view('welcome'); //customer access
});

/*
 * Customer
 */
Route::get('/customers','CustomerController@index')->name('customers.index'); //mentor access

/*
 * Ticket submission
 */
Route::get('/ticket','TicketSubmissionController@index')->name('ticket.ticketSubmission.index'); //customer access
Route::post('/ticket/create','TicketSubmissionController@create');


/*
 * Tickets(s)
 */
Route::get('/tickets','TicketController@index')->name('ticket.ticketList.index'); //mentor access
Route::get('/{customer}/tickets','TicketController@show')->name('ticket.customerTickets.index'); //mentor access


/*
 * Admin verification
 */
Route::get('/adminpanel','AdminVerificationController@index')->name('admin.adminVerification.index'); //customer-mentor access
Route::post('/adminpanel/verification','AdminVerificationController@create');

/*
 * Admin panel
 */
Route::get('/adminpanel/index', 'AdminController@index')->name('admin.index'); //mentor access
