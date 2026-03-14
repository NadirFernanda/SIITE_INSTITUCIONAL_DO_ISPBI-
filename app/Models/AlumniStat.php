<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniStat extends Model
{
    use HasFactory;

    protected $table = 'alumni_stats';

    protected $fillable = [
        'alumni_count',
        'employability_percentage',
        'countries_count',
        'companies_founded',
    ];

    protected $casts = [
        'alumni_count'              => 'integer',
        'employability_percentage'  => 'integer',
        'countries_count'           => 'integer',
        'companies_founded'         => 'integer',
    ];
}
