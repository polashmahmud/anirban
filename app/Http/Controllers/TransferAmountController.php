<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Collection;
use App\TransferAmount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransferAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '>', 0)->get();
        $transferAmounts = Collection::with(['user:id,name'])->where('type', 3)->latest()->paginate(15);
        $transferAmount = new Collection;
        $col_data=array();
        $col_heads = array('নাম', 'তারিখ','টাকার পরিমান', 'বর্ণনা', 'অপশন');

        foreach ($transferAmounts as $value) {
            $form_url = route('transfer-amount.destroy', $value->id);
            $edit_url = route('transfer-amount.edit', $value->id);
            $col_data[] = array(
                $value->user->name,
                $value->date,
                $value->amount,
                $value->description,
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('transfer_amount.index', compact('col_heads', 'col_data', 'users', 'transferAmounts', 'transferAmount'));
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
        $user_from = User::find($request->user_from);
        $user_to = User::find($request->user_to);

        // User Form
        $collection = new Collection;
        $collection->account_id = 1;
        $collection->collect_by = $request->user_from;
        $collection->date = $request->date;
        $collection->amount = $request->amount * -1;
        $collection->description = $user_to->name .' কে ' . $request->amount .' টাকা দিয়েছেন' ;
        $collection->type = 3;
        $collection->save();

        // User To
        $collection = new Collection;
        $collection->account_id = 1;
        $collection->collect_by = $request->user_to;
        $collection->date = $request->date;
        $collection->amount = $request->amount;
        $collection->description = $user_from->name .' হতে ' . $request->amount .' টাকা পেয়েছেন' ;
        $collection->type = 3;
        $collection->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransferAmount  $transferAmount
     * @return \Illuminate\Http\Response
     */
    public function show(TransferAmount $transferAmount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransferAmount  $transferAmount
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferAmount $transferAmount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransferAmount  $transferAmount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransferAmount $transferAmount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransferAmount  $transferAmount
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferAmount $transferAmount)
    {
        //
    }
}
