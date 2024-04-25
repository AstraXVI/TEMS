<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function auth_login(Request $request){

        // $user = User::where('username', $request->login_username)->first();

        // if(!$user){
        //     notyf()->position('y', 'top')->addError('Invalid Credential.');
        //     return redirect()->back()->withInput($request->input());
        // }
    
        // if ($user && $user->password === $request->login_password) {
        //     Auth::login($user);
        //     if($user->user_type_id == 1){
        //         return redirect()->intended('dashboard');
        //     }else if($user->user_type_id == 2){
        //         return redirect()->intended('dashboard_PM');
        //     }
        // } else {
        //     notyf()->position('y', 'top')->addError('Incorrect password, Please try again!');
        //     return redirect()->back()->withErrors(['login_error']);
        // }

        
        // check if user is exists
        $user = User::where('username', $request->login_username)->where('password', $request->login_password)->first();

        // condition if found and status is active or equivalent
        if(!$user) {
            // notyf()->position('y', 'top')->addError('Invalid Credential.');
            return redirect()->back()->withInput($request->input())->withError('invalid Credential');
        }

        // Logged
        Auth::login($user);

        if($user->user_type_id == 1){
            return redirect()->intended('dashboard')->withSuccess('Login Successfully');;
        }else if($user->user_type_id == 3 || $user->user_type_id == 4){
            return redirect()->intended('dashboard_PM')->withSuccess('Login Successfully');
        }

        // return redirect route;

    }


    public function auth_logout()
    {
        Auth::logout();
    
        return redirect('/');
    }

    public function datatables(Request $request) {
        $users = User::get();

        return DataTables::of($users)->toJson();
    }
    
}
