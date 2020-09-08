<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("adminVerification.index");
    }

    public function verification(Request $request){
        $data = request()->validate([
            'accessCode' => 'required'
        ]);

        if (env('ADMIN_VERIFICATION') == $data['accessCode']){
           return redirect('/home');
        }else {
            return redirect()->back()->with('message','Wrong verification code.');
        }
    }
}
