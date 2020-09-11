@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="float-right">
            ↓
            <button class="text-black-50" style="border: none; background-color:#f8fafc;" value="{{$customer->id}}"  id="created_at_customer">Submission</button>
            ↓
            <button class="text-black-50" style="border: none; background-color:#f8fafc" value="{{$customer->id}}"  id="due_date_customer">Due date</button>
        </div>
        <h4>{{$customer->name}}'s Tickets</h4>
        <hr>
        <div id="customerTaxList">
            @foreach($tickets as $ticket)
                <div class="card mb-5">
                    <div class="card-header">
                        <strong>Ticket title:</strong> {{$ticket->title}}
                    </div>
                    <div class="card-body">
                        <strong>Ticket description:</strong> {{$ticket->description}}
                    </div>
                    <div class="card-footer">
                        <strong>Created at:</strong> {{$ticket->created_at}} - Duedate: {{$ticket->due_date}}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center align-items-center">
            {{ $tickets->links() }}
        </div>
    </div>
@endsection
