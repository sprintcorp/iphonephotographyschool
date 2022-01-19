<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use App\Services\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentWrittenListener
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
     * Handle the comment written event.
     *
     * @param  CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {
        // Defined comment achievement terms in an array data structure
        $achievement_comment = [1,3,5,10,20];

        // Get total comment watched by users
        $comment_written = $event->user->comments->count();

        // Check if numbers of comment by users exists in the achievement comment array data structure
        if(in_array($comment_written,$achievement_comment)){

            // Get index of user's next comment
            $next_comment_achievement_index_value =  array_search($comment_written, $achievement_comment) + 1;

//            Checking to ensure the next achievement is still within the array length else set the
//            next achievement as last index value
            if ($next_comment_achievement_index_value > count($achievement_comment) - 1){
                $next_comment_achievement_index_value = count($achievement_comment)- 1;
            }

            // Get User's next comment value and concatenate with string
            $next_comment_achievement = $achievement_comment[$next_comment_achievement_index_value]. ' Comments written';

            // Check to know if user's comment achievement is greater than one so as to store string representation (First)
            // else store int value of achievement
            $achievement = $comment_written > 1 ? $comment_written. ' Comments written' : 'First Comment Written';

            // Helper function to store achievement
            $achievement = new Achievement($event->user,$achievement,'comment',$next_comment_achievement);
            $achievement->unlock_achievement();
        }

    }
}
