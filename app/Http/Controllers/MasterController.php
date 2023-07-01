<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MasterController extends Controller
{
    function index()
    {
        return view('session/index');
    }
    function login(Request $request)
    {
        Session::flash('username', $request->username);
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (Auth::attempt($infologin)) {
            return redirect('dashboard')->with('success', 'Login Success!');
        } else {
            return redirect('session')->withErrors('Username and Password Invalid!');
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('session')->with('success', 'Success Logout!');
    }
}
