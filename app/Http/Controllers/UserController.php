<?php

namespace App\Http\Controllers;
use App\Notifications\PasswordChanged;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function user() {
        $user = Auth::user();
        $user->notifications;

        return response()->json([
            'success' => !!$user,
            'user' => $user,
        ]);
    }

    function updateData(Request $request) {
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'first_name' => User::$rules['first_name'],
            'last_name' => User::$rules['last_name'],
            'username' => User::$rules['username'],
            'email' => User::$rules['email'],
        ]);
        if($validation->fails()) return response()->json(['success' => false]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    function updatePassword(Request $request) {
        $user = Auth::user();
        if(Hash::check($request->current_password, $user->password)) {
            $validation = Validator::make($request->all(), [
                'password' => User::$rules['password'],
            ]);
            if($validation->fails()) return response()->json(['success' => false]);

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::user()->notify(new PasswordChanged());
            return response()->json(['success' => true]);
        }


        return response()->json([
            'success' => false,
            'message' => trans('auth.failed'),
        ]);
    }

}