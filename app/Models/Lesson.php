<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable = [
        'section_id',
        'title',
        'content',
        'video_url',
        'duration',
        'sort_order',
        'created_at',
        'updated_at',
    ];

}
