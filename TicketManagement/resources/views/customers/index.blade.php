@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Customers:</h4>
        <hr>
       @foreach($customers as $customer)
           <div class="card mb-5">
               <div class="card-header">
                   <strong>Customer name:</strong> {{$customer->name}}
               </div>
               <div class="card-body">
                  <strong>Customer email address:</strong> {{$customer->email}}
                   <a class="btn btn-primary btn-dark float-right" href="/{{$customer->id}}/tickets">View Tickets</a>
               </div>
               <div class="card-footer">
                   <strong>Customer has:</strong> {$customer->ticketCount tickets submitted.
               </div>
           </div>
        @endforeach
        <div class="d-flex justify-content-center align-items-center">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
