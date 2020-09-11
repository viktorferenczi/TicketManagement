@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="float-right">
             ↓
            <button class="text-black-50" style="border: none; background-color:#f8fafc;" value="created_at"  id="created_at">Submission</button>
             ↓
            <button class="text-black-50" style="border: none; background-color:#f8fafc" value="due_date" id="due_date">Due date</button>
        </div>
        <h4>Tickets:</h4>
        <hr>
        <div id="taxList">
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
