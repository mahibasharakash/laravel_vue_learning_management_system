<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'instructor_id',
        'title',
        'description',
        'thumbnail',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];

}
