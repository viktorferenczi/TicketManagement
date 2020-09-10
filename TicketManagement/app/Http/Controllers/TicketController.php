<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TicketController extends Controller
{
   public function index(){
       return view('ticket.index');
   }

   public function create(Request $request){
       $data = request()->validate([
           'name' => 'required|min:3|string',
           'email' => 'required|min:3|email',
           'title' => 'required|min:3|max:15',
           'description' =>'required|min:3|max:150',
       ]);

      // $date = Carbon::createFromFormat('Y.m.d', date('Y-m-d'));
      // $date = $date->addDays(1);

       $customer = new Customer();
       $ticket = new Ticket();
        //need to find the email if exists
       $customer->name = $data['name'];
       $customer->email = $data['email'];
       $customer->save();

       $customerID = Customer::max('id');

       $ticket->title = $data['title'];
       $ticket->description = $data['description'];
       $ticket->due_date = date('Y-m-d'); // due date logic
       $ticket->user_id = $customerID;
       $ticket->save();

       return redirect()->back()->with('message','Successful ticket submission!');



   }
}
