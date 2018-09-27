<?php

namespace App\Http\Controllers;

use App\Account;
use App\Classes\Helper;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status', 1)->get();
        $packages = Package::where('status', 1)->get();
        $accounts = Account::with(['user:id,name', 'package:id,name'])->latest()->paginate(15);
        $account = new Account;
        $col_data=array();
        $col_heads = array('নাম', 'প্যাকেজ নাম', 'তারিখ', 'টাকা', 'স্টাটার্স', 'অপশন');

        foreach ($accounts as $value) {
            $form_url = route('account.destroy', $value->id);
            $edit_url = route('account.edit', $value->id);
            $status_change_url = route('status-change', $value->id);
            $col_data[] = array(
                $value->user->name,
                $value->package->name,
                $value->date,
                $value->amount,
                Helper::status_change($status_change_url, 'accounts', $value->id, 'status', $value->status, 'Done', 'Active', 'Account Status Change'),
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('account.index', compact('col_heads', 'col_data', 'users', 'packages', 'account', 'accounts'));
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
        $package = Package::find($request->package_id);

        if (isset($request->amount)) {
            $amount = $request->amount;
        } else {
            $amount = $package->collection_amount;
        }

        $account = new Account;
        $account->user_id = $request->user_id;
        $account->package_id = $request->package_id;
        $account->create_by = Auth::id();
        $account->date = $request->date;
        $account->amount = $amount;
        $account->status = 0;
        $account->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $users = User::where('status', 1)->get();
        $packages = Package::where('status', 1)->get();
        $accounts = Account::with(['user:id,name', 'package:id,name'])->latest()->paginate(15);
        $col_data=array();
        $col_heads = array('নাম', 'প্যাকেজ নাম', 'তারিখ', 'টাকা', 'স্টাটার্স', 'অপশন');

        foreach ($accounts as $value) {
            $form_url = route('account.destroy', $value->id);
            $edit_url = route('account.edit', $value->id);
            $status_change_url = route('status-change', $value->id);
            $col_data[] = array(
                $value->user->name,
                $value->package->name,
                $value->date,
                $value->amount,
                Helper::status_change($status_change_url, 'accounts', $value->id, 'status', $value->status, 'Done', 'Active', 'Account Status Change'),
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('account.index', compact('col_heads', 'col_data', 'users', 'packages', 'account', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $data = $request->all();

        $account->fill($data);
        $account->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        Session::flash('success', 'Success');
        return back();
    }
}
