<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public static $rules = [
        'title' => 'required|max:40|min:10',
        'shortDescription' => 'required|max:240',
        'content' => 'required|string|max:4000',
        'questions' => [
            'content' => 'required|string|max:120|min:10',
            'answers' => [
                'content' => 'required|string|max:120|min:10',
                'isTrue' => 'required|boolean',
            ],
        ],
        'order_index' => 'required|numeric',
        'thumbnail' => 'image|mimes:jpeg,png,jpg|max:10000000',
        'video' => 'mimes:mp4|max:100000000',
    ];
}
