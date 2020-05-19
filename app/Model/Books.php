<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $guarded = [
    ];

    protected $casts = ['authors' => 'array'];
}
