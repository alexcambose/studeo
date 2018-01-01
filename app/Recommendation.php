<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Recommendation extends Model
{
    public $timestamps = false;
    public static function add($category){
        if (!Recommendation::where([ 'user_id' => Auth::id(), 'category' => $category ])->increment('count')) {
            $recommendation = new Recommendation();
            $recommendation->user_id = Auth::id();
            $recommendation->category = $category;
            $recommendation->save();
        }
    }
}
