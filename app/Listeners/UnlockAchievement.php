<?php

namespace App\Listeners;

use App\Achievement;
use App\Events\CourseFinished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UnlockAchievement
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getNumber($achievement, $regex) {
        $match = [];
        preg_match($regex, $achievement, $match);
        return isset($match[1]) ? $match[1] : false;
    }

    public function handle($event)
    {
        $achievements = config('studeo.achievements');
        $user = $event->user;
        foreach ($achievements as $achievement) {
            $achievement = $achievement[0];
            if(!$user->achievements()->find($achievement)) { // daca nu exista deja
                // pentru _COURSE_FINISHED
                $number = $this->getNumber($achievement, '/([0-9]+)_COURSE_FINISHED/');
                if ($number && $user->finishedCourses()->count() >= $number) {
                    $user->unlockAchievement(Achievement::find($achievement));
                }

                // pentru BECAME_MENTOR
                if ($achievement === 'BECAME_MENTOR' && $user->role === 2) $user->unlockAchievement(Achievement::find($achievement));

                // pentru _COURSE_PUBLISHED
                $number = $this->getNumber($achievement, '/([0-9]+)_COURSE_PUBLISHED/');
                if ($number && $user->courses()->count() >= $number) {
                    $user->unlockAchievement(Achievement::find($achievement));
                }
            }
        }
    }
}
