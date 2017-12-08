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

    protected $appends = ['_image'];

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

    public function getSocialAttribute($value) {
        return json_decode($value); //convert "{}" to {}
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
    public function joinedLessons() {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }
    public function joinedCourses() {
        return $this->joinedLessons->map(function($lesson){
            return $lesson->course;
        });
    }
}
