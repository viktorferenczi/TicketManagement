<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){

        $tickets = Ticket::paginate(5);

        return view('ticket.ticketList.index', compact('tickets'));
    }
}
