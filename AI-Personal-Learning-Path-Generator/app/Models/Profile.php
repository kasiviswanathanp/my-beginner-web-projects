<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
	'user_id',
	'learning_goal',
	'current_level',
	'study_hours_per_day',
	'schedule',
	'habits',
	'difficulties',
	'distractions',
	'explanation_style',
	'ui_mood',
	'checkin_frequency',
    ];

    public function user(): BelongsTo
    {
	return $this->belongsTo(User::class);
    }
}
