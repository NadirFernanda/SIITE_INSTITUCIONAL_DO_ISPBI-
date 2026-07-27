<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaDiscipline extends Model
{
    protected $table = 'sala_disciplines';

    protected $fillable = ['sala_id', 'discipline', 'weight_percent'];

    public function sala()
    {
        return $this->belongsTo(\App\Models\Sala::class);
    }
}
