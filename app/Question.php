<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static $rules = [
        'content' => 'required|string|max:120',
    ];
}
