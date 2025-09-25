<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
        'created_at',
        'updated_at',
    ];

}
