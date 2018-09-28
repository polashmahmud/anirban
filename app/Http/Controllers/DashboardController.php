<?php

namespace App\Http\Controllers;

use App\Account;
use App\Collection;
use App\Package;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $total_investment = Collection::where('type',2)->sum('amount');
        $total_lone = Collection::where('type',0)->sum('amount');
        $total_collection = Collection::where('type',1)->sum('amount');

        $done_account = Account::with('package')->where('status', 1)->get();
        $done_account_id = $done_account->pluck('id');
        $done_account_package_id = $done_account->pluck('package_id');
        $done_account_amount = Package::whereIn('id', $done_account_package_id)->sum('start_amount');
        $done_account_collection_amount = Collection::whereIn('id', $done_account_id)->sum('amount');
        $total_profit = $done_account_collection_amount - $done_account_amount;



        $cash_in_hands = Collection::with('user:id,name,phone')->selectRaw('sum(amount) amount, collect_by')->groupBy('collect_by')->get();

        return view('dashboard', compact('total_investment','cash_in_hands', 'total_lone', 'total_collection', 'total_profit'));
    }
}
