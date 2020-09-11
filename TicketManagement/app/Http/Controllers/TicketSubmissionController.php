<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class TicketSubmissionController extends Controller
{
   public function index(){
       return view('ticket.ticketSubmission.index');
   }


   public function create(Request $request){
       //validate the incoming data
       $data = request()->validate([
           'name' => 'required|min:3|string',
           'email' => 'required|min:3|email',
           'title' => 'required|min:3|max:15',
           'description' =>'required|min:3|max:150',
       ]);

       try {
           $customer = Customer::where('email', '=', $data['email'])->firstOrFail(); //search for customer by email

           //case: impersonating
           if($customer->name != $data['name']){  //Error: email is used with another customer name
               return redirect()->back()->with('errorMessage','This email is already used by another customer with a different name.
                                                Please call our support or contact the email owner.');
           }

           //case: customer found safe and sound
           $ticket = new Ticket(); //create a new ticket for the customer in the DB
           $ticket->title = $data['title'];
           $ticket->description = $data['description'];
           $ticket->due_date = date('Y-m-d'); // due date logic
           $ticket->user_id = $customer->id;
           $ticket->save(); // save the ticket for the already registered customer


       } catch (ModelNotFoundException $e){

           $customer = new Customer(); //create a new customer for the DB
           $ticket = new Ticket(); // create ticketSubmission for the customer for the DB

           $customer->name = $data['name'];
           $customer->email = $data['email'];
           $customer->save(); //save the customer in the DB


           $customerID = Customer::max('id'); //search the latest registered customer. Because of DB id incrementation,
                                              //our customer will be the one who has the highest id.

           $ticket->title = $data['title'];
           $ticket->description = $data['description'];
           $ticket->due_date = date('Y-m-d'); // due date logic
           $ticket->user_id = $customerID;
           $ticket->save(); // save the ticket related to the newly registered customer.
       }
       return redirect()->back()->with('successMessage','Successful ticket submission!');
   }
}
