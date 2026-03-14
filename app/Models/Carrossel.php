<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrossel extends Model
{
    use SoftDeletes;
    protected $table = 'carrosseis';
        protected $fillable = ['titulo', 'subtitulo', 'texto_botao', 'imagem', 'link', 'ordem', 'publicado'];
}
