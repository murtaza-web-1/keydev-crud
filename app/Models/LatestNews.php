<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatestNews extends Model
{
    use HasFactory;

    protected $fillable = ['news', 'last_updated'];

    protected $casts = [
        'news' => 'array',
        'last_updated' => 'datetime',
    ];
}
