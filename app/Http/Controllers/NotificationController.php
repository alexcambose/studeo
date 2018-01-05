<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    function notifications(Request $request){
        $notifications = Auth::user()->notifications();
        if($request->start !== null && $request->amount !== null) $notifications->skip((int)$request->start)->take((int)$request->amount);
        return response()->json([
            'success' => true,
            'notifications' => $notifications->get(),
            'notificationsCount' => Auth::user()->notifications()->count(),
            'unreadNotificationsCount' => Auth::user()->notifications()->where('read_at', null)->count(),
        ]);
    }
    function toggle(Request $request){
        $notification = Auth::user()->notifications()->find($request->id);
        if($request->read){
            $notification->markAsRead();
        } else {
            $notification->read_at = null;
        }
        $notification->save();

        return response()->json([
            'success' => true,
            'notification' => $notification,
            'unreadNotificationsCount' => Auth::user()->notifications()->where('read_at', null)->count(),
        ]);
    }
    function toggleReadAll(){
        $notifications = Auth::user()->notifications;

        $shouldMarkAsRead = Auth::user()->notifications()->where('read_at', null)->count();

        foreach ($notifications as $notification) {
            if($shouldMarkAsRead) {
                $notification->markAsRead();
            } else {
                $notification->read_at = null;
            }
            $notification->save();
        }
        return response()->json([
            'success' => true,
            'readAll' => !!$shouldMarkAsRead,
        ]);
    }
}
