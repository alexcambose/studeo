<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public static $rules = [
        'title' => 'required|string|max:100|min:4',
        'slug' => 'required|string|max:100|min:4',
        'short_description' => 'required|string|max:240',
        'description' => 'required|string|max:4000',
        'difficulty' => 'required|numeric',
        'prerequisites' => 'array',
        'purpose' => 'required|string|max:2000',
        'purpose_what_will_learn' => 'array',
        'target_class_level' => 'required|numeric',
        'image' => 'image|mimes:jpeg,png,jpg|max:10000000',
    ];
    protected $appends = [
        '_image',
        '_user',
    ];
    public function getImageAttribute(){
        return Media::find($this->image_id);
    }
    public function getUserAttribute(){
        return User::find($this->user_id);
    }
    public function getPrerequisitesAttribute($value) {
        return json_decode($value);
    }
    public function getPurposeWhatWillLearnAttribute($value) {
        return json_decode($value);
    }
    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
    public function playlists() {
        return $this->belongsToMany(Playlist::class);
    }

}
