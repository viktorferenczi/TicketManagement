<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class TicketController extends Controller
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

       //case: customer registered already
       try {
           // find the user if he/she is already registered with checking email and name combo
           $customer = Customer::where(['email', '=', $data['email'],'name', '=', $data['name']])->firstOrFail();

           $ticket = new Ticket(); //create a new ticketSubmission for the customer in the DB
           $ticket->title = $data['title'];
           $ticket->description = $data['description'];
           $ticket->due_date = date('Y-m-d'); // due date logic
           $ticket->user_id = $customer->id;
           $ticket->save(); // save the ticketSubmission for the already registered customer

           //case: customer not registered yet
       } catch  (ModelNotFoundException $e){

           $customer = new Customer(); //create a new customer for the DB
           $ticket = new Ticket(); // create ticketSubmission for the customer for the DB
           $customer->name = $data['name'];
           $customer->email = $data['email'];
           $customer->save(); //save the customer in the DB

           $customerID = Customer::max('id'); //search the latest registered customer. Because of DB id incrementation,
                                             // our customer will be the one who has the highest id.

           $ticket->title = $data['title'];
           $ticket->description = $data['description'];
           $ticket->due_date = date('Y-m-d'); // due date logic
           $ticket->user_id = $customerID;
           $ticket->save(); // save the ticketSubmission related to the newly registered customer.

       }

       return redirect()->back()->with('message','Successful ticketSubmission submission!');



   }
}
