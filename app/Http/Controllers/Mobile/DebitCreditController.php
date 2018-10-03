<?php

namespace App\Http\Controllers\Mobile;

use App\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DebitCreditController extends Controller
{
    public function index()
    {
        $collections = Collection::where('type', 4)->paginate(5);
        return view('mobile.debit_credit', compact('collections'));
    }
}
