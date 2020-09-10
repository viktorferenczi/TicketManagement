<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(){

        $customers = DB::table('customers')
            ->join('ticketSubmission','customers.id' , '=', 'ticketSubmission.user_id')
            ->select('customers.name','customers.email'
                    /*DB::raw('COUNT(CASE WHEN customers.id = ticketSubmission.user_id then 1 end) as ticketCount')*/)
            ->distinct() // make sure we return a single person once
            ->get();

        return view('customers.index', compact('customers'));
    }
}
