<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Http\Requests\PackageRequest;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::paginate(15);
        $package = new Package;
        $col_data=array();
        $col_heads = array('নাম', 'শুরুর টাকা', 'শেষের টাকা', 'কিস্তি টাকা', 'সময়', 'টাইপ', 'ধরন', 'স্টাটার্স', 'অপশন');

        foreach ($packages as $value) {
            $form_url = route('package.destroy', $value->id);
            $edit_url = route('package.edit', $value->id);
            $status_change_url = route('status-change', $value->id);
            $col_data[] = array(
                $value->name,
                $value->start_amount,
                $value->end_amount,
                $value->collection_amount,
                "$value->installment টি কিস্তি",
                Helper::packageType($value->type),
                Helper::packagePeriod($value->period),
                Helper::status_change($status_change_url, 'packages', $value->id, 'status', $value->status, 'Active', 'Pending', 'Package Status Change'),
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('package.index', compact('col_heads', 'col_data', 'package', 'packages'));
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
    public function store(PackageRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        Package::create($data);

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $packages = Package::paginate(15);
        $col_data=array();
        $col_heads = array('নাম', 'শুরুর টাকা', 'শেষের টাকা', 'কিস্তি টাকা', 'সময়', 'টাইপ', 'ধরন', 'স্টাটার্স', 'অপশন');

        foreach ($packages as $value) {
            $form_url = route('package.destroy', $value->id);
            $edit_url = route('package.edit', $value->id);
            $status_change_url = route('status-change', $value->id);
            $col_data[] = array(
                $value->name,
                $value->start_amount,
                $value->end_amount,
                $value->collection_amount,
                "$value->installment টি কিস্তি",
                Helper::packageType($value->type),
                Helper::packagePeriod($value->period),
                Helper::status_change($status_change_url, 'packages', $value->id, 'status', $value->status, 'Active', 'Pending', 'Package Status Change'),
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('package.index', compact('col_heads', 'col_data', 'package', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $data = $request->all();

        $package->fill($data);
        $package->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        Session::flash('success', 'Success');
        return back();
    }
}
