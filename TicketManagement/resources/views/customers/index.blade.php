@extends('layouts.app')

@section('content')
    <div class="container pt-5">
       @foreach($customers as $customer)
           <div class="card">
               <div class="card-header">
                   {{$customer->name}}
               </div>
               <div class="card-body">
                   {{$customer->email}}
               </div>
               <div class="card-footer">
                   Customer has: {$customer->ticketCount tickets submitted.
               </div>
           </div>
        @endforeach
    </div>
@endsection
