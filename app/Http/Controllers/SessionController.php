<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class SessionController extends Controller
{
    function index()
    {
        return view('session/index');
    }
    function login(Request $request)
    {
        FacadesSession::flash('username', $request->username);
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

    function register()
    {
        return view('session/register');
    }

    function create(Request $request)
    {
        FacadesSession::flash('name', $request->input('name'));
        FacadesSession::flash('username', $request->input('username'));

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'lisence' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];
        User::create($data);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if($request->lisence == 'meditrack') {
                return redirect('dashboard')->with('success', 'Login Success!');
            }
        }
        User::where('username', $request->username)->delete();
        return redirect('session/register')->withErrors('Lisence Invalid!');
    }
}
