<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrossel extends Model
{
    protected $table = 'carrosseis';
        protected $fillable = ['titulo', 'subtitulo', 'texto_botao', 'imagem', 'link', 'ordem', 'publicado'];
}
