<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ArchivistAuthController extends Controller
{
    public function getLogin(){
        if(auth()->user()){
            return redirect('archivist/dashboard');
        }

        return view('auth.login');
    }

    public function submitLogin(Request $request){
        $this->validate($request, [
            'email'=>'required|email'
        ]);

        $credentials = ['email'=>$request->email, 'password'=>$request->password,'role'=>'admin'];
        
        if(Auth::attempt($credentials)){
            return view('dashboard.index');
        }else{
            return redirect()->back()->with('danger','Incorrect email or password!');
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
