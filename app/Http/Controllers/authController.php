<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function getRegister(){
        return view('auth/register');
    }

    public function getLogin(){
        return view('auth/login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function postRegister(Request $request){

        $this->validate($request,[
           'name'=>'required|unique:users',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password'
        ]);

        $user = new User();

        $user -> name = $request['name'];
        $user -> password = bcrypt($request['password']);

        $user->save();
        return redirect()->route('login');
    }

    public function postLogin(Request $request){
        $this->validate($request,[
           'name'=>'required|exists:users',
            'password'=>'required',
        ]);

        $name = $request['name'];
        $password = $request['password'];

        if(Auth::attempt(['name'=>$name,'password'=>$password])){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }
}
