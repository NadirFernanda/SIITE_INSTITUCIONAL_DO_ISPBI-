<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['candidatura_id', 'professor_id', 'nota', 'observacoes', 'lancada_em'];

    protected $casts = ['lancada_em' => 'datetime', 'nota' => 'float'];

    public function candidatura()
    {
        return $this->belongsTo(Candidatura::class);
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }
}
