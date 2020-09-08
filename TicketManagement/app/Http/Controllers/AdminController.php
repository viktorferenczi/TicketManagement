<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function adminVerification(){
        return view("adminVerification.index");
    }

    public function index(){
        return view("admin.index");
    }

    public function verification(Request $request){
        $data = request()->validate([
            'accessCode' => 'required'
        ]);

        $token = $data['accessCode'];

        if (env('ADMIN_VERIFICATION') == $token){
            session(['verification' => $token]);
            return redirect('/login');
        }else {
            return redirect()->back()->with('message','Wrong verification code.');
        }
    }
}
