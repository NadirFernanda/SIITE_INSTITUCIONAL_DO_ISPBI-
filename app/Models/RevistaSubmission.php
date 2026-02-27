<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevistaSubmission extends Model
{
    protected $table = 'revista_submissions';

    protected $fillable = [
        'author',
        'title',
        'description',
        'link',
        'email',
        'affiliation',
        'category',
        'notes',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
