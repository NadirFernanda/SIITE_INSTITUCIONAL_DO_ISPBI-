<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concurso extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'summary', 'body', 'status', 'publish_at', 'created_by', 'area',
    ];

    protected $casts = ['publish_at' => 'datetime'];

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
