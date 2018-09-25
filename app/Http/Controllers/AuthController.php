<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $phone = preg_replace('/\s+/','',$request->phone);
        $password = $request->password;
        if (Auth::attempt(['phone' => $phone, 'password' => $password, 'status' => 1])) {
            return redirect('/dashboard');
        }
        return back()->withErrors('something is wring');
    }
}
