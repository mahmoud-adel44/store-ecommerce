<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('dashboard.auth.login');
    }

    public function attempt(AdminLoginRequest $request)
    {
        $remember_me = $request->has('remember_me');
//        dd($remember_me);
        if (auth()->guard('admin')->attempt(['email'=> $request->email , 'password'=>$request->password] , $remember_me)){
            return redirect( route('admin.dashboard') ) ;
        };
        return redirect() -> back() ->with(['error' => 'هناك أخطا بالبيانات']);
    }


}
