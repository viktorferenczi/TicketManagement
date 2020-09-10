<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(){

        $customers = DB::table('customers')
            ->join('tickets','customers.id' , '=', 'tickets.user_id')
            ->select('customers.id','customers.name','customers.email'
                    /*DB::raw('COUNT(CASE WHEN customers.id = tickets.user_id then 1 end) as ticketCount')*/)
            ->distinct() // make sure we return a single person once
            ->paginate(5);

        return view('customers.index', compact('customers'));
    }
}
