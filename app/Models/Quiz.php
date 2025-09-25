<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'created_at',
        'updated_at',
    ];

}
