<?php

namespace App\Http\Controllers\Mobile;

use App\Account;
use App\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvestmentController extends Controller
{
    public function index()
    {
        $accounts = Account::with(['user:id,name','package'])->where([['status', 0], ['type', 2]])->get();

        return view('mobile.investment', compact('accounts'));
    }

    public function show($id)
    {
        $collections = Collection::where('account_id', $id)->latest()->get();

//        return $collections;
    }
}
