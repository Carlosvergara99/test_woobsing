<?php

namespace App\Http\Controllers;

use App\Notifications\CodeVerification;
use Illuminate\Http\Request;
// use Cookie;

class CodeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'codeveri']);
    }
    public function index()
    {
        return view('auth.codeVerification');

    }
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'integer|required',
        ]);

        $user = auth()->user();

        if($request->input('code') == $user->code)
        {
            $user->resetCode();

            // if ( $user->id_rol == 1 &&  $request->ip() == "127.0.0.1") {
            //     Cookie::queue('origin_sesion',60);
            // }
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(['code' => 'El codigo que ha introducido no coincide']);

    }
    public function resend(Type $var = null)
    {
        $user = auth()->user();
        $user->generateCode();
        $user->notify(new CodeVerification());

        return redirect()->back()->withMessage('The two factor code has been sent again');
    }

}

