<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules =  [
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:30',
        'username' => 'required|string|max:16|min:4',
        'nickname' => 'string|max:20',
        'description' => 'string|max:250',
        'school' => 'string',
        'school_level' => 'numeric',
        'sex' => 'numeric',
        'phone' => 'numeric',
        'email' => 'required|string|email',
        'password' => 'required|string|max:16|min:6',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'city' => 'numeric',
    ];
    protected $appends = [
        '_achievements',
        '_image'
    ];

    public function getSocialAttribute($value) {
        return json_decode($value); // convert "{}" to {}
    }
    public function getAchievementsAttribute() {
        return $this->achievements()->orderBy('created_at', 'DESC')->get();
    }
    public function getImageAttribute() {
        return $this->image();
    }

    // Relationships
    public function image() {
        // has one
        return Media::where('id', $this->image_id)->first();
    }
    public function courses() {
        return $this->hasMany(Course::class);
    }
    public function playlists() {
        return $this->hasMany(Playlist::class);
    }
    public function posts() {
        return $this->hasMany(Post::class);
    }
    public function postsLiked() {
        return $this->belongsToMany(Post::class, 'post_user_likes');
    }
    public function joinedLessons() {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }
    public function sharedCourses () {
        return $this->belongsToMany(Course::class,'course_user_shares')->withTimestamps()->withPivot('id');
    }
    public function achievements() {
        return $this->belongsToMany(Achievement::class)->withTimestamps();
    }
    public function joinedCourses() {
        return collect($this->joinedLessons->map(function($lesson){
            return $lesson->course;
        }));
    }
}
