<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisita extends Model
{
    protected $table = 'site_visitas';

    protected $fillable = ['pais', 'pais_code', 'pagina'];
}
