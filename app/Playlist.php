<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    //
    protected $fillable = [
        'title', 'description',
    ];
    public static $rules = [
        'title' => 'required|max:30',
        'description' => 'required|max:500'
    ];
    protected $appends = [
        '_courses',
    ];

    public function getCoursesAttribute() {
        $courses = $this->courses()->get();

        return $courses->map(function ($user) {
            $params = ['user_id', 'id', 'title', 'short_description', 'image_id', 'pivot', '_user', '_image', '_lessons', 'slug'];
            return collect($user->toArray())->only($params)->all();
        });
    }

    // Relationships
    public function courses() {
        return $this->belongsToMany(Course::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
