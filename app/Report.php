<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public static $rules = [
        'email' => 'required|string|email',
        'type' => 'required|numeric',
        'title' => 'required|string|max:200',
        'content' => 'required|string|max:2000|min:50',
    ];
}
