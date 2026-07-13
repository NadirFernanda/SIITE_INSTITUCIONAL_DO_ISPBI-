<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaDocumento extends Model
{
    protected $table = 'noticia_documentos';

    protected $fillable = ['noticia_id', 'nome_original', 'caminho'];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

    public function extensao(): string
    {
        return strtoupper(pathinfo($this->nome_original, PATHINFO_EXTENSION));
    }
}
