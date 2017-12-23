<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public static $rules = [
        'title' => 'required|string|min:4|max:100',
        'content' => 'required|string|min:4|max:1000',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
