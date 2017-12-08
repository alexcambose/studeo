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

    /*
     * Todo: Trebuie luate doar atributele necesare
     */
    public function getCoursesAttribute()
    {
        return $this->courses()->get();
    }

    // Relationships
    public function courses() {
        return $this->belongsToMany(Course::class);
    }
}
