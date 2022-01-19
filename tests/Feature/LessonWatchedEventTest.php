<?php

namespace Tests\Feature;

use App\Events\LessonWatched;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class LessonWatchedEventTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test lesson watched event can be dispatched.
     *
     * @test
     *
     * @return void
     */
    public function test_lesson_watched_event_can_be_dispatched()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        Event::fake();
        event(new LessonWatched($lesson,$user));
        Event::assertDispatched(LessonWatched::class);
    }
}
