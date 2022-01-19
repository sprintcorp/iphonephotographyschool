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
//          $save_achievements = Achievements::create([
//              'achievement' => $this->achievement,
//              'achievement_type' => $this->achievement_type,
//              'user_id' => $this->user->id
//          ]);
//          if($save_achievements) {
              $this->unlock_badge();
//          }
//          return $save_achievements;
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

            if(!$this->user->badges){
                event(new BadgeEvent($this->user,$badges[0]['badge'],$badges[1]['badge'],$badges[1]['achievements']));
            }
            if($this->user->achievements->count() == $badges[$key]['achievements']){
                event(new BadgeEvent($this->user,$badges[$key]['badge'],$badges[$next_badge_index]['badge'],$badges[$next_badge_index]['achievements']));
            }
//            else{
//                return false;
//            }
        }
        return true;


//        event(new BadgeEvent($this->user,$current_badge,$next_badge_name,$next_badge_achievement));
    }

    protected function get_array_value($value,$array){
        foreach ($array as $key => $data){
            if($data['achievements'] == $value){
//                Get index of the next required badge
                $this->next_badge_index = $key + 1;
                return $data;
            }
        }
    }



//$last_badge = count($badges) - 1;
//$count_user_achievement = $this->user->achievements->count();
//
////        Check user's achievement to help unlock required badge
//$badge = $this->get_array_value($count_user_achievement,$badges);
//
////        dd($badge);
////        check to see if all badges has been acquired
//$next_badge_name = count($badges) < $this->next_badge_index ? $badges[$this->next_badge_index]['badge'] : $badges[$last_badge]['badge'];
//$next_badge_achievement = count($badges) < $this->next_badge_index ? $badges[$this->next_badge_index]['achievements']: $badges[$last_badge]['achievements'];
//
////        $current_badge = $badge != NULL ? $badge['badge'] : '';
////          Check if user has any badge
//$user_badge = $this->user->badges;
//if(!$user_badge){
//$current_badge = $badges[0]['badge'];
//$next_badge_name = $badges[1]['badge'];
//$next_badge_achievement = $badges[1]['achievements'];
//}else{
//    $current_badge = $badge['badge'];
//}
}
