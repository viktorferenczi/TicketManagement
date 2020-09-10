<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){

        $tickets = Ticket::all();

        return view('ticket.ticketList.index', compact('tickets'));
    }
}
