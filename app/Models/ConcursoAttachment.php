<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcursoAttachment extends Model
{
    use HasFactory;

    protected $table = 'concurso_attachments';

    protected $fillable = ['concurso_id', 'path', 'original_name', 'mime', 'size'];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }
}
