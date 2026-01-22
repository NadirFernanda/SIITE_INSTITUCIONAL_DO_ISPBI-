<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrossel extends Model
{
    protected $table = 'carrosseis';
    protected $fillable = ['titulo', 'imagem', 'link', 'ordem'];
}
