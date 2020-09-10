@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        @foreach($tickets as $ticket)
            <div class="card">
                <div class="card-header">
                    {{$ticket->title}}
                </div>
                <div class="card-body">
                    {{$ticket->description}}
                </div>
                <div class="card-footer">
                    Created at:  {{$ticket->created_at}} - Duedate: {{$ticket->due_date}}
                </div>
            </div>
        @endforeach
    </div>
@endsection
