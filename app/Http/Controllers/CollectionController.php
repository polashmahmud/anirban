<?php

namespace App\Http\Controllers;

use App\Account;
use App\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'lone') {
            $accounts = Account::with(['user:id,name','package'])->where([['status', 0], ['type', 0]])->get();
        } elseif ($request->type == 'saving') {
            $accounts = Account::with(['user:id,name','package'])->where([['status', 0], ['type', 1]])->get();
        } elseif ($request->type == 'investment') {
            $accounts = Account::with(['user:id,name','package'])->where([['status', 0], ['type', 2]])->get();
        } else {
            $accounts = Account::with(['user:id,name','package'])->where('status', 0)->get();
        }

        return view('collection.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = Account::find($request->account_id);
        $last_date = Collection::with('account:amount')->where('account_id', $request->account_id)->get()->last();
        $date = date('Y/m/d', strtotime("+1 day", strtotime($last_date->date)));

        $collection = new Collection;
        $collection->account_id = $request->account_id;
        $collection->collect_by = Auth::id();
        $collection->date = $date;
        $collection->amount = $account->amount;
        $collection->description = "জমা দিয়েছেন";
        $collection->type = 1;
        $collection->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        //
    }
}
