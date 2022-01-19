<?php

namespace Tests\Feature;

use App\Events\BadgeEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BadgeEventTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test badge event can be dispatched.
     *
     * @test
     *
     * @return void
     */
    public function test_badge_event_can_be_dispatched()
    {
        $user = User::factory()->create();
        Event::fake();
        event(new BadgeEvent($user,'beginner','intermediate',10));
        Event::assertDispatched(BadgeEvent::class);
    }
}
