@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center text-black-50">Ticket Manager Admin Panel.</h3>
    <p class="text-black-50">Please select one of the following options:</p>
    <ul>
        <li style="list-style-type: none">
            <a href="{{ route('customers.index') }}">View Customers</a>
        </li>
        <li style="list-style-type: none">
            <a href="{{ route('ticket.ticketList.index') }}">View Tickets</a>
        </li>
    </ul>
</div>
@endsection
