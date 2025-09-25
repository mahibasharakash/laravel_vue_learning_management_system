<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'content',
        'created_at',
        'updated_at',
    ];

}
