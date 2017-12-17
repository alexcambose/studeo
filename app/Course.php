<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    public static $rules = [
        'title' => 'required|string|max:100|min:4',
        'slug' => 'required|string|unique:courses|max:100|min:4',
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
        '_tags',
        '_joined',
        '_user',
    ];
    public function getImageAttribute(){
        return Media::find($this->image_id);
    }
    public function getTagsAttribute(){
        return $this->tags()->get();
    }
    public function getUserAttribute(){
        return User::find($this->user_id);
    }
    public function getJoinedAttribute(){
        if($this->isUserJoined(Auth::user())){
            return [
                'users' => count($this->joinedUsersArray()),
                'notes' => $this->notes()->orderBy('created_at', 'DESC')->get(),
            ];
        }
        return false;
    }
    public function getPrerequisitesAttribute($value) {
        return json_decode($value);
    }
    public function getPurposeWhatWillLearnAttribute($value) {
        return json_decode($value);
    }

    public function joinedUsersArray() {
        $lessons = $this->lessons()->get();
        $users = [];
        foreach ($lessons as $lesson){
            $joinedUsers = $lesson->joinedUsers;
            foreach ($joinedUsers as $joinedUser) $users[] = $joinedUser;
        }
        return $users;
    }
    public function isUserJoined(User $user) {
        $usersJoined = $this->joinedUsersArray();
        foreach ($usersJoined as $userJoined) {
            if($userJoined['id'] === $user->id) return true;
        }
        return false;
    }

    // Relationships
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
    public function notes() {
        return $this->hasMany(Note::class);
    }
    public function playlists() {
        return $this->belongsToMany(Playlist::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
