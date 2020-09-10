@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h4>Customers:</h4>
        <hr>
       @foreach($customers as $customer)
           <div class="card mb-5">
               <div class="card-header">
                   <strong>Customer name:</strong> {{$customer->name}}
               </div>
               <div class="card-body">
                  <strong>Customer email address:</strong> {{$customer->email}}
               </div>
               <div class="card-footer">
                   <strong>Customer has:</strong> {$customer->ticketCount tickets submitted.
               </div>
           </div>
        @endforeach
    </div>
@endsection
