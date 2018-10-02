<?php

namespace App\Http\Controllers\Mobile;

use App\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $cash_in_hands = Collection::where('collect_by', Auth::id())->sum('amount');

        return view('mobile.dashboard', compact('cash_in_hands'));
    }
}
