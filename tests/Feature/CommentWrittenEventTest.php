<?php

namespace Tests\Feature;

use App\Events\CommentWritten;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CommentWrittenEventTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test comment written event can be dispatched.
     *
     * @test
     *
     * @return void
     */
    public function test_comment_written_event_can_be_dispatched()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        Event::fake();
        event(new CommentWritten($comment,$user));
        Event::assertDispatched(CommentWritten::class);
    }
}
