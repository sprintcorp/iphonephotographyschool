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

    protected $next_badge_index;

    public function __construct(User $user,string $achievement,string $achievement_type){
        $this->user = $user;
        $this->achievement = $achievement;
        $this->achievement_type = $achievement_type;
    }

    public function unlock_achievement()
    {
          $save_achievements = Achievements::create([
              'achievement' => $this->achievement,
              'achievement_type' => $this->achievement_type,
              'user_id' => $this->user->id
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
        $user_achievement = $this->user->achievements->count();
        $badge = $this->get_array_value($user_achievement,$badges);
        if($badge)
        event(new BadgeEvent($this->user,$badge['badge'],$badges[$this->next_badge_index]['badge'],$badges[$this->next_badge_index]['achievements']));
    }

    protected function get_array_value($value,$array){
        foreach ($array as $key => $data){
            if($data['achievements'] == $value){
                if($key <= count($array)) {
                    $this->next_badge_index = $key + 1;
                }
                return $data;
            }
        }
    }
}
