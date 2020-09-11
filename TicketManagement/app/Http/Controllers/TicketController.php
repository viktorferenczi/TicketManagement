<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(){

        $tickets = Ticket::paginate(5);

        return view('ticket.ticketList.index', compact('tickets'));
    }

    //for one customer
    public function show($customerID){

        $customer = Customer::find($customerID);

        $tickets = DB::table('tickets')
        ->where('tickets.user_id' , "=", $customerID)
        ->paginate(5);

        return view('ticket.customerTickets.index',compact('tickets','customer'));
    }

    public function ticketListSort(Request $request){
        $sortPattern = $request['order'];
        $tickets = Ticket::orderBy($sortPattern, 'DESC')->get();

        return response()->json($tickets);
    }

    public function customerTicketsSort(Request $request){
        $sortPattern = $request['order'];
        $customer = $request['customer'];

        $tickets = DB::table('tickets')
        ->where('tickets.user_id', '=', $customer)
        ->orderBy($sortPattern, 'DESC')->get();

        return response()->json($tickets);
    }
}
