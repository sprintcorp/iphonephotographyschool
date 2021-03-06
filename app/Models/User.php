<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasBadges()
    {
        return $this->badges();
    }

    public function canAcquireBadge($badge)
    {
        return $this->achievements->count() === $badge['achievements'];
    }

    /**
     * The comments that belong to the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The lessons that a user has access to.
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

    /**
     * The lessons that a user has watched.
     */
    public function watched()
    {
        return $this->belongsToMany(Lesson::class)->wherePivot('watched', true);
    }

    /**
     * The achievements that belong to the user.
     */
    public function achievements()
    {
        return $this->hasMany(Achievements::class);
    }

    /**
     * The badges that belong to the user.
     */
    public function badges()
    {
        return $this->hasOne(Badges::class);
    }

    public function next_lesson_achievement()
    {
        return $this->hasOne(Achievements::class)->where('achievement_type','lesson')->latest();
    }

    public function next_comment_achievement()
    {
        return $this->hasOne(Achievements::class)->where('achievement_type','comment')->latest();
    }
}
