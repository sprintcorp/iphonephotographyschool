<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Services\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LessonWatchedListener
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

    /**
     * Handle the lesson watched event.
     *
     * @param  LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        $lesson_watched_achievements = count($event->user->watched);

        $achievement_lesson = [1,5,10,25,50];
        if(in_array($lesson_watched_achievements,$achievement_lesson)){
            $achievement = $lesson_watched_achievements > 1 ? $lesson_watched_achievements. ' Lessons Watched' : 'First Lessons Watched';
            $achievement = new Achievement($event->user,$achievement,'lessons');
            $achievement->unlock_achievement();
        }
    }
}
