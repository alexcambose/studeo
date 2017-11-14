<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules =  [
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:30',
        'username' => 'required|string|max:16|min:4',
        'nickname' => 'required|string|max:20|min:1',
        'sex' => 'required',
        'email' => 'required|string|email', //username-ul
        'password' => 'required|string|max:16|min:6',
    ];
}
