<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Recommendations extends Model
{
    public $timestamps = false;
    public static function add($category){
        if (!Recommendations::where([ 'user_id' => Auth::id(), 'category' => $category ])->increment('count')) {
            $recommendation = new Recommendations();
            $recommendation->user_id = Auth::id();
            $recommendation->category = $category;
            $recommendation->save();
        }
    }
}
