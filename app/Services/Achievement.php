<?php


namespace App\Services;


use App\Events\BadgeEvent;
use App\Models\Achievements;
use App\Models\User;

class Achievement
{
    public $user;
    public $achievement;
    public $achievement_type;
    public $next_achievement;


    public function __construct(
        User $user,
        string $achievement,
        string $achievement_type,
        string $next_achievement
    ){
        $this->user = $user;
        $this->achievement = $achievement;
        $this->achievement_type = $achievement_type;
        $this->next_achievement = $next_achievement;
    }

    public function unlock_achievement()
    {
        $save_achievements = Achievements::create([
            'achievement' => $this->achievement,
            'achievement_type' => $this->achievement_type,
            'user_id' => $this->user->id,
            'next_achievement' => $this->next_achievement
        ]);

        $this->unlock_badge();
        return $save_achievements;
    }

    protected function unlock_badge()
    {
        $badges = [
            ['badge'=>'Beginner','achievements'=>0],
            ['badge'=>'Intermediate','achievements'=>4],
            ['badge'=>'Advanced','achievements'=>8],
            ['badge'=>'Master','achievements'=>10]
        ];

        foreach ($badges as $key => $badge){

            $next_badge_index = $key + 1 == count($badges) ? $key : $key + 1;


            if(!$this->user->hasBadges()){
                event(
                    new BadgeEvent(
                        $this->user,$badges[0]['badge'],
                        $badges[1]['badge'],
                        $badges[1]['achievements'])
                );
            }

            if($this->user->canAcquireBadge($badge)){
                event(
                    new BadgeEvent(
                        $this->user,$badge['badge'],
                        $badges[$next_badge_index]['badge'],
                        $badges[$next_badge_index]['achievements']
                    )
                );
            }

        }
        return true;
    }
}
