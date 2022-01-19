<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'achievement',
        'achievement_type',
        'user_id',
        'next_achievement'
    ];

    /**
     * Get the user that unlocks an achievement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
