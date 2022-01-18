<?php

namespace App\Listeners;

use App\Events\CommentWritten;
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
        $comment_written = count($event->comment->user);

    }
}
