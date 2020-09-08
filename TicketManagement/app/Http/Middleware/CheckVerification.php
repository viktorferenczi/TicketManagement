<?php

namespace App\Http\Middleware;




class CheckVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request)
    {
        if (session('verification') == "") {
            return redirect('/adminpanel');
        }
        return redirect("/adminpanel/index");
    }
}
