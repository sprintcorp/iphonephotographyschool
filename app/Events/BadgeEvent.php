<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class BadgeEvent
{
    use Dispatchable, SerializesModels;

    public $user;
    public $current_badge;
    public $next_badge;
    public $next_badge_achievement;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user,$current_badge,$next_badge,$next_badge_achievement)
    {
        $this->user = $user;
        $this->current_badge = $current_badge;
        $this->next_badge = $next_badge;
        $this->next_badge_achievement = $next_badge_achievement;
    }

}
