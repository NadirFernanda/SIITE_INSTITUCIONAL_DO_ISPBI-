<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Concurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'summary', 'body', 'status', 'publish_at', 'created_by',
    ];

    protected $dates = ['publish_at'];

    public function attachments()
    {
        return $this->hasMany(ConcursoAttachment::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('publish_at')->orWhere('publish_at', '<=', now());
            });
    }
}
