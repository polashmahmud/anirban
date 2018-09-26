<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Http\Requests\UserRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $user = new User;
        $col_data=array();
        $col_heads = array('ছবি','নাম', 'ফোন', 'যোগদানের তারিখ', 'স্টাটাস', 'অপশন');

        foreach ($users as $value) {
            $form_url = route('user.destroy', $value->id);
            $edit_url = route('user.edit', $value->id);
            $show_url = route('user.show', $value->id);
            $status_change_url = route('status-change', $value->id);
            $imgUrl = asset($value->getFirstMediaUrl('avatar', 'small'));
            $col_data[] = array(
                "<img src=\"$imgUrl\" alt=\"\" style=\"width: 50px;\">",
                $value->name,
                $value->phone,
                $value->join,
                Helper::status_change($status_change_url, 'users', $value->id, 'status', $value->status, 'Active', 'Pending', 'User Status Change'),
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Show\" href=\"$show_url\"><i class=\"ti-user color-dark font-14\"></i></a> " .
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('user.index', compact('col_heads', 'col_data', 'user'));
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
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->join = $request->join;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        $user->password = Hash::make($request->password);

        $user->save();

        $profile = new Profile;
        $profile->user()->associate($user);
        $profile->save();


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
    public function edit(User $user)
    {
        $users = User::all();
        $col_data=array();
        $col_heads = array('ছবি','নাম', 'ফোন', 'যোগদানের তারিখ', 'স্টাটাস', 'অপশন');

        foreach ($users as $value) {
            $form_url = route('user.destroy', $value->id);
            $edit_url = route('user.edit', $value->id);
            $show_url = route('user.show', $value->id);
            $status_change_url = route('status-change', $value->id);
            $imgUrl = asset($value->getFirstMediaUrl('avatar', 'small'));
            $col_data[] = array(
                "<img src=\"$imgUrl\" alt=\"\" style=\"width: 50px;\">",
                $value->name,
                $value->phone,
                $value->join,
                Helper::status_change($status_change_url, 'users', $value->id, 'status', $value->status, 'Active', 'Pending', 'User Status Change'),
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Show\" href=\"$show_url\"><i class=\"ti-user color-dark font-14\"></i></a> " .
                "<a class='btn btn-default btn-xs m-r-5' data-toggle=\"tooltip\" data-original-title=\"Edit\" href=\"$edit_url\"><i class=\"ti-pencil-alt color-success font-14\"></i></a> " .
                Helper::delete_form($form_url, $value->id)
            );
        }

        return view('user.index', compact('col_heads', 'col_data', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->join = $request->join;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->hasFile('avatar')) {
            if ( ! empty($user->getFirstMediaUrl('avatar', 'small'))) {
                $user->clearMediaCollection('avatar');
            }
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('success', 'Success');
        return back();
    }
}
