<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public static $rules = [
        'title' => 'required|max:40|min:10',
        'short_description' => 'required|max:240',
        'content' => 'required|string|max:4000',
        'questions' => [
            'content' => 'required|string|max:120|min:10',
            'answers' => [
                'content' => 'required|string|max:120|min:10',
                'is_true' => 'required|boolean',
            ],
        ],
        'order_index' => 'required|numeric',
        'thumbnail' => 'image|mimes:jpeg,png,jpg|max:10000000',
        'video' => 'mimes:mp4|max:100000000',
    ];
    protected $appends = [
        '_questions',
        '_thumbnail',
        '_video',
    ];
    public function getQuestionsAttribute(){
        return Question::where('lesson_id', $this->id)->get();
    }
    public function getThumbnailAttribute(){
        return Media::find($this->thumbnail_id);
    }
    public function getVideoAttribute(){
        return Media::find($this->video_id);
    }

    public function isUserJoined($id) {
        return $this->joinedUsers()->where('id', $id)->exists();
    }
    
    // Relationships
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function course() {
        return $this->belongsTo(Course::class);
    }
    public function joinedUsers() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
