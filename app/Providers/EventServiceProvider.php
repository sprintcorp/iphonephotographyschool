<?php

namespace App\Providers;

use App\Events\BadgeEvent;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\BadgeListener;
use App\Listeners\CommentWrittenListener;
use App\Listeners\LessonWatchedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            CommentWrittenListener::class
        ],
        LessonWatched::class => [
            LessonWatchedListener::class
        ],
        BadgeEvent::class => [
            BadgeListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
