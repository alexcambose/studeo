<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Avatar extends Model
{
    public $primaryKey = 'type';
    public $incrementing = false;

    protected $appends = [
        '_image',
        '_owned',
    ];
    public function getImageAttribute(){
        return ['_filename' => 'images/avatars/'.$this->type.'.png'];
    }
    public function getOwnedAttribute(){
        return in_array($this->type, Auth::user()->avatars()->get()->pluck('type')->toArray());
    }

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
