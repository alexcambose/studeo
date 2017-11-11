<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    function toggle(Request $request){
        $notification = Auth::user()->notifications()->find($request->id);
        if($request->read){
            $notification->read_at = Carbon::now();
        } else {
            $notification->read_at = null;
        }
        $notification->save();

        return response()->json($notification);
    }
}
