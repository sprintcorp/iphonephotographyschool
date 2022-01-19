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
////
//        $comment = Comment::find(1);
//        $lesson = Lesson::find(1);
////
//        event(new CommentWritten($comment,$user));
//        event(new LessonWatched($lesson,$user));

        $next_badge_achievement = $user->badges->next_badge_achievement ?? 0 - $user->achievements->count() > 0
            ? $user->badges->next_badge_achievement - $user->achievements->count(): 0;

        return response()->json([
            'unlocked_achievements' => $user->achievements->pluck('achievement'),
            'next_available_achievements' => ['comment_achievement' => $user->next_comment_achievement->next_achievement ?? '' ,'lesson_achievement'=>$user->next_lesson_achievement->next_achievement ?? ''],
            'current_badge' => $user->badges->badge_name ?? 'Beginner',
            'next_badge' => $user->badges->next_badge_name ?? 'Intermediate',
            'remaining_to_unlock_next_badge' => $next_badge_achievement
        ]);
    }
}
