<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function customerList(){

        $customers = DB::table('customers')
            ->join('tickets','customers.id' , '=', 'tickets.user_id')
            ->select('customers.name','customers.email'
                    /*DB::raw('COUNT(CASE WHEN customers.id = tickets.user_id then 1 end) as ticketCount')*/)
            ->distinct()
            ->get();

        return view('customers.customerList', compact('customers'));
    }
}
