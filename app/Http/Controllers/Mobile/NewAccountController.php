<?php

namespace App\Http\Controllers\Mobile;

use App\Account;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewAccountController extends Controller
{
    public function index()
    {
        $users = User::where('status', 1)->get();
        $packages = Package::where('status', 1)->where('id', '>', 1)->get();
        $accounts = Account::with(['user:id,name', 'package:id,name'])->latest()->paginate(5);

        return view('mobile.new_account', compact('users', 'packages', 'accounts'));
    }
}
