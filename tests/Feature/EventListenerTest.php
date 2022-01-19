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
     * Test comment listener is attached to an event.
     *
     * @test
     *
     * @return void
     */
    public function test_comment_is_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            CommentWritten::class,
            CommentWrittenListener::class
        );

    }

    /**
     * Test lesson listener is attached to an event.
     *
     * @test
     *
     * @return void
     */
    public function test_lesson_is_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            LessonWatched::class,
            LessonWatchedListener::class
        );
    }

    /**
     * Test badge listener is attached to an event.
     *
     * @test
     *
     * @return void
     */
    public function test_badge_is_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            BadgeEvent::class,
            BadgeListener::class
        );
    }


}
