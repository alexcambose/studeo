<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static $rules = [
        'content' => 'required|string|max:2000',
        'is_private' => 'required|boolean'
    ];

    public function user() {
        $this->belongsTo(User::class);
    }
}
