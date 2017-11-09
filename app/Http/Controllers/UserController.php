<?php

namespace App\Http\Controllers;
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
        return response()->json([
            'success' => !!Auth::user(),
            'user' => Auth::user()
        ]);
    }

    function updateData(Request $request) {

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
            return response()->json(['success' => true]);
        }


        return response()->json([
            'success' => false,
            'message' => trans('auth.failed'),
        ]);
    }

}
