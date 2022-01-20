<?php

namespace App\Http\Controllers;

use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $next_badge_achievement = $user->badges->next_badge_achievement ?? 0;
        $user_total_achievement = $user->achievements->count() ?? 0;
        $achievement_left_to_unlock_next_badge = $next_badge_achievement - $user_total_achievement;

        return response()->json([
            'unlocked_achievements' => $user->achievements->pluck('achievement'),
            'next_available_achievements' => [
                'comment_achievement' => $user->next_comment_achievement->next_achievement ?? '' ,
                'lesson_achievement'=>$user->next_lesson_achievement->next_achievement ?? ''
            ],
            'current_badge' => $this->badgeName($user),
            'next_badge' => $this->nextBadgeName($user),
            'remaining_to_unlock_next_badge' => $achievement_left_to_unlock_next_badge
        ]);
    }

    public function badgeName($user)
    {
        return $user->badges->badge_name ?? 'Beginner';
    }

    public function nextBadgeName($user)
    {
        return $user->badges->next_badge_name ?? 'Intermediate';
    }
}
