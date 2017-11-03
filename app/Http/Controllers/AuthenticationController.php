<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

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
                'error' => $validator->errors()
            ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => true,
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => trans('auth.failed')
        ]);
    }

    function logout(Request $request) {
        Auth::logout();
        return response()->json(['success' => true]);
    }

}
