<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    //
    protected $fillable = [
        'title', 'description',
    ];

    public static $rules = [
        'title' => 'required|max:30',
        'description' => 'required|max:500'
    ];
}
