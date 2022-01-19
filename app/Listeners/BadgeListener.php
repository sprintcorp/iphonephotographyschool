<?php

namespace App\Listeners;

use App\Events\BadgeEvent;
use App\Models\Badges;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BadgeListener implements ShouldQueue
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
     * Handle the event.
     *
     * @param  \App\Events\BadgeEvent  $event
     * @return void
     */
    public function handle(BadgeEvent $event)
    {
        Badges::updateOrCreate([
            'user_id' => $event->user->id,
        ], [
            'badge_name' => $event->current_badge,
            'next_badge_name' => $event->next_badge,
            'next_badge_achievement' => $event->next_badge_achievement
        ]);
    }
}
