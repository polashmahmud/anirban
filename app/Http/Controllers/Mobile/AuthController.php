<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('mobile.login');
    }

    public function login(Request $request)
    {
        $phone = 88 . $request->phone;
        $password = $request->password;
        if (Auth::attempt(['phone' => $phone, 'password' => $password, 'status' => 1])) {
            return redirect('/mobile/dashboard');
        }
        return back()->withErrors('something is wring');
    }
}
