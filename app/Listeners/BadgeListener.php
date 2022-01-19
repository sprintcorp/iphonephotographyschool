<?php

namespace App\Listeners;

use App\Events\BadgeEvent;
use App\Models\Badges;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BadgeListener
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
        $badges = Badges::where('user_id',$event->user->id)->first();
        if($badges){
            $badges->update([
                'badge_name'=>$event->current_badge,
                'user_id' => $event->user->id,
                'next_badge_name' => $event->next_badge,
                'next_badge_achievement' => $event->next_badge_achievement
            ]);
        }else {
            Badges::create([
                'badge_name' => $event->current_badge,
                'user_id' => $event->user->id,
                'next_badge_name' => $event->next_badge,
                'next_badge_achievement' => $event->next_badge_achievement
            ]);
        }
    }
}
