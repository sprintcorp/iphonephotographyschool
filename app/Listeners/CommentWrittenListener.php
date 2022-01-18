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
        // Comments achievement defined as array data structure for test purpose which can therefore take more
        // achievement but in a large scale development database would be used rather than storing in as an array
        // within the code
        $achievement_comment = [1,3,5,10,20];
        $comment_written = count($event->user->comments);
        if(in_array($comment_written,$achievement_comment)){
            $achievement = $comment_written > 1 ? $comment_written. ' Comments written' : 'First Comment Written';
            $achievement = new Achievement($event->user,$achievement,'comment');
            $achievement->unlock_achievement();
        }

    }
}
