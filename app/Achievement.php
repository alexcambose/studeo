<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    public $primaryKey = 'type';
    public $incrementing = false;

    protected $appends = [
        '_image'
    ];
    public function getImageAttribute(){
        return ['_filename' => 'images/achievements/'.$this->type.'.png'];
    }
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
