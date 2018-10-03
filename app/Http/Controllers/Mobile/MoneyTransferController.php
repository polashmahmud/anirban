<?php

namespace App\Http\Controllers\Mobile;

use App\Collection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoneyTransferController extends Controller
{
    public function index()
    {
        $users = User::where('role', '>', 0)->get();
        $transferAmounts = Collection::with(['user:id,name'])->where('type', 3)->latest()->paginate(15);

        return view('mobile.money_transfer', compact('users', 'transferAmounts'));
    }
}
