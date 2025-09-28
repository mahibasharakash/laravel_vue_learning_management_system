<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $fillable = [
        'course_id',
        'title',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

}
