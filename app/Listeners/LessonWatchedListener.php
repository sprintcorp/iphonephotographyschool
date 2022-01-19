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
//        Defined lessons achievement terms in an array data structure
        $achievement_lesson = [1,5,10,25,50];

//        Get total lessons watched by users
        $lesson_watched_achievements = $event->user->watched->count();

        // Check if numbers of lessons watched by users exists in the achievement lessons array data structure
        if(in_array($lesson_watched_achievements,$achievement_lesson)){

        // Get index of user's next lesson
            $next_lesson_index_value = array_search($lesson_watched_achievements, $achievement_lesson) + 1;

        // Checking to ensure the next achievement is still within the array length else set the
        // next achievement as last index value
            if ($next_lesson_index_value > count($achievement_lesson) - 1){
                $next_lesson_index_value = count($achievement_lesson)- 1;
            }

        // Get User's next comment value and concatenate with string
            $next_lesson_achievement = $achievement_lesson[$next_lesson_index_value]. ' Lessons Watched';

        // Check to know if user's lessons achievement is greater than one so as to store string representation (First)
        //  else store int value of achievement
            $achievement = $lesson_watched_achievements > 1 ? $lesson_watched_achievements. ' Lessons Watched' : 'First Lessons Watched';

//            Helper function to store achievement
            $achievement = new Achievement($event->user,$achievement,'lesson',$next_lesson_achievement);
            $achievement->unlock_achievement();
        }
    }
}
