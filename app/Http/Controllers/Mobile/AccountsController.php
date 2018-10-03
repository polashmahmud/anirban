<?php

namespace App\Http\Controllers\Mobile;

use App\Account;
use App\Collection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    public function branch()
    {
        return view('mobile.accounts.branch');
    }

    public function index(Request $request)
    {
        if ($request->type == 0) {
            $accounts = Account::with(['user:id,name','package'])->where([['status', 0], ['type', 0], ['branch', $request->branch]])->get();

        } elseif ($request->type == 1) {
            $accounts = Account::with(['user:id,name','package'])->where([['status', 0], ['type', 1], ['branch', $request->branch]])->get();
        } else {
            $accounts = Account::with(['user:id,name','package'])->where([['status', 0], ['type', 2]])->get();
        }

        return view('mobile.accounts.index', compact('accounts'));
    }

    public function show($id)
    {
        $account = Account::find($id);

        $collections = Collection::where('account_id', $id)->latest()->simplePaginate(10);

        return view('mobile.accounts.show', compact('collections', 'id', 'account'));
    }

    public function store(Request $request)
    {
        $account = Account::find($request->account_id);
        $last_date = Collection::with('account:amount')->where('account_id', $request->account_id)->get()->last();

        $date = $request->date ? $request->date : date('Y/m/d', strtotime("+1 day", strtotime($last_date->date)));
        $amount = $request->amount ? $request->amount : $account->amount;

        $collection = new Collection;
        $collection->account_id = $request->account_id;
        $collection->collect_by = Auth::id();
        $collection->date = $date;
        $collection->amount = $amount;
        $collection->description = "জমা দিয়েছেন";
        $collection->type = 1;
        $collection->save();

        return back();
    }
}
