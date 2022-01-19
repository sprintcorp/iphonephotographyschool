<?php

namespace Tests\Feature;

use App\Events\BadgeEvent;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Listeners\BadgeListener;
use App\Listeners\CommentWrittenListener;
use App\Listeners\LessonWatchedListener;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class EventListenerTest extends TestCase
{
    /**
     * Test comment written event is attached to a listener.
     *
     * @test
     *
     * @return void
     */
    public function test_comment_written_event_is_attached_to_listener()
    {
        Event::fake();
        Event::assertListening(
            CommentWritten::class,
            CommentWrittenListener::class
        );

    }

    /**
     * Test lesson watched event is attached to a listener.
     *
     * @test
     *
     * @return void
     */
    public function test_lesson_watched_event_is_attached_to_listener()
    {
        Event::fake();
        Event::assertListening(
            LessonWatched::class,
            LessonWatchedListener::class
        );
    }

    /**
     * Test badge event is attached to a listener.
     *
     * @test
     *
     * @return void
     */
    public function test_badge_event_is_attached_to_listener()
    {
        Event::fake();
        Event::assertListening(
            BadgeEvent::class,
            BadgeListener::class
        );
    }


}
