<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Course extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

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

    public function instructor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

}
