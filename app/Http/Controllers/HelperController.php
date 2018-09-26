<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HelperController extends Controller
{
    public function statusChange(StatusChangeRequest $request)
    {
        $value = $request->value == 0 ? 1 : 0;

        DB::table($request->table)
            ->where('id', $request->id)
            ->update([$request->column => $value]);

        $message = $request->message;
        Session::flash('success', $message);
        return back();
    }
}
