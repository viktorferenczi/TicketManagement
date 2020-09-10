@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h4>Tickets:</h4>
        <hr>
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
@endsection
