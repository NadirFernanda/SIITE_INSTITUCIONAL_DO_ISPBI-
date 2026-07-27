<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidaturaNota extends Model
{
    protected $table = 'candidatura_notas';

    protected $fillable = ['candidatura_id', 'discipline', 'nota', 'lancada_por', 'lancada_em'];

    public function candidatura()
    {
        return $this->belongsTo(Candidatura::class);
    }
}
