<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public static $rules = [
        'content' => 'required|string|max:120',
        'isTrue' => 'required|boolean'
    ];
}
