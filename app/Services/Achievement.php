<?php


namespace App\Services;


use App\Models\Achievements;
use App\Models\User;

class Achievement
{
    public $user;
    public $achievement;
    public $achievement_type;

    public function __construct(User $user,string $achievement,string $achievement_type){
        $this->user = $user;
        $this->achievement = $achievement;
        $this->achievement_type = $achievement_type;
    }

    public function unlock_achievement()
    {
          return Achievements::create([
              'achievement' => $this->achievement,
              'achievement_type' => $this->achievement_type,
              'user_id' => $this->user->id
          ]);
    }
}
