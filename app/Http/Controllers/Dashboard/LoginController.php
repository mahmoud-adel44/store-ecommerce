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
//        dd(auth()->guard('admin')->attempt(['email'=>  $request->input("email") , 'password'=>$request->input("password")] , $remember_me));
        if (auth()->guard('admin')->attempt(['email'=> $request->email , 'password'=>$request->password] , $remember_me)){
            return redirect( route('admin.dashboard') ) ;
        };
        return redirect() -> back() ->with(['error' => 'هناك أخطا بالبيانات']);
    }

    public function thinker()
    {
        $admin = new App\Models\Admin();
        $admin->name = 'mahmoud';
        $admin->email = 'mahmoud@gmail.com';
        $admin->password = bcrypt('12345678');
        $admin->save();

    }


}
