<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badges extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'badge_name',
        'user_id',
        'next_badge_name',
        'next_badge_achievement'
    ];


    /**
     * Get the user that owns a badge.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
