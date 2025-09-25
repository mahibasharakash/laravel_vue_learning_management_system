<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'user_id',
        'course_id',
        'amount',
        'status',
        'transaction_id',
        'paid_at',
        'created_at',
        'updated_at',
    ];

}
