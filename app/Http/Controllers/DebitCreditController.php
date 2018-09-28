<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Collection;
use App\Http\Requests\DebitCreditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DebitCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::where('type', 4)->paginate(15);
        $collection = new Collection;
        $col_data=array();
        $col_heads = array('তারিখ', 'টাকা', 'বর্ণনা', 'অপশন');

        foreach ($collections as $value) {
            $form_url = route('debit-credit.destroy', $value->id);
            $edit_url = route('debit-credit.edit', $value->id);
            $col_data[] = array(
                $value->date,
                $value->amount,
                $value->description,
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('debit_credit.index', compact('col_heads', 'col_data', 'collection', 'collections'));
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
        $amount = $request->type==0 ? $request->amount * -1 : $request->amount;

        $collection = new Collection;
        $collection->account_id = 1;
        $collection->collect_by = Auth::id();
        $collection->date = $request->date;
        $collection->amount = $amount;
        $collection->description = $request->description;
        $collection->type = 4;
        $collection->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collections = Collection::where('type', 4)->paginate(15);
        $collection = Collection::find($id);
        $col_data=array();
        $col_heads = array('তারিখ', 'টাকা', 'বর্ণনা', 'অপশন');

        foreach ($collections as $value) {
            $form_url = route('debit-credit.destroy', $value->id);
            $edit_url = route('debit-credit.edit', $value->id);
            $col_data[] = array(
                $value->date,
                $value->amount,
                $value->description,
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('debit_credit.index', compact('col_heads', 'col_data', 'collection', 'collections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $collection = Collection::find($id);
        $collection->account_id = 1;
        $collection->collect_by = Auth::id();
        $collection->date = $request->date;
        $collection->amount = $request->amount;
        $collection->description = $request->description;
        $collection->type = 4;
        $collection->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Collection::find($id);
        $collection->delete();

        Session::flash('success', 'Success');
        return back();
    }
}
