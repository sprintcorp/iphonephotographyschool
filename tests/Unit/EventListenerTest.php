<?php

namespace Tests\Unit;

use App\Events\CommentWritten;
use App\Listeners\CommentWrittenListener;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\TestCase;

class EventListenerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     *
     * @return void
     */
    public function test_is_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            CommentWritten::class,
            CommentWrittenListener::class
        );
    }
}
