<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function inCourse(Course $course){
        $courses = $this->courses()->get();
        foreach ($courses as $theCourse)
            if($theCourse->id === $course->id) return true;
        return false;
    }

    public function courses() {
        return $this->belongsToMany(Course::class);
    }
}
