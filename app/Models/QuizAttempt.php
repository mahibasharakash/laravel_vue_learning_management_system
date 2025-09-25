<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{

    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'attempted_at',
        'created_at',
        'updated_at',
    ];

}
