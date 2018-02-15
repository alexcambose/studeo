<?php

namespace App\Events;

use App\Course;
use App\Notifications\CourseIsFinished;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class CourseFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $course;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->user = Auth::user();
        $this->course = $course;


        // habar n-am daca e o idee buna sa le pun aici dar...
        $this->user->notify(new CourseIsFinished());
        $this->user->addXp($course->xp());
    }
}
