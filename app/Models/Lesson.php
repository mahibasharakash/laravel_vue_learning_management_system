<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{

    protected $fillable = [
        'section_id',
        'title',
        'content',
        'video_url',
        'duration',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

}
