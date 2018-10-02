<?php

namespace App\Http\Controllers;

use App\Account;
use App\Collection;
use App\Package;
use App\User;
use Carbon\Carbon;
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

        // Chart
        $chart_report = Collection::selectRaw('
            year(date) year, 
            monthname(date) month, 
            sum(amount) amount'
        )
            ->where([["date",">", Carbon::now()->subMonths(6)], ['type', 1]])
            ->groupBy('year','month')
            ->orderBy('created_at', 'asc')
            ->get();

        $chart_month = $chart_report->pluck('month');
        $chart_amount = $chart_report->pluck('amount');

        // Today Collection
        $todayCollection = Collection::where([['date', Carbon::today()], ['type', 1]])->sum('amount');

        // Total User
        $total_user = User::count('id');


        return view('dashboard', compact('total_investment','cash_in_hands', 'total_lone', 'total_collection', 'total_profit', 'chart_amount', 'chart_month', 'todayCollection', 'total_user'));
    }
}
