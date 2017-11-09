<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\User;

class AuthenticationController extends Controller
{
    function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string', //username-ul
            'password' => 'required|string',
        ]);

        if ($validator->fails())
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => true,
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('auth.failed')
        ]);
    }

    function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'username' => 'required|string|max:16|min:4',
            'email' => 'required|string', //username-ul
            'password' => 'required|string',
        ]);
        if ($validator->fails())
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'success' => true,
            'user' => User::find($user->id),
        ]);
    }

    function logout(Request $request) {
        Auth::logout();
        return response()->json(['success' => true]);
    }

}